<?php

namespace nighthawk\hw3\views;

require_once('view.php');
require_once('elements/h1.php');
require_once('elements/link.php');
require_once('layouts/html_layout.php');
//require_once('helpers/form.php');

class LandingView extends View {
	public function render($data){

		$h1 = new \nighthawk\hw3\elements\H1();
		$link = new \nighthawk\hw3\elements\Link();
		$layout = new \nighthawk\hw3\layouts\HtmlLayout();

		$titleLink = array("index.php", "Note-A-List");

		echo $layout->renderBeforeBody();

		echo $h1->render($link->render($titleLink));

		echo '<div class="left"><h2>Lists</h2><ul>';
		echo '<li>[<a href=".">New List</a>]</li>';
		foreach ($data[0] as $value) {
			echo '<li><b><a href="index.php?c=sublist&category='.$value['list_ID'].'"">'.$value['category'].'</a></b></li>';

		}
		echo '</ul></div>';

		echo '<div class="right"><h2>Notes</h2><ul>';
		echo '<li>[<a href=".">New Note</a>]</li>';
		foreach ($data[1] as $key => $value) {
			echo '<li><b><a href=".">'.$value['title'].'</a></b> '.date('Y-m-d',strtotime($value['date'])).'</li>';
		}
		echo '</ul></div>';

		echo $layout->renderAfterBody();
	}
}

?>