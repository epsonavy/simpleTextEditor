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
$fileName = $dir = "";

function check_input($data) {
    $data = trim($data);
    return $data;
}

function redirect()  {
	echo "<script>window.location =\"index.php\";</script>";
}


// Check fileName if isSet
if (isset($_GET["fileName"]) && isset($_GET["dir"])) {
	$fileName = $_GET["fileName"];
	$dir = $_GET["dir"];
	$file_handle = fopen($dir.$fileName.'.txt', "r"); 
	$file_string = fread($file_handle, filesize($dir.$fileName.'.txt'));
	fclose($file_handle);
} else if (isset($_GET["new"]) && isset($_GET["dir"])) {
	$dir = $_GET["dir"];
	$fileName = check_input($_GET["new"]);

	// Validing input file name
	if ($fileName === "") {
		echo "Invalid File Name!\n";
		redirect();
		exit;
	} else if (ctype_alnum(str_replace(' ','',$fileName))) {
		// Valid file name
		$fileHandle = fopen($dir.$fileName.".txt", "r");
		$file_string = fread($file_handle, filesize($dir.$fileName.'.txt'));
		fclose($file_handle);
	} else {
		echo "Please enter letters or digits or space only!\n";
		redirect();
		exit;
	}
	
}
?>

<h1><a href="index.php">Simple Text Editor</a></h1>
	
<h2>Edit: <?php echo $fileName ?></h2>

<div>
<form method="get" action="index.php">
	<?php echo '<button type="submit" name="save" value="'.$fileName.'">Save</button>'; ?>
	<button type="button"><a class="link" href="index.php">Return</a></button>
	<br/>
	<textarea name="content" style="width:300px; height:200px;"><?php echo $file_string ?></textarea>

</form>
</div>
</body>
</html>