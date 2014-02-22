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
		$director = (isset($_POST['director'])) ? $_POST['director'] : '';
		$watched = (isset($_POST['watched']) && $_POST['watched']) ? 1 : 0;

		
		if($name !== '' && $name != null){
			$query = $db->prepare("UPDATE movies
						SET name=?,
							date_released=?,
							run_length=?,
							overview=?,
							director=?
						WHERE
							movies.id=?
							");
			$query->bind_param('ssissi',$name,$date_released,$run_length,$overview,$director,$movieid);
			
			$query->execute(); 
			
			$query = $db->prepare("UPDATE usermovies SET watched=? WHERE movieid=? ;");
			$query->bind_param('ii', $watched, $movieid);
			$query->execute();
			
		}
		header("Location: movie.php");
		exit();
	}
	
	
	//============================================================= Writers ======================================================================
	//Deleting a writer
	else if(isset($_POST['deleteWriter'])){
		$movieid = $_SESSION['movieid'];
		$fname = $_POST['writerFirstName'];
		$lname = $_POST['writerLastName'];
		
		$query = $db->prepare(
							"DELETE FROM writers WHERE movieid=? AND firstname=? AND lastname=?;"
							);
		$query->bind_param('iss',$movieid,$fname,$lname);
		$query->execute();
		
		header("Location: movie.php");
		exit();
	}
	
	//Editing a writer
	else if(isset($_POST['writerSubmit'])){
		$movieid = $_SESSION['movieid'];
		$newfname = $_POST['writerFirstName'];
		$newlname = $_POST['writerLastName'];
		$oldfname = $_POST['oldfname'];
		$oldlname = $_POST['oldlname'];
		if($newfname != '' && $newlname != ''){
			$query = $db->prepare("UPDATE writers SET firstname=?, lastname=? WHERE movieid=? AND firstname=? AND lastname=?");
			$query->bind_param('ssiss', $newfname, $newlname, $movieid, $oldfname, $oldlname);
			$query->execute();
		}
		
		header("Location: movie.php");
		exit();
	}
	
	//Adding a writer
	else if(isset($_POST['submitAddWriter'])){
		$movieid = $_SESSION['movieid'];
		$fname = $_POST['addWriterFirstName'];
		$lname = $_POST['addWriterLastName'];
		
		if($fname != '' && $lname != ''){
			$query = $db->prepare("INSERT INTO writers SET movieid=?, firstname=?, lastname=? ;");
			$query->bind_param('iss', $movieid, $fname, $lname);
			$query->execute();
		}
		
		header("Location: movie.php");
		exit();
		
	}
	
	
	//============================================================= Producers ======================================================================
	//Deleting a producer
	else if(isset($_POST['deleteProducer'])){
		$movieid = $_SESSION['movieid'];
		$fname = $_POST['producerFirstName'];
		$lname = $_POST['producerLastName'];
		
		$query = $db->prepare(
							"DELETE FROM producers WHERE movieid=? AND firstname=? AND lastname=?;"
							);
		$query->bind_param('iss',$movieid,$fname,$lname);
		$query->execute();
		
		header("Location: movie.php");
		exit();
	}
	
	//Editing a producer
	else if(isset($_POST['producerSubmit'])){
		$movieid = $_SESSION['movieid'];
		$newfname = $_POST['producerFirstName'];
		$newlname = $_POST['producerLastName'];
		$oldfname = $_POST['oldfname'];
		$oldlname = $_POST['oldlname'];
		if($newfname != '' && $newlname != ''){
			$query = $db->prepare("UPDATE producers SET firstname=?, lastname=? WHERE movieid=? AND firstname=? AND lastname=?");
			$query->bind_param('ssiss', $newfname, $newlname, $movieid, $oldfname, $oldlname);
			$query->execute();
		}
		
		header("Location: movie.php");
		exit();
	}
	
	//Adding a producer
	else if(isset($_POST['submitAddProducer'])){
		$movieid = $_SESSION['movieid'];
		$fname = $_POST['addProducerFirstName'];
		$lname = $_POST['addProducerLastName'];
		
		if($fname != '' && $lname != ''){
			$query = $db->prepare("INSERT INTO producers SET movieid=?, firstname=?, lastname=? ;");
			$query->bind_param('iss', $movieid, $fname, $lname);
			$query->execute();
		}
		
		header("Location: movie.php");
		exit();
		
	}
	
	
	
	//============================================================= Production Companies ======================================================================
	//Deleting a production company
	else if(isset($_POST['deleteProduction_company'])){
		$movieid = $_SESSION['movieid'];
		$name = $_POST['production_companyName'];
		
		$query = $db->prepare(
							"DELETE FROM production_companies WHERE movieid=? AND name=? ;"
							);
		$query->bind_param('is',$movieid,$name);
		$query->execute();
		
		header("Location: movie.php");
		exit();
	}
	
	//Editing a production company
	else if(isset($_POST['production_companySubmit'])){
		$movieid = $_SESSION['movieid'];
		$newname = $_POST['production_companyName'];
		$oldname = $_POST['oldname'];
		if($newname != ''){
			$query = $db->prepare("UPDATE production_companies SET name=? WHERE movieid=? AND name=?");
			$query->bind_param('sis', $newname, $movieid, $oldname);
			$query->execute();
		}
		
		header("Location: movie.php");
		exit();
	}
	
	//Adding a production company
	else if(isset($_POST['submitAddProduction_company'])){
		$movieid = $_SESSION['movieid'];
		$name = $_POST['addProduction_companyName'];
		
		if($name != ''){
			$query = $db->prepare("INSERT INTO production_companies SET movieid=?, name=? ;");
			$query->bind_param('is', $movieid, $name);
			$query->execute();
		}
		
		header("Location: movie.php");
		exit();
		
	}
	
	
	
	
