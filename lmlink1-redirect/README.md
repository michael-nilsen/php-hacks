lmlink1-redirect
================

This hack was found in wp-load.php and wp-settings.php in wwwroot of a hacked website.

The main purpose of the hack seems to be to redirect visitors to other websites offering various pharmacuticals.

Detection
=========

To detect this hack, it's recommended to compare the hashes of WordPress files found in the web root. Additionally, you may look for the existence of files called ".bt" containing a list of IPs, directories called ".st" and files called ".r", all of which are created by the payload which is downloaded every time the injected code is run.

Execution
=========

A script has been injected into wp-load.php and wp-settings.php at the very beginning of the file. Because both files include the same code, which defines an XOR decryption function named "wp_cd", and both files are included by WordPress, it will generate a fatal error due to the wp_cd() function being already declared in one by the time the other is loaded.

You can find a deobfuscated and commented version of the injected code in `deobfuscated.php`.

The injected script downloads a payload an executes it, and deletes the downloaded payload once its been run.

The payload script which is downloaded every time the injected code is run can be found at `./external/lmlink1.top/lnk/inj.php`. This payload is not obfuscated, but it's opening and closing PHP tags is added on the fly, presumably to prevent the payload from being executed on the malicious host.

The payload preiodically downloads a list of IPs of presumably known search engine bots from the same external server, and saves them using the name ".bt" in the first available writable directory it can find. I've downloaded this file and put them in the `external` directory with the same path as refered to by the scripts.

The payload also accepts commands from its creator which is passed either in the query string of a GET request, or in the payload of a POST request. Unfortunately I have not yet been able to observe this happening, so I don't know what kind of data they would send.

