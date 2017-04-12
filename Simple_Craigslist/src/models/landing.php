<?php

namespace nighthawk\hw3\models;

require_once('model.php');

class LandingModel extends Model {

    public function getLists() {
        $query = "SELECT * From Lists WHERE Lists.parent_ID = 0 ORDER BY category";
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

    public function getNotes() {
        $query = "SELECT * From Notes WHERE Notes.list_ID = 0 ORDER BY date DESC";
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