//============================================================= Cast ======================================================================
	//Deleting a cast member
	else if(isset($_POST['deleteCast'])){
		$movieid = $_SESSION['movieid'];
		$fname = $_POST['castFirstName'];
		$lname = $_POST['castLastName'];
		$role = $_POST['castRole'];
		
		$query = $db->prepare(
							"DELETE FROM cast WHERE movieid=? AND firstname=? AND lastname=? AND role=?;"
							);
		$query->bind_param('isss',$movieid,$fname,$lname,$role);
		$query->execute();
		
		header("Location: movie.php");
		exit();
	}
	
	//Editing a cast member
	else if(isset($_POST['castSubmit'])){
		$movieid = $_SESSION['movieid'];
		$newfname = $_POST['castFirstName'];
		$newlname = $_POST['castLastName'];
		$newrole = $_POST['castRole'];
		$oldfname = $_POST['oldfname'];
		$oldlname = $_POST['oldlname'];
		$oldrole = $_POST['oldrole'];
		if($newfname != '' && $newlname != '' && $newrole != ''){
			$query = $db->prepare("UPDATE cast SET firstname=?, lastname=?, role=? WHERE movieid=? AND firstname=? AND lastname=? AND role=?");
			$query->bind_param('sssisss', $newfname, $newlname, $newrole, $movieid, $oldfname, $oldlname, $oldrole);
			$query->execute();
		}
		
		header("Location: movie.php");
		exit();
	}
	
	//Adding a cast member
	else if(isset($_POST['submitAddCast'])){
		$movieid = $_SESSION['movieid'];
		$fname = $_POST['addCastFirstName'];
		$lname = $_POST['addCastLastName'];
		$role = $_POST['addCastRole'];
		
		if($fname != '' && $lname != '' && $role != ''){
			$query = $db->prepare("INSERT INTO cast SET movieid=?, firstname=?, lastname=?, role=? ;");
			$query->bind_param('isss', $movieid, $fname, $lname, $role);
			$query->execute();
		}
		header("Location: movie.php");
		exit();
		
	}
	
	
	
//============================================================= Crew ======================================================================
	//Deleting a crew member
	else if(isset($_POST['deleteCrew'])){
		$movieid = $_SESSION['movieid'];
		$fname = $_POST['crewFirstName'];
		$lname = $_POST['crewLastName'];
		$position = $_POST['crewPosition'];
		
		$query = $db->prepare(
							"DELETE FROM crew WHERE movieid=? AND firstname=? AND lastname=? AND position=?;"
							);
		$query->bind_param('isss',$movieid,$fname,$lname,$position);
		$query->execute();
		
		header("Location: movie.php");
		exit();
	}
	
	//Editing a crew member
	else if(isset($_POST['crewSubmit'])){
		$movieid = $_SESSION['movieid'];
		$newfname = $_POST['crewFirstName'];
		$newlname = $_POST['crewLastName'];
		$newposition = $_POST['crewPosition'];
		$oldfname = $_POST['oldfname'];
		$oldlname = $_POST['oldlname'];
		$oldposition = $_POST['oldposition'];
		if($newfname != '' && $newlname != '' && $newposition != ''){
			$query = $db->prepare("UPDATE crew SET firstname=?, lastname=?, position=? WHERE movieid=? AND firstname=? AND lastname=? AND position=?");
			$query->bind_param('sssisss', $newfname, $newlname, $newposition, $movieid, $oldfname, $oldlname, $oldposition);
			$query->execute();
		}
		
		header("Location: movie.php");
		exit();
	}
	
	//Adding a crew member
	else if(isset($_POST['submitAddCrew'])){
		$movieid = $_SESSION['movieid'];
		$fname = $_POST['addCrewFirstName'];
		$lname = $_POST['addCrewLastName'];
		$position = $_POST['addCrewPosition'];
		
		if($fname != '' && $lname != '' && $position != ''){
			$query = $db->prepare("INSERT INTO crew SET movieid=?, firstname=?, lastname=?, position=? ;");
			$query->bind_param('isss', $movieid, $fname, $lname, $position);
			$query->execute();
		}
		header("Location: movie.php");
		exit();
		
	}
	
	
	else if(isset($_POST['submitMiscFacts'])){
		$movieid = $_SESSION['movieid'];
		$misc_facts = (isset($_POST['misc_factsEntry'])) ? htmlentities($_POST['misc_factsEntry']) : '';
		$query = $db->prepare("UPDATE movies SET misc_facts=? WHERE id=? ;");
		$query->bind_param('si',$misc_facts, $movieid);
		$query->execute();
		
		header("Location: movie.php");
		exit();
	}
	
	
	
	else if(isset($_POST['submitComments'])){
		$movieid = $_SESSION['movieid'];
		$comments = (isset($_POST['commentsEntry'])) ? htmlentities($_POST['commentsEntry']) : '';
		$query = $db->prepare("UPDATE movies SET comments=? WHERE id=? ;");
		$query->bind_param('si',$comments, $movieid);
		$query->execute();
		
		header("Location: movie.php");
		exit();
	}
	
	
	else{
		header("Location: movie.php");
		exit();
	}
?>