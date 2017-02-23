<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Simple Text Editor</title>
</head>
<body>

<?php

// Initial variables 
$dir = 'text_files/';
$new_file = $to_delete = $save = $content = "";

function check_input($data) {
    $data = trim($data);
    return $data;
}

// Check if isSet
if (isset($_GET["new"])) {

	$new_file = check_input($_GET["new"]);

	// Validing input file name
	if ($new_file === "") {
		echo "Invalid File Name!\n";
	} else if (ctype_alnum(str_replace(' ','',$new_file))) {
		// Valid file name
		$fileHandle = fopen($dir.$new_file.".txt", "w");
	} else {
		echo "Please enter letters or digits or space only!\n";
	}
	
} else if (isset($_GET["toDelete"])) {

	$to_delete = check_input($_GET["toDelete"]);
	unlink($dir.$to_delete.".txt"); 
} else if (isset($_GET["save"])) {

	$save = check_input($_GET["save"]);
	$content = $_GET["content"];
	file_put_contents($dir.$save.".txt", $content);
}

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

<form method="get" action="edit.php">
	<input type="hidden" name="dir" value="<?=$dir ?>" />
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
			echo "<tr><td><a href=\"read.php?fileName={$value}&dir={$dir}\">{$value}</a></td><td><form method=\"get\" action=\"edit.php\"><input type=\"hidden\" name=\"dir\" value={$dir}><button type=\"submit\" name=\"fileName\" value=\"{$value}\">Edit</button></form></td><td><form method=\"get\" action=\"confirm.php\"><button type=\"submit\" name=\"deleteFile\" value=\"{$value}\">Delete</button></form></td></tr>";
		}
	}
	?>
	
</table>


</body>
</html>