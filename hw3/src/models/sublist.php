<?php

namespace nighthawk\hw3\models;

require_once('model.php');

class SublistModel extends Model {

    public function getCurrentList($list_ID) {
        $query = "SELECT * From Lists WHERE list_ID = ".$list_ID;
        $result = mysqli_query($this->mysql, $query);
        $array = array();
        while($row = mysqli_fetch_assoc($result)) {
            $note['list_ID'] = $row['list_ID'];
            $note['category'] = $row['category'];
            $note['parent_ID'] = $row['parent_ID'];
            array_push($array, $note);
        }
        if($result) {
            $result->free();
        }
        return $array;
    }

    public function getAll($list_ID) {
        $query = "SELECT * From Lists";
        $result = mysqli_query($this->mysql, $query);
        $array = array();
        while($row = mysqli_fetch_assoc($result)) {
            $note['list_ID'] = $row['list_ID'];
            $note['category'] = $row['category'];
            $note['parent_ID'] = $row['parent_ID'];
            array_push($array, $note);
        }
        if($result) {
            $result->free();
        }
        return $array;
    }

    public function getParent($list_ID) {
        $array = array();
        if ($list_ID == 0) {
            $note['parent_ID'] = 0;
            array_push($array, $note);
            return $array;
        }
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
        return $array;
    }

    public function getChild($list_ID) {
        $query = "SELECT * From Lists WHERE parent_ID = ".$list_ID;
        $result = mysqli_query($this->mysql, $query);
        $array = array();
        while($row = mysqli_fetch_assoc($result)) {
            $note['list_ID'] = $row['list_ID'];
            $note['category'] = $row['category'];
            $note['parent_ID'] = $row['parent_ID'];
            array_push($array, $note);
        }
        if($result) {
            $result->free();
        }
        return $array;
    }

    public function isLeaf($list_ID) {
        $query = "SELECT * From Lists WHERE parent_ID = ".$list_ID;
        $result = mysqli_query($this->mysql, $query);

        if (empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function getLists($list_ID) {
        $query = "SELECT * From Lists WHERE Lists.list_ID != ".$list_ID." AND Lists.parent_ID = ".$list_ID." ORDER BY Lists.category";
        $result = mysqli_query($this->mysql, $query);
        $array = array();
        while($row = mysqli_fetch_assoc($result)) {
            $note['list_ID'] = $row['list_ID'];
            $note['category'] = $row['category'];
            $note['parent_ID'] = $row['parent_ID'];
            array_push($array, $note);
        }
        if($result) {
            $result->free();
        }
        return $array;
    }

    public function getNotes($list_ID) {
        $query = "SELECT * From Notes WHERE Notes.list_ID = ".$list_ID." ORDER BY date DESC";
        $result = mysqli_query($this->mysql, $query);
        $array = array();
        while($row = mysqli_fetch_assoc($result)) {
            $note['note_ID'] = $row['note_ID'];
            $note['title'] = $row['title'];
            $note['date'] = $row['date'];
            array_push($array, $note);
        }
        if($result) {
            $result->free();
        }
        return $array;
    }

}

?>