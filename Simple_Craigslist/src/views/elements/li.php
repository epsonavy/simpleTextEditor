<?php

namespace nighthawk\hw3\elements;

require_once('element.php');

class Li extends Element {
	public function render($data) {
		return "<li>".$data."</li>";
	}
}

?>