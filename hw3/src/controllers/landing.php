<?php

namespace nighthawk\hw3\controllers;

require_once('controller.php');

class LandingController extends Controller {

    public function handleRequest($data) { 
        $model = new \nighthawk\hw3\models\LandingModel();
        $view = new \nighthawk\hw3\views\LandingView();
        $array = Array();

        $model->initConnection();
        array_push($array, $model->getLists());
        array_push($array, $model->getNotes());

        $view->render($array);
    }

}

?>