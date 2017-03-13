<?php

namespace nighthawk\hw3\views;

require_once('view.php');
require_once('elements/h1.php');
require_once('elements/li.php');
require_once('elements/link.php');
require_once('elements/div.php');
require_once('layouts/html_layout.php');

class DisplayNoteView extends View {
	public function render($data) {

		$h1 = new \nighthawk\hw3\elements\H1();
		$li = new \nighthawk\hw3\elements\Li();
		$link = new \nighthawk\hw3\elements\Link();
		$div = new \nighthawk\hw3\elements\Div();
		$layout = new \nighthawk\hw3\layouts\HtmlLayout();

		$titleLink = array("index.php", "Note-A-List");
		$sublistLink = array("index.php?c=sublist&list_ID=".$data[1][0]['list_ID'], $data[1][0]['category']);
		$newListLink = array(".", "New List");
		$newNoteLink = array(".", "New Note");

		echo $layout->renderBeforeBody();

		echo $h1->render($link->render($titleLink).'/'.$link->render($sublistLink));

		echo $div->renderDiv("", "Note: ".$data[0][0]['title']);

		echo $data[0][0]['content'];

		echo $div->renderEnd();;
		echo $layout->renderAfterBody();
	}
}

?>