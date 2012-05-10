<?php
require_once("config.php");

$sound = $_POST['filename'];
$nicely = $_POST['ask'];

if ($sound && $nicely)
{
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
			exec('afplay "' . $upload_dir . $sound . '"');
		}
		else
		{
			echo "Fuck off till 5:30pm";
		}
	}
}
?>
