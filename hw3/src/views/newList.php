<?php

namespace nighthawk\hw3\views;

require_once('view.php');
require_once('elements/h1.php');
require_once('elements/link.php');
require_once('elements/div.php');
require_once('layouts/html_layout.php');
require_once('helpers/form.php');

class NewListView extends View {
	public function render($data) {

		$paths = $data[0];
		$currentList = $data[1];

		$h1 = new \nighthawk\hw3\elements\H1();
		$link = new \nighthawk\hw3\elements\Link();
		$div = new \nighthawk\hw3\elements\Div();
		$layout = new \nighthawk\hw3\layouts\HtmlLayout();
		$form = new \nighthawk\hw3\helpers\Form();

		$titleLink = array("index.php", "Note-A-List");

		echo $layout->renderBeforeBody();

		$currentPath = "";
		if ($paths) {
			foreach ($paths as $path) {
				$tempLink = array("index.php?c=sublist&list_ID=".$path[1], $path[0]);
				$currentPath = $currentPath.'/'.$link->render($tempLink);
			}
		}
		echo $h1->render($link->render($titleLink).$currentPath);

		echo $div->renderDiv("nostyle", "New List");

		$form->render($currentList[0]['list_ID']);

		echo $div->renderEnd();;
		
		echo $layout->renderAfterBody();
	}
}

?>