<?php

// Initial directory variables 
$dir = 'text_files/';

// Check and validate arguments

$new_file = (isset($_REQUEST['new'])) ? filter_var($_REQUEST['new'], FILTER_SANITIZE_STRING) : "";

if ($new_file) {
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

// Simple sanitizer data
function check_input($data) {
    $data = trim($data);
    return $data;
}

// Determine which activity to perform and call it
$activity = (isset($_REQUEST['a']) && in_array($_REQUEST['a'], [
    "landing", "edit", "read", "confirm"])) ? $_REQUEST['a'] . "Controller" : "landingController";

// Run activity accordingly
if (ctype_alnum(str_replace(' ','',$new_file))) {
    $array = array();
    array_push($array, $new_file);
    htmlLayout($array, "editView");
} else {
    $activity($dir);
}
//=================Controller Below===========================================

/**
 * Used to process perform activities realated to the landing page
 */
function landingController($dir) {
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
    htmlLayout($array, "landingView");
}

/**
 * Used to process perform activities realated to the read page
 */
function readController($dir) {
    $array = array();
    $fileName = (isset($_REQUEST['fileName'])) ? filter_var($_REQUEST['fileName'], FILTER_SANITIZE_STRING) : "";
    array_push($array, $fileName);

    if ($fileName) {
        $file_handle = fopen($dir.$fileName.'.txt', "r"); 
        $file_string = fread($file_handle, filesize($dir.$fileName.'.txt'));
        fclose($file_handle);
        array_push($array, $file_string);
    }
    htmlLayout($array, "readView");
}

/**
 * Used to process perform activities realated to the edit page
 */
function editController($dir) {
    $array = array();
    $fileName = (isset($_REQUEST['fileName'])) ? filter_var($_REQUEST['fileName'], FILTER_SANITIZE_STRING) : "";
    array_push($array, $fileName);

    if ($fileName) {
        $file_handle = fopen($dir.$fileName.'.txt', "r"); 
		 $file_string = fread($file_handle, filesize($dir.$fileName.'.txt'));
        fclose($file_handle);
        array_push($array, $file_string);
    }
    htmlLayout($array, "editView");
}

/**
 * Used to process perform activities realated to confirm delete file page
 */
function confirmController($dir) {
    $fileName = (isset($_REQUEST['fileName'])) ? filter_var($_REQUEST['fileName'], FILTER_SANITIZE_STRING) : "";

    htmlLayout($fileName, "confirmView");
}

//=================Controller Above ========================================== 

//===================View Below===============================================
/**
 * Used to output the top and bottom boilerplate of a Web page. Within
 * the body of the document the passed $view is draw
 *
 * @param array $data an associative array of field variables which might
 *  be echo'd by either this layout in the title, or by the view that is
 *  draw in the body
 * @param string $view name of view function to call to draw body of web page
 */
function htmlLayout($data, $view) {

    ?><!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Simple Text Editor</title>
    </head>
    <body>
        <?php
        $view($data);
        ?>
    </body>
</html><?php
}

/**
 * Used to draw the main landing page
 *
 * @param array $data contains all file names
 */
function landingView($data) {
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

    if (empty($data)) {
        echo '<tr><td>No files exist.</td></tr>';
    } else {
        foreach ($data as $key => $value) {
            echo "<tr><td><a href=\"index.php?a=read&fileName={$value}\">{$value}</a></td><td><form method=\"get\" action=\"index.php\"><input type=\"hidden\" name=\"a\" value=edit><button type=\"submit\" name=\"fileName\" value=\"{$value}\">Edit</button></form></td><td><form method=\"get\" action=\"index.php\"><input type=\"hidden\" name=\"a\" value=confirm><button type=\"submit\" name=\"fileName\" value=\"{$value}\">Delete</button></form></td></tr>";
        }
    }
    ?>
    
</table><?php
}

/**
 * Used to draw the read page
 *
 * @param array $data contains opening file name and its content
 */
function readView($data) {
?>
<h1><a href="index.php">Simple Text Editor</a></h1>
<h2>Read: <?=$data[0] ?></h2>
<br/>
    <div>
    <?=$data[1] ?>
    </div><?php
}

/**
 * Used to draw the edit page
 *
 * @param array $data contains editing file name and its content
 */
function editView($data) {
?>
<style>
.link {
    text-decoration: none;
</style>
<h1><a href="index.php">Simple Text Editor</a></h1>   
<h2>Edit: <?=$data[0] ?></h2>

    <div>
    <form method="get" action="index.php">
        <?php echo '<button type="submit" name="save" value="'.$data[0].'">Save</button>'; ?>
        <button type="button"><a class="link" href="index.php">Return</a></button>
        <br/>
		<?php 
		 if(isset($data[1])) {
			echo  "<textarea name='content' style='width:300px; height:200px;'>s$data[1]</textarea>";
		 }
		 else 
	     {
			echo  '<textarea name="content" style="width:300px; height:200px;" placeholder="Enter something here!"></textarea>'; 
		 }
		 ?>
		  
	    
		</textarea>

    </form>
    </div><?php
}

/**
 * Used to draw the confirm page
 *
 * @param array $data contains to delete file name
 */
function confirmView($data) {
?>
<style>
input {
    display: none;
}
.link {
    text-decoration: none;
}
</style>

<h1><a href="index.php">Simple Text Editor</a></h1>

<form action="index.php">

    <p>Are you sure you want to delete the file:
    <b><?=$data ?></b> ?</p>
    <?php echo '<input type="text" name="toDelete" value="'.$data.'" />' ?>
    <button type="submit">Confirm</button>
    <button type="button"><a class="link" href="index.php">Cancel</a></button>
</form><?php
}

?>
