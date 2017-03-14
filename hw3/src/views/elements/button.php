<?php

namespace nighthawk\hw3\elements;

require_once('element.php');

class Button extends Element {
	public function render($data) {
		return '<button type="submit">'.$data.'</button>';
	}
}

?>