<?php

namespace nighthawk\hw3\views;

require_once('view.php');
require_once('elements/h1.php');
require_once('elements/link.php');
require_once('elements/div.php');
require_once('elements/input.php');
require_once('elements/button.php');
require_once('layouts/html_layout.php');

class NewListView extends View {
	public function render($data) {

		$paths = $data[0];

		$h1 = new \nighthawk\hw3\elements\H1();
		$link = new \nighthawk\hw3\elements\Link();
		$div = new \nighthawk\hw3\elements\Div();
		$input = new \nighthawk\hw3\elements\Input();
		$button = new \nighthawk\hw3\elements\Button();
		$layout = new \nighthawk\hw3\layouts\HtmlLayout();

		$titleLink = array("index.php", "Note-A-List");

		$newListLink = array(".", "New List");
		$newNoteLink = array(".", "New Note");

		echo $layout->renderBeforeBody();

		$currentPath = "";
		foreach ($paths as $path) {
			$tempLink = array("index.php?c=sublist&list_ID=".$path[1], $path[0]);
			$currentPath = $currentPath.'/'.$link->render($tempLink);
		}
		echo $h1->render($link->render($titleLink).$currentPath);

		echo $div->renderDiv("left", "New List");

		echo $input->render("").$button->render("Add");

		echo $div->renderEnd();;
		
		echo $layout->renderAfterBody();
	}
}

?>