<?php
	include("./php/dbinfo.php");
	session_start();
	$user_id=$_SESSION['user_id'];
	$title=$_POST['title'];
	echo "$title";
	if(isset($_POST['submit'])){
		if($title != '')
			{
				$sql="INSERT INTO `thejaco2_moviejournal`.`movies` (`id`, `name`, `overview`, `date_released`, `director`, `run_length`, `misc_facts`, `comments`) VALUES (NULL, '$title', NULL, NULL, NULL, NULL, NULL, NULL)";
				$db->query($sql);
				
				
				$idval="SELECT MAX(id) as id from movies";
				$result = $db->query($idval);

				// now I get the id of the movie just inserted by searching for blank name
				$row=$result->fetch_assoc();
				$movieid= $row['id'];
				$_SESSION["movieid"] = "$movieid";
				$insertusermovie="INSERT INTO `thejaco2_moviejournal`.`usermovies` (`userid`, `movieid`, `watched`) VALUES ('$user_id', '$movieid', '0');";
				$result = $db->query($insertusermovie);

				header('Location: movie.php');
			}
			if($title =='')
			{
			header('Location: main.php');
			}
	}
	else if(isset($_POST['cancel'])){
	
		header('Location: main.php');
	}
	
?>