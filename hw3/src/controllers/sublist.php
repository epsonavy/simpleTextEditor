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

     
        $tree = $this->buildTree($model->getAll($req['list_ID']));
        array_push($array, $tree);


        $children = $this->getChildren($tree, $req['list_ID']);
        array_push($array, $children);

        $view->render($array);
    }

    function getChildren(array $elements, $list_ID) {
        $results = array();
        foreach ($elements as $ele) {
            if ($ele['parent_ID'] == $list_ID) { 
                $results[] = $ele;
            }
            if (isset($ele['children']) && count($ele['children']) > 0 && ($children = $this->getChildren($ele['children'], $list_ID)) !== FALSE) {
                $results = array_merge($results, $children);
            }
        }

        return count($results) > 0 ? $results : FALSE;
    }

    // Build tree structure for all sub lists
    function buildTree(array $elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $ele) {
            if ($ele['parent_ID'] == $parentId) {
                $children = $this->buildTree($elements, $ele['list_ID']);
                if ($children) {
                    $ele['children'] = $children;
                }
                $branch[] = $ele;
            }
        }
        return $branch;
    }

}

?>

