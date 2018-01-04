//
// PHP Deobfuscator
//
// Written specifically for check_is_bot.php
//
// Usage: nodejs phpdeof.js [input.php]
//
const fs = require('fs')
const engine = require('php-parser')
const unparse = require('php-unparser')
const jsesc = require('jsesc')
const zlib = require('zlib')

// Contains identifiers of a single scope
class Scope
{
	constructor(node)
	{
		this.node = node
		this.types = {}
		this.scopes = []
	}

	add(type, name, newName)
	{
		if((type == 'class' || type == 'function') && this.parent)
			this.parent.add(type, name, newName)
		else
		{
			if(!this.types[type])
				this.types[type] = []
			this.types[type].push({name: name, newName: newName})
		}
	}

	get(type, name)
	{
		if(!this.types[type])
			return null
		let n = null
		let t = this.types[type]
		for(let i in t)
		{
			if(t[i].name == name)
				return t[i].newName
		}
		return null
	}
}

// Contains the entire tree of scopes in a file
class Scopes
{
	constructor()
	{
		this.outerScope = new Scope('global')
		this.scopes = []
		this.types = {}
		this.currentScope = this.outerScope
	}

	scope()
	{
		return this.currentScope
	}

	new(node)
	{
		let s = null
		if(node._scope)
			s = node._scope
		else
		{
			s = new Scope(node)
			node._scope = s
			s.parent = this.currentScope
			this.scopes.push(s)
			this.currentScope.scopes.push(s)
		}
		this.currentScope = s
	}

	add(type, name)
	{
		if(!this.types[type])
			this.types[type] = 0
		let newName = name

		// Rename identifiers that contain unreadable garbage
		if(!isPrintable(name))
		{
			newName = '_'+type+this.types[type]
			this.types[type]++
		}

		this.scope().add(type, name, newName)
	}

	getMultipleType(types, name)
	{
		let newName = null
		for(let i in types)
		{
			newName = this.get(types[i], name)
			if(newName) return newName
		}
		return null
	}

	get(type, name)
	{
		let scope = this.currentScope
		let n = null
		while(!n && scope)
		{
			n = scope.get(type, name)
			if(n) return n

			if(scope.scopes.length)
			{
				for(let i in scope.scopes)
				{
					n = scope.scopes[i].get(type, name)
					if(n) return n
				}
			}
			scope = scope.parent
		}
		return n
	}

	end()
	{
		this.currentScope = this.currentScope.parent
	}
}

function isPrintable(str)
{
	let len = str.length
	for(let i = 0; i < len; i++)
	{
		let code = str.charCodeAt(i)
		if(!(code > 32 && code < 127)) // printable ascii
			return false;
	}
	return true;
}

// Unescape string
function unescape(str)
{
	let len = str.length
	let out = ""
	for(let i = 0; i < len; i++)
	{
		let c = str[i]
		if(c == '\\')
		{
			let c2 = str[++i]
			switch(c2)
			{
				case 'n': out += '\n'; break
				case 'r': out += '\r'; break
				case 't': out += '\t'; break
				case 'a': out += '\a'; break
				case 'e': out += '\e'; break
				case 'f': out += '\f'; break
				case '$': out += '$'; break
				case '\\': out += '\\'; break
				case '"': out += '"'; break
				case '\'': out += '\''; break
				case 'x': out += String.fromCharCode(parseInt(str[++i] + str[++i], 16)); break
				case '0': case '1': case '2': case '3':
				case '4': case '5': case '6': case '7':
				{
					let o = c2
					for(let j = 0; j < 2; j++)
					{
						if(str[i + 1] >= '0' && str[i + 1] <= '7')
							o += str[++i]
						else
							break
					}
					out += String.fromCharCode(parseInt(o, 8))
					break
				}
				default:
					throw new Error("Unknown escape character: "+c2)
			}
		}
		else
			out += c
	}
	return out
}

// Get a new name for the given node
function getName(node, scopes)
{
	if(node.name)
	{
		let name = null
		if(node.kind == 'identifier')
			name = scopes.getMultipleType(['class', 'function', 'identifier'], node.name)
		else if(node.kind == 'variable')
			name = scopes.getMultipleType(['parameter', 'property', 'variable'], node.name)
		else if(node.kind == 'constref')
			name = scopes.getMultipleType(['method', 'constref'], node.name)
		else
			name = scopes.get(node.kind, node.name)
		if(!name)
		{
			scopes.add(node.kind, node.name)
			name = scopes.get(node.kind, node.name)
		}
		if(name)
			return name
	}
	return undefined
}

