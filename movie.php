<?php
	session_start();
	include_once("./header.php");
	include("./php/dbinfo.php");
	
	//$_SESSION['user_id'] = 1;
	//$_POST['movieid'] = 1;
	
	$editing = (isset($_POST['editing'])) ? TRUE : FALSE; //boolean
	$userid; //int
	$movieid; //int
	$name; //varchar
	$overview; //varchar
	$date_released; //date
	$director; //varchar
	$run_length; //int (minutes)
	$misc_facts; //varchar
	$comments; //varchar
	$writers; //2D array {firstname, lastname}
	$crew; //2D array {firstname, lastname, position}
	$cast; //2D array {firstname, lastname, role}
	$producers; //2D array{firstname, lastname}
	$production_companies; //1D array {name}
	
	//Checking to see if the userid is set
	if(!isset($_SESSION['user_id'])){
		header("Location: index.php");
		echo "Hmmm... something went wrong.";
		exit();
	}
	
	$userid = $_SESSION['user_id'];
	
	//Now checking to see if the user has the movie in question (If we were passed a movie)
	if(!isset($_SESSION['movieid']) && isset($_POST['movieid'])){
		$_SESSION['movieid'] = $_POST['movieid'];
	}
	
	
	$movieid = $_SESSION['movieid'];
	
	if(isset($_SESSION['movieid'])){
		$movieid=$_SESSION['movieid'];
		$resultSet = $db->query("SELECT * FROM usermovies WHERE userid=$userid AND movieid=$movieid");
		if($resultSet->num_rows !== 1){
			header("Location: main.php");
			echo "User & Movie Missmatch";
			exit();
		}
	}
	
	else{
		header("Location: index.php");
		echo "Hmmm... something went wrong.";
		exit();
	}

	include_once("./htmlgen/getData.php");
	
	
	//Generating the various elements inside of variables
	
	include_once("./htmlgen/display.php");
	include_once("./htmlgen/edit.php");
	
?>



<div id='titleBlock'>
		<?php 
			if(isset($_POST['editTitleBlock'])){
				editTitleBlock($movieid, $name, $date_released, $run_length, $overview, $director);
			}
			else{
				displayTitleBlock($movieid, $name, $date_released, $run_length, $overview, $director);
			}
		?>
</div>

<div id='writersBlock'>
	<h2>Writers</h2><br/>
	<?php
		if(isset($_POST['editWriter'])){
			$editfname = $_POST['writerFirstName'];
			$editlname = $_POST['writerLastName'];
			editWriters($movieid, $writers, $editfname, $editlname);
		}
		else{
			displayWriters($movieid, $writers);
		}
		
		if(isset($_POST['addWriter'])){
			echo "<br/>
					<form id='addWriterForm' method='POST' action='doEdit.php'>
					<input type='text' length='30' id='addWriterFirstName' name='addWriterFirstName' placeholder='First Name' />
					<input type='text' length='30' id='addWriterLastName' name='addWriterLastName' placeholder='Last Name' />
					<input type='submit' id='submitAddWriter' name='submitAddWriter' value='Submit' />
					<input type='submit' id='cancel' name='cancel' value='Cancel' />
					</form>";
		}
		else{
			echo "<br/><form id='addWritterButton' method='POST' action='movie.php'><input type='submit' id='addWriter' name='addWriter' value='Add Writter' /></form>";
		}
	?>
</div>



<?php
	include_once("./footer.php");
?>