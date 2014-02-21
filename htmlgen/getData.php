<?php

	//$userid; //int
	//$movieid; //int
	//$name; //varchar
	//$overview; //varchar
	//$date_released; //date
	//$director; //varchar
	//$run_length; //int (minutes)
	//$misc_facts; //varchar
	//$comments; //varchar
	//$writers; //2D array {firstname, lastname}
	//$crew; //2D array {firstname, lastname, position}
	//$cast; //2D array {firstname, lastname, role}
	//$producers; //2D array{firstname, lastname}
	//$production_companies; //1D array {name}

function getData(){
	//getting the movie data
	$resultSet = $db->query("SELECT * from movies where movies.id=$movieid");
	if(!$resultSet){
		die("Bad query for movie");
	}
	
	while($row = $resultSet->fetch_assoc()){
		$
	}
}

?>