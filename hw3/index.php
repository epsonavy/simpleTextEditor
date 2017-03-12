<?php

include 'src/configs/Config.php';
//include 'src/configs/CreateDB.php';

// Included all MVC modules

include 'src/models/landing.php';

include 'src/views/landing.php';

include 'src/controllers/landing.php';


if(isset($_REQUEST['c'])){
    $controller = $_REQUEST['c'];
    /*
    if($controller == "read"){
        $readController = new nighthawk\hw3\controllers\ReadController();
        $readController->handlerRequest($_REQUEST);
    }else if($controller == "write"){
        $writeController = new nighthawk\hw3\controllers\WriteController();
        $writeController->handleRequest($_REQUEST);
    } else if ($controller == "landing") {
        $landingController = new nighthawk\hw3\controllers\LandingController();
        $landingController->handleRequest($_REQUEST);
    }*/
}else{
    $landingController = new nighthawk\hw3\controllers\LandingController();
    $landingController->handleRequest($_REQUEST);
}

?>



