<?php
	$address = 'localhost';
	$dname = 'thejaco2_moviejournal';
	$user = 'journal';
	$pass = 'cscd378';
	
	
	/*Connecting to the database*/
	$db = new mysqli($address,$user,$pass,$dname);
	$sqlQuery = '';
	$resultSet = false;
	
	if($db->connect_errno > 0){
	    die('Unable to connect to database [' . $db->connect_error . ']');
	}

?>