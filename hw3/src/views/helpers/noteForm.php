<?php

namespace nighthawk\hw3\helpers;

require_once('helper.php');

class NoteForm extends Helper {
	public function render($data) {
		echo '<form method="get" action="index.php"><input type="hidden" name="c" value="sublist" /><input type="hidden" name="list_ID" value="'.$data.'" /><lable>Title:<input name="title" /><br/>Note<br/></label><textarea name="description" id="noteFom" row="10" cols="50"></textarea><br/><input type="submit" value="Save" /></form>';
	}
}
?>