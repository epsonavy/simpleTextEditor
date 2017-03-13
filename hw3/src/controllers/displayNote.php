<?php

namespace nighthawk\hw3\controllers;

require_once('controller.php');

class DisplayNoteController extends Controller {

    public function handleRequest($req) { 
        
        $model = new \nighthawk\hw3\models\DisplayNoteModel();
        $view = new \nighthawk\hw3\views\DisplayNoteView();
        $array = Array();

        $model->initConnection();
        
        $currentNote = $model->getCurrentNote($req['note_ID']);
        array_push($array, $currentNote);
        
        array_push($array, $model->getCurrentList($currentNote[0]['list_ID']));

        $view->render($array);
    }

}

?>

