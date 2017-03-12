<?php

namespace nighthawk\hw3\models;

require_once('model.php');

class LandingModel extends Model {

    public function getLists() {
        $query = "SELECT list_ID, category From Lists";
        $result = mysqli_query($this->mysql, $query);
        $array = array();
        while($row = mysqli_fetch_assoc($result)) {
            $note['list_ID'] = $row['list_ID'];
            $note['category'] = $row['category'];
            array_push($array, $note);
        }
        $result->free();
        return $array;
    }

    public function getNotes() {
        $query = "SELECT title, date From Notes ORDER BY date";
        $result = mysqli_query($this->mysql, $query);
        $array = array();
        while($row = mysqli_fetch_assoc($result)) {
            $note['title'] = $row['title'];
            $note['date'] = $row['date'];
            array_push($array, $note);
        }
        $result->free();
        return $array;
    }
}

?>