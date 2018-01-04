check_is_bot
============

This is a curious piece of advertising malware which was found on a hacked WordPress website. It is obfuscated quite well, using as many garbage characters as PHP allows in identifiers and variable names. It also includes a jokingly inappropriate chatlog (Known as "The Saga of Bloodninja") at random locations in the file, making it difficult to tell the file apart from a corrupted text file at a glance.
The malware has been deobfuscated using a specially written deobfuscation tool to rename everything with garbage names into something a little easier to work with, then further deobfuscated and rewritten by hand.

In the end, it seems to be nothing more than an advertisement malware that either redirects the user, or embeds an iframe on the pages it is included.

This malware was very heavily obfuscated to be such a simple script.

Execution
=========

You can find the deobfuscation tool in the `deobfuscation/` directory, together with the partially deobfuscated malware as outputted by the tool.

The finished deobfuscated malware can be found in this directory as `check_is_bot.deobfuscated.php`.

The deobfuscated code is quite simple; It takes the current host and the current user's IP and user-agent, and sends it off to a server, `hxxp://tndns.net/inc/mods/cloaka/remote.php`, presumably controlled by the malware authors. The return value is basically a yes or no on whether or not to show the current user malicious ads, and this is communicated to the Javascript portion of this malware through a cookie simply called `c`.

The accompanying Javascript seems to be masquerading as the Javascript Code Style checker in name, but is just control code to write the iframe onto the page, or redirect based on said `c` cookie.

The Javascript malware has a way of executing javascript that I haven't seen before:

```javascript
var foo = {};
var strConstructor = "".constructor;
var foo["toString"] = strConstructor["constructor"]("alert('This code was evald!');");
var s = foo + '.'; // Code is run by turning the foo object into a string!
```

Interesting.

You can find a deobfuscated version of the Javascript in this directory as `jscs.deobfuscated.js`.

The mallicious ads are served from `hxxp://maildelegation.top/essay?<keywords here>`. Navigating to the root of that domain will redirect you to a Google search for "try again".

The file `decompression_disappointing.php` was found in the same directory as the check_is_bot malware scripts, but it may not be related.

Who?
====

At the time of writing, the malware serves malicious ads for EssayPro. The website EssayPro.com is owned and operated by Devellux LLC, Georgia, according to the website's Terms and Conditions.
EssayPro (@EssayPro_) has not responded to a request for comments on Twitter regarding their service being advertised in this malicious manner at the time of writing.

The domains `maildelegation.top` and `tndns.net` are registered with DomainContext, Inc. and using Cloudflare's nameservers. The whois for both is as follows:
```Registrant Name: Dmitriy Gladunets
Registrant Organization: 
Registrant Street: Galana, d.3, kv. 131
Registrant City: Kharkov
Registrant State/Province: 
Registrant Postal Code: 61121
Registrant Country: UA
Registrant Phone: +380.931214412
Registrant Phone Ext: 
Registrant Fax: 
Registrant Fax Ext: 
Registrant Email: aleksandrov.inbox@gmail.com
```

The same Dmitriy Gladunets is also listed as the owner of: tiperher.com, laeiwabjbh.com, ryatlo.com, e-pro.org, seiaxsevwr.com and probably many more.

If you try to add the gmail address listed above as a contact, you will find the name "Andrey Aleksandrov". It's unknown if this is the same person.
