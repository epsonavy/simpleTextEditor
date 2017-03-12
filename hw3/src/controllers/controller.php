<?php

namespace nighthawk\hw3\controllers;

class Controller {
    public function filter_Post($arg) {
        return filter_input(INPUT_POST, $arg, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function filter_Get($arg) {
        return filter_input(INPUT_GET, $arg, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function handleRequest($data){

    }
}

?>