<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Simple Text Editor</title>
</head>

<style>

input {
    display: none;
}

.link {
	text-decoration: none;
}

</style>

<body>
<h1><a href="index.php">Simple Text Editor</a></h1>

<?php 
// Check deleteFile if isSet
if (isset($_GET["deleteFile"])) {
	$file = $_GET["deleteFile"];
}

?>

<form action="index.php">

	<p>Are you sure you want to delete the file:
	<b><?php echo $file ?></b> ?</p>
	<?php echo '<input type="text" name="toDelete" value="'.$file.'" />' ?>
	<button type="submit">Confirm</button>
	<button type="button"><a class="link" href="index.php">Cancel</a></button>
</form>

</body>
</html>