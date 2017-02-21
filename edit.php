<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Simple Text Editor</title>
<style>

.link {
	text-decoration: none;
}

</style>

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
	
<h2>Edit: <?php echo $fileName ?></h2>

<form method="get" action="index.php">
	<?php echo '<button type="submit" name="save" value="'.$fileName.'">Save</button>'; ?>
	<button type="button"><a class="link" href="index.php">Return</a></button>
	<br/>
	<textarea name="content" style="width:300px; height:200px"><?php echo $file_string ?></textarea>

</form>

</body>
</html>