<?php

namespace nighthawk\hw3\models;

require_once('model.php');

class DisplayNoteModel extends Model {

    public function getCurrentNote($note_ID) {
        $query = "SELECT * FROM Notes WHERE note_ID = ".$note_ID;
        $result = mysqli_query($this->mysql, $query);
        $array = array();
        while($row = mysqli_fetch_assoc($result)) {
            $note['note_ID'] = $row['note_ID'];
            $note['list_ID'] = $row['list_ID'];
            $note['title'] = $row['title'];
            $note['date'] = $row['date'];
            $note['content'] = $row['content'];
            array_push($array, $note);
        }
        if($result) {
            $result->free();
        }
        return $array;
    }

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
}

?>