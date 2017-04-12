<?php

namespace nighthawk\hw3\models;

require_once('model.php');

class NewNoteModel extends Model {

    public function getParent($list_ID) {
        $array = array();
        if ($list_ID == 0) {
            $note['parent_ID'] = 0;
            array_push($array, $note);
            return $array;
        } else {
            $query = "SELECT * From Lists WHERE list_ID = ".$list_ID;
            $result = mysqli_query($this->mysql, $query);
            while($row = mysqli_fetch_assoc($result)) {
                $note['list_ID'] = $row['list_ID'];
                $note['category'] = $row['category'];
                $note['parent_ID'] = $row['parent_ID'];
                array_push($array, $note);
            }
            if($result) {
                $result->free();
            }
        }
        return $array;
    }

    public function getCurrentList($list_ID) {
        $array = array();
        if ($list_ID == 0) {
            $note['list_ID'] = 0;
            array_push($array, $note);
            return $array;
        } else {
            $query = "SELECT * From Lists WHERE list_ID = ".$list_ID;
            $result = mysqli_query($this->mysql, $query);
            while($row = mysqli_fetch_assoc($result)) {
                $note['list_ID'] = $row['list_ID'];
                $note['category'] = $row['category'];
                $note['parent_ID'] = $row['parent_ID'];
                array_push($array, $note);
            }
            if($result) {
                $result->free();
            }
        }
        return $array;
    }
}

?>