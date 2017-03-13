<?php

namespace nighthawk\hw3\elements;

require_once('element.php');

class Div extends Element {
	public function render($data) {
		return '<div>'.$data.'</div>';
	}

	public function renderDiv($class, $title) {
		return '<div class="'.$class.'"><h2>'.$title.'</h2><ul>';
	}

	public function renderEnd() {
		return '</ul></div>';
	}
}

?>