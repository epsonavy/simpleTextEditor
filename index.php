<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Simple Text Editor</title>
</head>
<body>

<?php

// Initial variables 
$new_file = $to_delete = $save = $content = "";

function check_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check new if isSet
if (isset($_GET["new"])) {

	$new_file = check_input($_GET["new"]);

	// Validing input file name
	if ($new_file === "") {
		echo "an empty string is not acceptable\n";
	} else if (ctype_alnum($new_file)) {
		// Valid file name
		$fileHandle = fopen($new_file.".txt", "w");

	} else {
		echo "Please enter letters or digits as fileName!\n";
	}
	
} else if (isset($_GET["toDelete"])) {

	$to_delete = check_input($_GET["toDelete"]);
	unlink($to_delete.".txt"); 
} else if (isset($_GET["save"])) {

	$save = check_input($_GET["save"]);
	$content = $_GET["content"];
	file_put_contents($save.".txt", $content);
}

$dir = '.';
$array = array();

if (is_dir($dir)) {
	foreach(scandir($dir) as $file) {
		$ext = pathinfo($file, PATHINFO_EXTENSION);
	    
	    if (strtolower($ext) === 'txt') {
			$fileName = pathinfo($file, PATHINFO_FILENAME);
			array_push($array, $fileName);
		}
	}
}

?>

<h1><a href="index.php">Simple Text Editor</a></h1>

<form method="get" action="index.php">
	<input type="text" name="new" placeholder="Text File Name" />
	<button type="submit" >Create</button>

</form>
	
<h2>My Files</h2>

<table>
	<th>Filename</th><th colspan="2">Actions</th>
	<?php

	if (empty($array)) {
		echo '<tr><td>No files exist.</td></tr>';
	} else {
		foreach ($array as $key => $value) {
			echo '<tr><td><a href="read.php?fileName='.$value.'"">'.$value.'</a></td>';

			echo '<td><form method="get" action="edit.php">';
			echo '<button type="submit" name="fileName" value='.$value.'>Edit</button></td>';

			echo '<td><form method="get" action="confirm.php">';
			echo '<button type="submit" name="deleteFile" value='.$value.'>Delete</button></form></td>';
			echo '</tr>';
		}
	}
	?>
	
</table>


</body>
</html>