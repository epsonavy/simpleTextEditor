<?php

namespace nighthawk\hw3\models;

require_once('model.php');

class NewListModel extends Model {

    public function addList($title, $parent_ID) {
        $query = "INSERT INTO Lists (category, parent_ID) VALUES ($title, $parent_ID)";
        $result = mysqli_query($this->mysql, $query);

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: ".$this->mysql."<br>".mysqli_error($this->mysql);
        }
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
}

?>