<?php

namespace nighthawk\hw3\controllers;

require_once('controller.php');

class SublistController extends Controller {

    public function handleRequest($req) { 
        $model = new \nighthawk\hw3\models\SublistModel();
        $view = new \nighthawk\hw3\views\SublistView();
        $array = Array();

        $model->initConnection();
        
        array_push($array, $model->getLists($req['list_ID']));
        array_push($array, $model->getNotes($req['list_ID']));
        array_push($array, $model->getCurrentList($req['list_ID']));

        $view->render($array);
    }

}

?>

