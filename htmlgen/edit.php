<?php
	//Getting the title info
	function editTitleBlock($movieid, $name, $date_released ,$run_length, $overview, $director)
	{
		$formattedDate = date("m/d/Y", strtotime($date_released));
		echo "\n
		
		<form id='editTitleBlock' action='doEdit.php' method='post'>
			<input type='text' length='100' name='name' id='name' value='$name' placeholder='Title'/><br/>\n
			Released On <input type='text' length='12' id='date_released' name='date_released' value='$formattedDate' placeholder='mm/dd/yyyy'> 
			Run Length <input type='text' length='5' name='run_length' id='run_length' value='$run_length' placeholder='Run Length' /> Minutes<br/>\n
			Directed by <input type='text' length='60' name='director' id='director' value='$director' placeholder='Director' /><br/>
			<textarea rows='4' cols='60' id='overview' name='overview' placeholder='Overview'>$overview</textarea>
			<input type='submit' name='titleBlockSubmit' id='titleBlockSubmit' value='Submit' />
			<input type='submit' name='cancel' id='cancel' value='Cancel'/>
		</form>\n\n\n
		
		";
	}
	
	function editWriters($movieid, $writers, $editfname, $editlname){
		for($i = 0; $i < sizeof($writers); $i ++){
			$curfname = $writers[$i]['firstname'];
			$curlname = $writers[$i]['lastname'];
			
			if($curfname === $editfname && $curlname === $editlname){
				echo "
					<form id='editWriter' method='POST' action='doEdit.php'>
					<input type='hidden' id='oldfname' name='oldfname' value='$editfname' />
					<input type='hidden' id='oldlname' name='oldlname' value='$editlname' />
					<input type='text' length='30' id='writerFirstName' name='writerFirstName' value='$editfname' placeholder='First Name'/>
					<input type='text' length='30' id='writerLastName' name='writerLastName' value='$editlname' placeholder='Last Name'/>
					<input type='submit' name='writerSubmit' id='writerSubmit' value='Submit' />
					<input type='submit' name='cancel' id='cancel' value='Cancel'/>
					</form>
					";
			}
			else{
				echo "
					<span id='writersFirstName$i'>$curfname</span> <span id='writersLastName$i'>$curlname</span>
					<form id='changeWriter$i' method='POST' action='doEdit.php'>
					<input type='hidden' id='writerFirstName' name='writerFirstName' value='$curfname'/>
					<input type='hidden' id='writerLastName' name='writerLastName' value='$curlname'/>
					<input type='submit' id='editWriter' name='editWriter' value='Edit' />
					<input type='hidden' id='writerFirstName' name='writerFirstName' value='$fname'/>
					<input type='hidden' id='writerLastName' name='writerLastName' value='$lname'/>
					<input type='submit' id='deleteWriter' name='deleteWriter' value='Delete'></form><br/>\n
					";
			}
		}
	}
?>

