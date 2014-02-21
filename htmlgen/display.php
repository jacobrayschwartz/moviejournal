<?php
	//Getting the title info
	function displayTitleBlock($movieid, $name, $date_released ,$run_length, $overview)
	{
		$formattedDate = date("m-d-Y", strtotime($date_released));
		echo "\n
		<span id='name'><h1>$name</h1></span><br/>\n
		<span id='date_released'>Released On $formattedDate</span> <span id='run_time'>Run Length $run_length Minutes</span></br>\n
		<span id='overview'>$overview</span><br/><br/>\n\n
		
		<form id='titleBlockEditForm' method='POST' action='movie.php'>\n
			<input type='hidden' name='movieid' id='movieid' value='$movieid' />\n
			<input type='submit' name='editTitleBlock' id='editTitleBlock' value='Edit' />\n
		</form>\n\n\n
		
		";
	}
?>

