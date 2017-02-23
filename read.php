<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Simple Text Editor</title>
</head>
<body>

<?php

// Initial variables 
$fileName = $dir = "";

// Check fileName if isSet
if (isset($_GET["fileName"]) && isset($_GET["dir"])) {
	$fileName = $_GET["fileName"];
	$dir = $_GET["dir"];
	$file_handle = fopen($dir.$fileName.'.txt', "r"); 
	$file_string = fread($file_handle, filesize($dir.$fileName.'.txt'));
	fclose($file_handle);
}

?>

<h1><a href="index.php">Simple Text Editor</a></h1>
<h2>Read: <?php echo $fileName ?></h2>
<br/>
<div>
<?php echo $file_string ?>
</div>
</body>
</html>