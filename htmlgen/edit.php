<?php
	//Getting the title info
	function editTitleBlock($movieid, $name, $date_released ,$run_length, $overview)
	{
		$formattedDate = date("m/d/Y", strtotime($date_released));
		echo "\n
		
		<form id='editTitleBlock' action='doEdit.php' method='post'>
			<input type='text' length='100' name='name' id='name' value='$name' placeholder='Title'/><br/>\n
			Released On <input type='text' length='12' id='date_released' name='date_released' value='$formattedDate' placeholder='mm/dd/yyyy'> 
			Run Length <input type='text' length='5' name='run_length' id='run_length' value='$run_length' placeholder='Run Length' /> Minutes<br/>\n
			<textarea rows='4' cols='60' id='overview' name='overview' placeholder='Overview'>$overview</textarea>
			<input type='submit' name='titleBlockSubmit' id='titleBlockSubmit' value='Submit' />
			<input type='submit' name='cancel' id='cancel' value='Cancel'/>
		</form>\n\n\n
		
		";
	}
?>

