<?php
	session_start();
	include_once("./header.php");
	
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
	}
	
	$userid = $_SESSION['user_id'];
	
	//Now checking to see if the user has the movie in question (If we were passed a movie)
	if(isset($_POST['movieid'])){
		$movieid=$_POST['movieid'];
		$resultSet = $db->query("SELECT * FROM usermovies WHERE userid=$userid AND movieid=$movieid");
		if($resultSet->num_rows !== 1){
			header("Location: main.php");
			echo "Bad number of rows...";
		}
	}
	
	
	//Generating the various elements inside of variables
	include_once("./htmlgen/display.php");
	include_once("./htmlgen/edit.php");
	
?>

<div id="generalInfo">
	<?php  ?>
</div>

<?php
	include_once("./footer.php");
?>