<?php
    
    // Before run command line "php CreateDb.php"
    // Make sure MySQL datebase setting is corret in file config.php 
    require_once('./Config.php'); 

    // Create database
    $mysql = mysqli_connect(DB_ADDRESS, DB_USER, DB_PASS);
    if (!$mysql) {
        die('Could not connect to MySQL: ' . mysql_error());
    }

    $db = mysqli_select_db($mysql, DB_USE);
    if (!$db) {
    $query = 'CREATE DATABASE '.DB_USE;
    if (!mysqli_query($mysql, $query)) {
      echo 'Error creating database: '. DB_USE . mysql_error() . "\n";
    }
    }
    mysqli_close($mysql);

    // Create Table
    $db = mysqli_connect(DB_ADDRESS, DB_USER, DB_PASS, DB_USE);

    $query = "SELECT list_ID FROM Lists";
    $result = mysqli_query($db, $query);
    if(empty($result)) {
        $query = "CREATE TABLE Lists (
                    list_ID INT AUTO_INCREMENT,
                    category VARCHAR(255) NOT NULL,
                    parent_ID INT DEFAULT 0,
                    PRIMARY KEY (list_ID)
                )";
        $result = mysqli_query($db, $query);
    }

    $query = "SELECT note_ID FROM Notes";
    $result = mysqli_query($db, $query);
    if(empty($result)) {
        $query = "CREATE TABLE Notes (
                    note_ID INT AUTO_INCREMENT,
                    list_ID VARCHAR(255) NOT NULL,
                    title VARCHAR(255) NOT NULL,
                    content TEXT,
                    date TIMESTAMP,
                    PRIMARY KEY (note_ID, list_ID)
                )";
        $result = mysqli_query($db, $query);
    }

    $db->close();
    echo 'Created database: '. DB_USE .' successfully!'."\n" ;
?>