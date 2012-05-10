<?php
	require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Media Play-o-lator 5000!</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/site.js"></script>
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/fileuploader.css" rel="stylesheet" type="text/css">
	<style>
		<?php if ($asked_nicely) { ?>
			body { background: url('partycube.gif') !important;}
		<?php } ?>
	</style>
</head>
<body <?php if($asked_nicely) {echo "class='allowed'"; }; ?>>
<div>
	<?php
	// SPEAKING FORM THINGY
	if ($asked_nicely)
	{
	?>
		<form id="say">
			<input type="text" />
			<input type="submit" value="Say This" />
		</form>
	<?php
	}
	?>
</div>
<div id="file-uploader">
</div>
<script src="js/fileuploader.js" type="text/javascript"></script>
<script>
	function createUploader(){
		var uploader = new qq.FileUploader({
			element: document.getElementById('file-uploader'),
			action: 'upload.php',
			debug: true
		});
	}
	window.onload = createUploader;
</script>

<a class='stop' href='STOP'>STOP!</a>
<?php
if (!is_dir($upload_dir))
{
	mkdir($upload_dir, 0777);
}

if ($dh = opendir($upload_dir))
{
	while (($sound_file = readdir($dh)) !== FALSE)
	{
		$ext = end(explode('.', $sound_file));
		$name = current(explode('.', $sound_file));
		if ($ext == "mp3" || $ext == "wav" || $ext == "aif")
		{
			//password check
			$sound_file = $asked_nicely ? $sound_file : "not_nice";

			// After 5 checker
			$pruned_name = substr($name, 0, 6);
                        $after5only = (strcasecmp($pruned_name,"after5") == 0);
			
			if (((date('Hi') > '1730') && $after5only) || !$after5only)
			{
				echo "<a class='sound' href='" . $sound_file . "'>" . $name . "</a>\n";
			}
		}
	}
}
closedir($dh);
?>
</body>
</html>
