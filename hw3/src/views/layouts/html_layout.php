<?php

namespace nighthawk\hw3\layouts;

require_once('layout.php');

class HtmlLayout extends Layout {

	public function render($data) {
		return;
	}
	
	public function renderBeforeBody() {

	    ?><!DOCTYPE html>
	    <html>
	    <head>
	        <meta charset="UTF-8">
	        <title>Note-A-List</title>
	        <link rel='stylesheet' href='src/styles/style.css' type='text/css' />
	    </head>
	    <body>
	    <?php
	}
	
	public function renderAfterBody() {

	    ?>
	    </body>
		</html><?php
	}

}

?>