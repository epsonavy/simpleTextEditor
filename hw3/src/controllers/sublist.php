<?php

namespace nighthawk\hw3\controllers;

require_once('controller.php');

class SublistController extends Controller {

    public function handleRequest($req) { 

        $new = (isset($_REQUEST['new'])) ? filter_var($req['new'], FILTER_SANITIZE_STRING) : "";
        print_r($new);
    

        $model = new \nighthawk\hw3\models\SublistModel();
        $view = new \nighthawk\hw3\views\SublistView();
        $array = Array();

        $model->initConnection();
        
        array_push($array, $model->getLists($req['list_ID']));
        array_push($array, $model->getNotes($req['list_ID']));
        $parents = $this->getParents($req['list_ID']);
        array_push($array, $parents);
        array_push($array, $model->getCurrentList($req['list_ID']));

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

