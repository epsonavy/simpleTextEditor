<?php

namespace nighthawk\hw3\elements;

require_once('element.php');

class Input extends Element {
	public function render($data) {
		return "<input>".$data."</input>";
	}
}

?>