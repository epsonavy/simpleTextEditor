<?php

namespace nighthawk\hw3\controllers;

class Controller {

    public function handleRequest($req) {

    }

    public function sanitize($arg) {
    	return (isset($arg)) ?
	        filter_var($arg, FILTER_SANITIZE_STRING) : "";
	}

	public function filter_POST($arg) {
        return filter_input(INPUT_POST, $arg, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function filter_GET($arg) {
        return filter_input(INPUT_GET, $arg, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}

?>