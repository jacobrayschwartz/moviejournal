<?php
	include("./php/dbinfo.php");
	session_start();
	$user_id=$_SESSION['user_id'];
	$title=$_POST['title'];
	echo "$title";
	if(isset($_POST['submit'])){
		if($title != '')
			{
				$sql="INSERT INTO `thejaco2_moviejournal`.`movies` (`id`, `name`, `overview`, `date_released`, `director`, `run_length`, `misc_facts`, `comments`) VALUES (NULL, ?, NULL, NULL, NULL, NULL, NULL, NULL)";
				$stmt = $db->prepare($sql);
				$stmt->bind_param("s",$title);
				$stmt->execute();
				$result=$stmt->get_result();
				// use sql to get the movie id that was inserted
				$idval="SELECT * from movies where name=?";
				$stmt = $db->prepare($idval);
				$stmt->bind_param("s",$title);
				$stmt->execute();
				$result=$stmt->get_result();
				// now I get the id of the movie just inserted by searching for blank name
				$row=$result->fetch_assoc();
				$movieid= $row['id'];
				$_SESSION["movieid"] = "$movieid";
				$insertusermovie="INSERT INTO `thejaco2_moviejournal`.`usermovies` (`userid`, `movieid`, `watched`) VALUES (?, ?, '0');";
				$stmt = $db->prepare($insertusermovie);
				$stmt->bind_param("ss",$user_id,$movieid);
				$stmt->execute();
				$result=$stmt->get_result();
				header('Location: movie.php');
			}
	}
	else if(isset($_POST['cancel'])){
	
		header('Location: main.php');
	}
	
?>