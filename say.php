<?php
require_once('config.php');
$phrase = $_POST['phrase'];
if ($phrase)
{
	$myFile = "say.mp3";
	$fh = fopen($myFile, 'w') or die("can't open file");
	
	if ($bear_mode)
	{
		$phrase = "if you are going to be a bear, be a grizzly";
	} 
	elseif ($whale_mode)
	{
		$phrase = "I am a shark, and sharks have got to eat";
	}

	$stringData = file_get_contents('http://translate.google.com/translate_tts?q=' . urlencode($phrase));
	fwrite($fh, $stringData);
	fclose($fh);
	if ($myFile)
	{
		exec('afplay ' . $myFile);
	}
}
?>
