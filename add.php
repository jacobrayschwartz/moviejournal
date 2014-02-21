<?php
	include("./php/dbinfo.php");
	session_start();
	$user_id=$_SESSION['user_id'];
	if(isset($_POST['add']))
	{
			$sql="INSERT INTO `thejaco2_moviejournal`.`movies` (`id`, `name`, `overview`, `date_released`, `director`, `run_length`, `misc_facts`, `comments`) VALUES (NULL, '', NULL, NULL, NULL, NULL, NULL, NULL)";
			$result = $db->query($sql);
			$idval="SELECT * from movies where name=''";
			$result = $db->query($idval);
			// now I get the id of the movie just inserted by searching for blank name
			$row=$result->fetch_assoc();
			$movieid= $row['id'];
			$_SESSION["movieid"] = "$movieid";
			$insertusermovie="INSERT INTO `thejaco2_moviejournal`.`usermovies` (`userid`, `movieid`, `watched`) VALUES ('$user_id', '$movieid', '0');";
			$result = $db->query($insertusermovie);
			header('Location: movie.php');
			
	}
?>