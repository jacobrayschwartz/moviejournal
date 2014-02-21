<?php
	session_start();
	$movieid=$_POST['movieid'];
	include("./php/dbinfo.php");
	if(isset($_POST['deletebutton']))
	{
		$deletemovie="DELETE FROM movies WHERE id='$movieid'";
		$result = $db->query($deletemovie);
		header('Location: main.php');
	}
	else if(isset($_POST['view']))
	{
		$_SESSION["movieid"] = "$movieid";
		header('Location: movie.php');
	}
?>