<?php

namespace nighthawk\hw3\elements;

require_once('element.php');

class H1 extends Element {
	public function render($data) {
		return "<h1>".$data."</h1>";
	}
}

?>