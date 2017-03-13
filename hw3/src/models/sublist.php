<?php

namespace nighthawk\hw3\models;

require_once('model.php');

class SublistModel extends Model {

    public function getCurrentList($list_ID) {
        $query = "SELECT list_ID, category From Lists WHERE list_ID = ".$list_ID;
        $result = mysqli_query($this->mysql, $query);
        $array = array();
        while($row = mysqli_fetch_assoc($result)) {
            $note['list_ID'] = $row['list_ID'];
            $note['category'] = $row['category'];
            array_push($array, $note);
        }
        if($result) {
            $result->free();
        }
        return $array;
    }

    public function getLists($list_ID) {
        $query = "SELECT list_ID, category From Lists WHERE list_ID != ".$list_ID;
        $result = mysqli_query($this->mysql, $query);
        $array = array();
        while($row = mysqli_fetch_assoc($result)) {
            $note['list_ID'] = $row['list_ID'];
            $note['category'] = $row['category'];
            array_push($array, $note);
        }
        if($result) {
            $result->free();
        }
        return $array;
    }

    public function getNotes($list_ID) {
        $query = "SELECT note_ID, title, date From Notes WHERE Notes.list_ID = ".$list_ID." ORDER BY date";
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