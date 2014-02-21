<?php
	//Getting the title info
	function editTitleBlock($movieid, $name, $date_released ,$run_length, $overview)
	{
		echo "\n
		
		<form id='editTitleBlock'>
			<input type='text' length='100' name='name' id='name' value='$name' placeholder='Title'/><br/>\n
			Released On <input type='text' length='12' id='date_released' name='date_released' value='MM/DD/YYYY' placeholder='Date'> 
			Run Length <input type='text' length='5' name='run_length' id='run_length' value='$run_length' placeholder='Run Length' /> Minutes<br/>\n
			<textarea rows='4' cols='60' placeholder='Overview'>$overview</textarea>
		</form>\n\n\n
		
		";
	}
?>

