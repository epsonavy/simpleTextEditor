<?php

namespace nighthawk\hw3\elements;

require_once('element.php');

class HiddenInput extends Element {
	public function render($data) {
		return '<input type="hidden" name="list_ID">'.$data.'</input>';
	}
}

?>