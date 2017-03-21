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
		$paths = $data[2];
		$currentList= $data[3];

		$h1 = new \nighthawk\hw3\elements\H1();
		$li = new \nighthawk\hw3\elements\Li();
		$link = new \nighthawk\hw3\elements\Link();
		$div = new \nighthawk\hw3\elements\Div();
		$layout = new \nighthawk\hw3\layouts\HtmlLayout();

		$titleLink = array("index.php", "Note-A-List");

		$newListLink = array("index.php?c=newList&list_ID=".$currentList[0]['list_ID'], "New List");
		$newNoteLink = array("index.php?c=newNote&list_ID=".$currentList[0]['list_ID'], "New Note");

		echo $layout->renderBeforeBody();

		$currentPath = "";
		if (sizeof($paths) >= 3) {
			$paths = $this->shorterPath($paths);
		}
		if ($paths) {
			foreach ($paths as $path) {
				// shorterPath
				if ($path[0] == "..") {
					$tempLink = array("","..");
				} else {
					$tempLink = array("index.php?c=sublist&list_ID=".$path[1], $path[0]); 
				}
				$currentPath = $currentPath.'/'.$link->render($tempLink);
			}
		}
		echo $h1->render($link->render($titleLink).$currentPath);

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

	function shorterPath($paths) {
		// paths have 2 elements of array in each chunck. 
		// For example, path is the one of chucks
		// path[0] represents Category
		// path[1] represents List_ID
		if (sizeof($paths) < 3) {
			return $paths;
		} else {
			$size = sizeof($paths);
			$paths[0][0] = "..";
			for ($i = 1; $i < $size - 2; ++$i) {
				unset($paths[$i]);
			}
			return $paths;
		}
	}
}

?>