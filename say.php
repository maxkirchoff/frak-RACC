<?php
$phrase = $_POST['phrase'];
if ($phrase)
{
	$myFile = "say.mp3";
	$fh = fopen($myFile, 'w') or die("can't open file");
	$stringData = file_get_contents('http://translate.google.com/translate_tts?q=' . urlencode($phrase));
	fwrite($fh, $stringData);
	fclose($fh);
	if ($myFile)
	{
		exec('afplay ' . $myFile);
	}
}
?>
