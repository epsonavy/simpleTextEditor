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
        
        $currentList = $currentNote[0];
        $parents = $this->getParents($currentList['list_ID']);
        array_push($array, $parents);

        $view->render($array);
    }

    function getParents($list_ID) {
        if ($list_ID == 0) {
            return FALSE;
        }

        $model = new \nighthawk\hw3\models\SublistModel();
        $model->initConnection();
        $results = array();
        $ID = $list_ID;
        $currentList = $model->getParent($ID);

        while($currentList[0]['parent_ID'] != 0) {
            $parent_ID = $currentList[0]['parent_ID'];
            $category = $currentList[0]['category'];
            $ID = $currentList[0]['list_ID'];
            array_unshift($results, [$category, $ID]);
            $currentList = $model->getParent($parent_ID);
        }

        $ID = $currentList[0]['list_ID'];
        $category = $currentList[0]['category'];
        array_unshift($results, [$category, $ID]);
        return $results;
    }

}

?>

