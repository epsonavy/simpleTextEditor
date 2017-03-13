<?php

namespace nighthawk\hw3\views;

require_once('view.php');
require_once('elements/h1.php');
require_once('elements/li.php');
require_once('elements/link.php');
require_once('elements/div.php');
require_once('layouts/html_layout.php');

class SublistView extends View {
	public function render($data) {

		$getLists = $data[0];
		$getNotes = $data[1];
		$getCurrentList = $data[2];
		$tree = $data[3];
		$subTree = $data[4];

		$h1 = new \nighthawk\hw3\elements\H1();
		$li = new \nighthawk\hw3\elements\Li();
		$link = new \nighthawk\hw3\elements\Link();
		$div = new \nighthawk\hw3\elements\Div();
		$layout = new \nighthawk\hw3\layouts\HtmlLayout();

		$titleLink = array("index.php", "Note-A-List");
		$sublistLink = array("index.php?c=sublist&list_ID=".$getCurrentList[0]['list_ID'], $getCurrentList[0]['category']);
		$newListLink = array(".", "New List");
		$newNoteLink = array(".", "New Note");

		echo $layout->renderBeforeBody();

		
		//echo 'Here are my tree:';
		//print_r($subTree);
		
		echo $h1->render($link->render($titleLink).'/'.$link->render($sublistLink));

		echo $div->renderDiv("left", "Lists");
		echo $li->render('['.$link->render($newListLink).']');
		foreach ($getLists as $value) {
			$myLink = array('index.php?c=sublist&list_ID='.$value['list_ID'], $value['category']);
			echo $li->render('<b>'.$link->render($myLink).'</b>');

		}
		echo $div->renderEnd();;
		
		echo $div->renderDiv("right", "Notes");
		echo $li->render('['.$link->render($newNoteLink).']');
		foreach ($getNotes as $key => $value) {
			$myLink = array('index.php?c=displayNote&note_ID='.$value['note_ID'], $value['title']);
			echo $li->render($link->render($myLink).' '.date('Y-m-d',strtotime($value['date'])));
		}
		echo $div->renderEnd();;
		echo $layout->renderAfterBody();
	}
}

?>