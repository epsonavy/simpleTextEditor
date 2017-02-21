<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Simple Text Editor</title>
</head>
<body>

<?php

// Initial variables 
$fileName = "";

function check_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check fileName if isSet
if (isset($_GET["fileName"])) {
	$fileName = check_input($_GET["fileName"]);
	$file_handle = fopen($fileName.'.txt', "r"); 
	$file_string = fread($file_handle, filesize($fileName.'.txt'));
	fclose($file_handle);
}

?>

<h1><a href="index.php">Simple Text Editor</a></h1>
<h2>Read: <?php echo $fileName ?></h2>
<br/>
<?php echo $file_string ?>

</body>
</html>