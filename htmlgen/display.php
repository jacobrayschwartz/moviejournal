<?php
	//Getting the title info
	function displayTitleBlock($movieid, $name, $date_released ,$run_length, $overview, $director)
	{
		$formattedDate = date("m/d/Y", strtotime($date_released));
		echo "\n
		<span id='name'><h1>$name</h1></span><br/>\n
		<span id='date_released'>Released On $formattedDate</span> <span id='run_time'>Run Length $run_length Minutes</span></br>\n
		<span id='director'>Directed by: $director</span><br/>\n
		<span id='overview'>$overview</span><br/><br/>\n\n
		
		<form id='titleBlockEditForm' method='POST' action='movie.php'>\n
			<input type='submit' name='editTitleBlock' id='editTitleBlock' value='Edit' />\n
		</form>\n\n\n
		
		";
	}
	
	function displayWriters($movieid, $writers){
		for($i = 0; $i < sizeof($writers); $i ++){
			$fname = $writers[$i]['firstname'];
			$lname = $writers[$i]['lastname'];
			echo "
				<span id='writersFirstName$i'>$fname</span> <span id='writersLastName$i'>$lname</span>
				<form id='changeWriter$i' method='POST' action='movie.php'>
				<input type='hidden' id='writerFirstName' name='writerFirstName' value='$fname'/>
				<input type='hidden' id='writerLastName' name='writerLastName' value='$lname'/>
				<input type='submit' id='editWriter' name='editWriter' value='Edit' /></form>
				<form id='deleteWriter' method='POST' action='doEdit.php'>
				<input type='hidden' id='writerFirstName' name='writerFirstName' value='$fname'/>
				<input type='hidden' id='writerLastName' name='writerLastName' value='$lname'/>
				<input type='submit' id='deleteWriter' name='deleteWriter' value='Delete'></form><br/>\n
				";
		}
	}
	
	
	
?>

