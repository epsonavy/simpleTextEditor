<?php

include 'src/configs/Config.php';
// No need to include 'src/configs/CreateDB.php'; * Use on command line

// Included all MVC modules

include 'src/models/landing.php';
include 'src/views/landing.php';
include 'src/controllers/landing.php';

include 'src/models/sublist.php';
include 'src/views/sublist.php';
include 'src/controllers/sublist.php';

include 'src/models/newList.php';
include 'src/views/newList.php';
include 'src/controllers/newList.php';

include 'src/models/displayNote.php';
include 'src/views/displayNote.php';
include 'src/controllers/displayNote.php';

// Debug use only
ini_set('display_errors', 1);
error_reporting(~0);

if(isset($_REQUEST['c'])) {
    $controller = $_REQUEST['c'];
    
    if($controller == "sublist") {
        $sublistController = new nighthawk\hw3\controllers\SublistController();
        $sublistController->handleRequest($_REQUEST);
    } else if($controller == "newList") {
        $newListController = new nighthawk\hw3\controllers\NewListController();
        $newListController->handleRequest($_REQUEST);
    } else if ($controller == "newNote") {
        $newNoteController = new nighthawk\hw3\controllers\NewNoteController();
        $newNoteController->handleRequest($_REQUEST);
    } else if ($controller == "displayNote") {
        $displayNoteController = new nighthawk\hw3\controllers\DisplayNoteController();
        $displayNoteController->handleRequest($_REQUEST);
    }
} else {
    $landingController = new nighthawk\hw3\controllers\LandingController();
    $landingController->handleRequest($_REQUEST);
}

?>



