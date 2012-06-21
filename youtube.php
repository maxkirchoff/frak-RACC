<?php
require_once('config.php');
$link = $_POST['link'];
if ($link)
{
	if ($link)
	{
        $ch = curl_init("http://www.dibblr.com/process.php");
		$encoded =  urlencode('url').'='.$link;
		curl_setopt($ch, CURLOPT_POSTFIELDS,  $encoded);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
		$response = curl_exec($ch);
		curl_close($ch);

        if ($response)
        {
            $string_remove_1 = '<span style="size: 14px; color: #C0C0C0;">Conversion Completed</span><br/>Click below to download.</br><br/><a href="';
            $string_remove_2 = '"><img src="images/download.png" border="0" width="128px"/></a><br/><br/><em>Remember: Download links are only valid for 1 hour</em><br/><br/>';
            $clean_step_1 = str_replace($string_remove_1, "", $response);
            $clean_step_2 = str_replace($string_remove_2, "", $clean_step_1);
            $clean_step_3 = str_replace("\n", '', $clean_step_2);
            $clean_step_4 = str_replace("\r", '', $clean_step_3);
            $clean_step_5 = str_replace(' ', '', $clean_step_4);
            $clean_step_6 = str_replace("http://adf.ly/1535872/", "", $clean_step_5);


            if ($get_url = $clean_step_6)
            {
                $youtube_mp3 = "youtube/" . strtotime('now') . ".mp3";
                $fh = fopen($youtube_mp3, 'w') or die("can't open file");

                $ch1 = curl_init();
                $timeout = 5000;
                curl_setopt($ch1,CURLOPT_URL, $get_url);
                curl_setopt($ch1,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch1,CURLOPT_CONNECTTIMEOUT,$timeout);
                $data = curl_exec($ch1);
                curl_close($ch1);

                fwrite($fh, $data);
                fclose($fh);
                if ($youtube_mp3)
                {
                    exec('afplay ' . $youtube_mp3);
                }
            }
        }
	}
}
?>