// Visits every node in the AST, and calls the callback for each one
function walk(node, scopes, callback)
{
	if(node === null)
		return null

	// Recursion
	if(node.expr)
		node.expr = walk(node.expr, scopes, callback)
	if(node.what)
		node.what = walk(node.what, scopes, callback)
	if(node.offset)
		node.offset = walk(node.offset, scopes, callback)
	if(node.source)
		node.source = walk(node.source, scopes, callback)
	if(node.status)
		node.status = walk(node.status, scopes, callback)
	if(node.init)
	{
		for(let i in node.init)
			node.init[i] = walk(node.init[i], scopes, callback)
	}
	if(node.test)
	{
		if(node.test instanceof Array || typeof node.test === "array")
		{
			for(let i in node.test)
				node.test[i] = walk(node.test[i], scopes, callback)
		}
		else
			node.test = walk(node.test, scopes, callback)
	}
	if(node.increment)
	{
		for(let i in node.increment)
			node.increment[i] = walk(node.increment[i], scopes, callback)
	}
	if(node.key)
		node.key = walk(node.key, scopes, callback)
	if(node.value)
		node.value = walk(node.value, scopes, callback)
	if(node.left)
		node.left = walk(node.left, scopes, callback)
	if(node.right)
		node.right = walk(node.right, scopes, callback)
	if(node.arguments)
	{
		for(let i in node.arguments)
			node.arguments[i] = walk(node.arguments[i], scopes, callback)
	}
	if(node.items)
	{
		for(let i in node.items)
			node.items[i] = walk(node.items[i], scopes, callback)
	}

	if(node.children)
	{
		// Children means new scope
		scopes.new(node)

		// Children are always an array, even if there's just 1 child
		for(let i in node.children)
			node.children[i] = walk(node.children[i], scopes, callback)
		scopes.end()
	}
	if(node.body)
	{
		// Body means new scope
		scopes.new(node)

		// Body can be 1 object, of an array of objects
		if(node.body instanceof Array || typeof node.body === "array")
		{
			for(let i in node.body)
				node.body[i] = walk(node.body[i], scopes, callback)
		}
		else
			node.body = walk(node.body, scopes, callback)
		scopes.end()
	}

	if(callback)
	{
		let newNode = callback(node, scopes)
		//if(newNode)
			node = newNode
	}

	return node
}

// Initialize parser
var parser = new engine({
	parser: {
		php7: true
	}
});

let file = fs.readFileSync(process.argv[2], 'latin1')

// Lazy was to get the base64 encoded payload
file = file.match(/'(.*?)'/)[1]
let buf = new Buffer(file, 'base64')
file = zlib.inflateSync(buf).toString('latin1');

let ast = parser.parseEval(file)
let scopes = new Scopes()

// First pass - Get names and transform
walk(ast, scopes, function(node, scopes)
{
	// Add the name to the scope
	getName(node, scopes)

	// Convert octal to decimal
	if(node.kind == 'number')
	{
		let i = 0
		if(node.value[i] == '-')
			i++
		if(node.value[i] == '0' && node.value[i + 1] != '.')
			node.value = parseInt(node.value, 8).toString()
	}

	// Combine static concatinations
	if(node.kind == "bin" && node.type == '.')
	{
		if(node.left.kind == 'string' && node.right.kind == 'string')
		{
			return {
				kind: 'string',
				value: node.left.value + node.right.value,
				isDoubleQuote: true
			}
		}
	}
	return node
})

// Second pass - Rename, sanitize strings and resolve the $GLOBALS variables
let globals = {}
walk(ast, scopes, function(node, scopes)
{
	// Rename the identifiers
	node.name = getName(node, scopes)

	// Sanitize strings
	if(node.kind == 'string')
		node.value = jsesc(unescape(node.value))

	// Find the $GLOBALS', get their value and remove them
	// If $GLOBALS["string"] = base64_decode("string")
	if(node.kind == 'assign' && node.left.kind == 'offsetlookup' && node.left.what.name == 'GLOBALS' && node.left.offset.kind == 'string' &&
		node.right.kind == 'call' && node.right.what.name.toLowerCase() == 'base64_decode' && node.right.arguments[0].kind == 'string'
		)
	{
		globals[node.left.offset.value] = new Buffer(node.right.arguments[0].value, 'base64').toString('ascii').toLowerCase()
		return null
	}

	return node
})

// Thrid pass, resolve all the $GLOBAL[]() calls
walk(ast, scopes, function(node, scopes)
{
	// If $GLOBALS["string"](...)
	if(node.kind == 'call' && node.what.kind == 'offsetlookup' && node.what.what.kind == 'variable' &&
		node.what.what.name == 'GLOBALS' && node.what.offset.kind == 'string' && globals[node.what.offset.value]
		)
	{
		node.what = {
			kind: 'identifier',
			resolution: 'uqn',
			name: globals[node.what.offset.value]
		}
	}
	if(node.kind == 'if')
		node.shortForm = false
	return node
})

let deobfuscated = unparse(ast,
{
	indent: "\t", // TABS FOR INDENTION!
	dontUseWhitespaces: false,
	shortArray: true,
	bracketsNewLine: true,
	forceNamespaceBrackets: false,
	collapseEmptyLines: true
});

// The php-unparser library has a bug with escape characters. A simple unescape works for now...
deobfuscated = unescape(deobfuscated)

// Remove extension, the lazy way
let extLoc = process.argv[2].lastIndexOf('.')
let newFilename = extLoc == -1 ? process.argv[2] : process.argv[2].substring(0, extLoc)

// Output
fs.writeFileSync(newFilename+'.deobfuscated.intermediate.php', deobfuscated)
