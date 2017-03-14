<?php

namespace nighthawk\hw3\helpers;

require_once('helper.php');

class Form extends Helper {
	public function render($data) {
		echo '<form method="get" action="index.php"><input type="hidden" name="c" value="sublist" /><input type="hidden" name="list_ID" value="'.$data.'" /><input name="new" /><input type="submit" value="Add" /></form>';
	}
}
?>