<?php

namespace nighthawk\hw3\models;

class Model {
	protected $mysql;
	public function initConnection() {
		$this->mysql = mysqli_connect(DB_ADDRESS, DB_USER, DB_PASS, DB_USE);
		if(!$this->mysql){
			echo "Could not connect to MySQL!!";
			exit;
		}
	}
}

?>