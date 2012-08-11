<?php
require_once("config.php");

$sound = $_POST['filename'];
$nicely = $_POST['ask'];
$jenkins = isset($_POST['jenkins']) ? $_POST['jenkins'] : FALSE;

if ($sound && $nicely)
{
	if ($lockdown && !$jenkins)
	{
		$user_ip = $_SERVER['REMOTE_ADDR'];
		$user_ip = str_replace("10.44.1.", "", $user_ip);
		$phrase = "The user whose local IP ends with " . $user_ip . " should find something better to do.";
		$field_str = "phrase=" . $phrase;
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, "10.44.1.125/say.php");
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$field_str);
		$result = curl_exec($ch);
		curl_close($ch);
		return;
	}

	if ($sound == "STOP")
	{
		$return = shell_exec('killall afplay');
		echo $return;
	}
	else
	{
		$after5only = (substr($sound, 0, 6) == "after5");
		if (((date('Hi') > '1730') && $after5only) || !$after5only)
		{
			if ($bear_mode)
			{ 
				exec('afplay "' . $upload_dir . 'bear' . rand(1,3) . '.wav"');
			} elseif ($whale_mode || $sound == 'random_whale_sound') {
				exec('afplay "' . $upload_dir . 'whale ' . rand(1,7) . '.wav"');
			} else {
				exec('afplay "' . $upload_dir . $sound . '"');
			}
		}
		else
		{
			echo "Fuck off till 5:30pm";
		}
	}
}
?>
