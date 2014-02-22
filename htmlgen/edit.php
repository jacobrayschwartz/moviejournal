<?php
	//Getting the title info
	function editTitleBlock($movieid, $name, $date_released ,$run_length, $overview, $director, $watched)
	{
		$checked = ($watched) ? 'checked' : '';
		$formattedDate = date("m/d/Y", strtotime($date_released));
		echo "\n
		<form id='editTitleBlock' action='doEdit.php' method='post'>
			<input type='text' length='100' name='name' id='name' value='$name' placeholder='Title'/><br/>\n
			Released On <input type='text' length='12' id='date_released' name='date_released' value='$formattedDate' placeholder='mm/dd/yyyy'> 
			Run Length <input type='text' length='5' name='run_length' id='run_length' value='$run_length' placeholder='Run Length(Minutes)' /><br />\n
			Directed by <input type='text' length='60' name='director' id='director' value='$director' placeholder='Director' /><br/>
			Overview
			<textarea rows='4' cols='60' maxlength='254' id='overview' name='overview' placeholder='Overview'>$overview</textarea><br/>
			Seen: <input type='checkbox' id='watched' name='watched' value='1' $checked /><br/><br/>
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
					<br/>\n
					";
			}
		}
	}



	function editProducers($movieid, $producers, $editfname, $editlname){
		for($i = 0; $i < sizeof($producers); $i ++){
			$curfname = $producers[$i]['firstname'];
			$curlname = $producers[$i]['lastname'];
			
			if($curfname === $editfname && $curlname === $editlname){
				echo "
					<form id='editProducer' method='POST' action='doEdit.php'>
					<input type='hidden' id='oldfname' name='oldfname' value='$editfname' />
					<input type='hidden' id='oldlname' name='oldlname' value='$editlname' />
					<input type='text' length='30' id='producerFirstName' name='producerFirstName' value='$editfname' placeholder='First Name'/>
					<input type='text' length='30' id='producerLastName' name='producerLastName' value='$editlname' placeholder='Last Name'/>
					<input type='submit' name='producerSubmit' id='producerSubmit' value='Submit' />
					<input type='submit' name='cancel' id='cancel' value='Cancel'/>
					</form>
					";
			}
			else{
				echo "
					<span id='producersFirstName$i'>$curfname</span> <span id='producersLastName$i'>$curlname</span>
					<br/>\n
					";
			}
		}
	}



	function editProduction_companies($movieid, $production_companies, $editname){
		for($i = 0; $i < sizeof($production_companies); $i ++){
			$curname = $production_companies[$i];
			
			if($curname === $editname){
				echo "
					<form id='editProduction_company' method='POST' action='doEdit.php'>
					<input type='hidden' id='oldname' name='oldname' value='$editname' />
					<input type='text' length='100' id='production_companyName' name='production_companyName' value='$editname' placeholder='Name'/>
					<input type='submit' name='production_companySubmit' id='production_companySubmit' value='Submit' />
					<input type='submit' name='cancel' id='cancel' value='Cancel'/>
					</form>
					";
			}
			else{
				echo "
					<span id='production_companiesName$i'>$curname</span>
					<br/>\n
					";
			}
		}
	}
	
	
	function editCast($movieid, $cast, $editfname, $editlname, $editrole){
		for($i = 0; $i < sizeof($cast); $i ++){
			$curfname = $cast[$i]['firstname'];
			$curlname = $cast[$i]['lastname'];
			$currole = $cast[$i]['role'];
			
			if($curfname === $editfname && $curlname === $editlname){
				echo "
					<form id='editCast' method='POST' action='doEdit.php'>
					<input type='hidden' id='oldfname' name='oldfname' value='$editfname' />
					<input type='hidden' id='oldlname' name='oldlname' value='$editlname' />
					<input type='hidden' id='oldrole' name='oldrole' value='$editrole' />
					<input type='text' length='30' id='castFirstName' name='castFirstName' value='$editfname' placeholder='First Name'/>
					<input type='text' length='30' id='castLastName' name='castLastName' value='$editlname' placeholder='Last Name'/>
					<input type='text' length='30' id='castRole' name='castRole' value='$editrole' placeholder='Role'/>
					<input type='submit' name='castSubmit' id='castSubmit' value='Submit' />
					<input type='submit' name='cancel' id='cancel' value='Cancel'/>
					</form>
					";
			}
			else{
				echo "
					<span id='castFirstName$i'>$curfname</span> <span id='castLastName$i'>$curlname</span> <span id='castRole$i'>$currole</span>
					<br/>\n
					";
			}
		}
	}
	
	
	
	
	function editCrew($movieid, $crew, $editfname, $editlname, $editposition){
		for($i = 0; $i < sizeof($crew); $i ++){
			$curfname = $crew[$i]['firstname'];
			$curlname = $crew[$i]['lastname'];
			$curposition = $crew[$i]['position'];
			
			if($curfname === $editfname && $curlname === $editlname){
				echo "
					<form id='editCrew' method='POST' action='doEdit.php'>
					<input type='hidden' id='oldfname' name='oldfname' value='$editfname' />
					<input type='hidden' id='oldlname' name='oldlname' value='$editlname' />
					<input type='hidden' id='oldposition' name='oldposition' value='$editposition' />
					<input type='text' length='30' id='crewFirstName' name='crewFirstName' value='$editfname' placeholder='First Name'/>
					<input type='text' length='30' id='crewLastName' name='crewLastName' value='$editlname' placeholder='Last Name'/>
					<input type='text' length='30' id='crewPosition' name='crewPosition' value='$editposition' placeholder='Position'/>
					<input type='submit' name='crewSubmit' id='crewSubmit' value='Submit' />
					<input type='submit' name='cancel' id='cancel' value='Cancel'/>
					</form>
					";
			}
			else{
				echo "
					<span id='crewFirstName$i'>$curfname</span> <span id='crewLastName$i'>$curlname</span> <span id='crewPosition$i'>$curposition</span>
					<br/>\n
					";
			}
		}
	}
	
	function editMisc_facts($movieid, $misc_facts){
		echo "
			<form id='editMisc_facts' method='POST' action='doEdit.php'>
				<textarea rows='4' cols='60' maxlength='254' id='misc_factsEntry' name='misc_factsEntry'>$misc_facts</textarea>
				<input type='submit' id='submitMiscFacts' name='submitMiscFacts' value='Submit' />
				<input type='submit' name='cancel' id='cancel' value='Cancel'/>
			</form>
			";
	}
	
	
	function editComments($movieid, $comments){
		echo "
			<form id='editComments' method='POST' action='doEdit.php'>
				<textarea rows='4' cols='60' maxlength='254' id='commentsEntry' name='commentsEntry'>$comments</textarea>
				<input type='submit' id='submitComments' name='submitComments' value='Submit' />
				<input type='submit' name='cancel' id='cancel' value='Cancel'/>
			</form>
			";
	}
?>

