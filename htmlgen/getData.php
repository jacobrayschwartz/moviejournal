<?php
	
	//$userid; //int
	//$movieid; //int
	//$name; //varchar
	//$overview; //varchar
	//$watched; //boolean
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


	//getting the movie data
	$resultSet = $db->query("SELECT * from movies where movies.id=$movieid");
	if(!$resultSet || $resultSet->num_rows != 1){
		die("Bad query for movie");
	}
	
	
	//Getting the info from the movie table
	$row = $resultSet->fetch_assoc();
	$name = $row['name'];
	$overview = $row['overview'];
	$date_released = $row['date_released'];
	$director = $row['director'];
	$run_length = $row['run_length'];
	$misc_facts = $row['misc_facts'];
	$comments = $row['comments'];
	
	//==========================================Getting watched
	$resultSet = $db->query("SELECT * FROM usermovies where movieid=$movieid");
	if(!$resultSet || $resultSet->num_rows != 1){
		die("Bad query for watched");
	}
	$row = $resultSet->fetch_assoc();
	$watched = $row['watched'];
	
	
	//==========================================Getting the writers
	$resultSet = $db->query("SELECT * FROM writers WHERE writers.movieid=$movieid");
	if(!$resultSet){
		die("Bad query for writers");
	}
	
	while($row = $resultSet->fetch_assoc()){
		//Adding a writer to the end
		$writers[] = array(
							"firstname" => $row['firstname'],
							"lastname" => $row['lastname']
							);
	}
	
	
	
	//==========================================Getting the production companies
	$resultSet = $db->query("SELECT * FROM production_companies WHERE production_companies.movieid=$movieid");
	if(!$resultSet){
		die("Bad query for production_companies");
	}
	
	while($row = $resultSet->fetch_assoc()){
		$production_companies[] = $row['name'];
	}
	
	
	
	
	//==========================================Getting the production companies
	$resultSet = $db->query("SELECT * FROM producers WHERE producers.movieid=$movieid");
	if(!$resultSet){
		die("Bad query for producers");
	}
	
	while($row = $resultSet->fetch_assoc()){
		$producers[] = array(
							"firstname" => $row['firstname'],
							"lastname" => $row['lastname']
							);
	}
	
	//==========================================Getting the crew
	$resultSet = $db->query("SELECT * FROM crew WHERE crew.movieid=$movieid");
	if(!$resultSet){
		die("Bad query for crew");
	}
	
	while($row = $resultSet->fetch_assoc()){
		//Adding a writer to the end
		$crew[] = array(
							"firstname" => $row['firstname'],
							"lastname" => $row['lastname'],
							"position" => $row['position']
							);
	}
	
	
	
	//==========================================Getting the cast
	$resultSet = $db->query("SELECT * FROM cast WHERE cast.movieid=$movieid");
	if(!$resultSet){
		die("Bad query for cast");
	}
	
	while($row = $resultSet->fetch_assoc()){
		//Adding a writer to the end
		$cast[] = array(
							"firstname" => $row['firstname'],
							"lastname" => $row['lastname'],
							"role" => $row['role']
							);
	}


?>