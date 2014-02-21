<?php
	session_start();
	//header("Location: movie.php");
	if(!isset($_SESSION['movieid']) || !isset($_SESSION['user_id'])){
		die("Bad id...");
	}

	include_once("./php/dbinfo.php");
	$userid = $_SESSION['user_id'];
	$movieid = $_SESSION['movieid'];
	
	$resultSet = $db->query("SELECT * FROM usermovies WHERE userid=$userid AND movieid=$movieid");
	if($resultSet->num_rows !== 1){
		die("User & Movie Missmatch");
	}

	//If cancel was chosen
	else if(isset($_POST['cancel'])){
		header("Location: movie.php");
		exit();
	}
	
	//Editing the title block info
	else if(isset($_POST['titleBlockSubmit'])){
		$name = $_POST['name'];
		$date_released = (isset($_POST['date_released'])) ? date("Y-m-d", strtotime($_POST['date_released'])) : '';
		$run_length = (isset($_POST['run_length'])) ? $_POST['run_length'] : '';
		$overview = (isset($_POST['overview'])) ? htmlentities($_POST['overview']) : '';

		
		if($name !== '' && $name != null){
			$query = $db->prepare("UPDATE movies
						SET name=?,
							date_released=?,
							run_length=?,
							overview=?
						WHERE
							movies.id=?
							");
			$query->bind_param('ssisi',$name,$date_released,$run_length,$overview,$movieid);
			
			$query->execute(); 
		}
		header("Location: movie.php");
		exit();
	}
	
	else{
		die("Well, crap...");
	}
?>