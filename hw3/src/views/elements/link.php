<?php

namespace nighthawk\hw3\elements;

require_once('element.php');

class Link extends Element {
	public function render($data){
		if ($data[1] != "..") {
			return "<a href='".$data[0]."'>".$data[1]."</a>"; 
		} else {
			return $data[1];
		}
	}
}

?>