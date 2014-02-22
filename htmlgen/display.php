<?php
	//Getting the title info
	function displayTitleBlock($movieid, $name, $date_released ,$run_length, $overview, $director, $watched)
	{
		$seen = ($watched) ? "You have seen this movie." : "You need to see this movie.";
		$formattedDate = date("m/d/Y", strtotime($date_released));
		echo "\n
		<span id='name'><h1>$name</h1></span><br/>\n
		<span id='date_released'>Released On $formattedDate</span> <span id='run_time'>Run Length $run_length Minutes</span></br>\n
		<span id='director'>Directed by: $director</span><br/>\n
		<span id='overview'>$overview</span><br/>\n
		<span id='watched'>$seen</span><br/><br/>\n
		
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
				<form id='deleteWriter' onsubmit='return confirmDelete()' method='POST' action='doEdit.php'>
				<input type='hidden' id='writerFirstName' name='writerFirstName' value='$fname'/>
				<input type='hidden' id='writerLastName' name='writerLastName' value='$lname'/>
				<input type='submit' id='deleteWriter' name='deleteWriter' value='Delete'></form><br/>\n
				";
		}
	}
	
	function displayProducers($movieid, $producers){
		for($i = 0; $i < sizeof($producers); $i ++){
			$fname = $producers[$i]['firstname'];
			$lname = $producers[$i]['lastname'];
			echo "
				<span id='producersFirstName$i'>$fname</span> <span id='producersLastName$i'>$lname</span>
				<form id='changeProducer$i' method='POST' action='movie.php'>
				<input type='hidden' id='producerFirstName' name='producerFirstName' value='$fname'/>
				<input type='hidden' id='producerLastName' name='producerLastName' value='$lname'/>
				<input type='submit' id='editProducer' name='editProducer' value='Edit' /></form>
				<form id='deleteProducer' onsubmit='return confirmDelete()' method='POST' action='doEdit.php'>
				<input type='hidden' id='producerFirstName' name='producerFirstName' value='$fname'/>
				<input type='hidden' id='producerLastName' name='producerLastName' value='$lname'/>
				<input type='submit' id='deleteProducer' name='deleteProducer' value='Delete'></form><br/>\n
				";
		}
	}
	
	
	function displayProduction_companies($movieid, $production_companies){
		for($i = 0; $i < sizeof($production_companies); $i ++){
			$name = $production_companies[$i];
			echo "
				<span id='production_companiesName$i'>$name</span>
				<form id='changeProduction_company$i' method='POST' action='movie.php'>
				<input type='hidden' id='production_companyName' name='production_companyName' value='$name'/>
				<input type='submit' id='editProduction_company' name='editProduction_company' value='Edit' /></form>
				<form id='deleteProduction_company' onsubmit='return confirmDelete()' method='POST' action='doEdit.php'>
				<input type='hidden' id='production_companyName' name='production_companyName' value='$name'/>
				<input type='submit' id='deleteProduction_company' name='deleteProduction_company' value='Delete'></form><br/>\n
				";
		}
	}
	
	
	
	function displayCast($movieid, $cast){
		for($i = 0; $i < sizeof($cast); $i ++){
			$fname = $cast[$i]['firstname'];
			$lname = $cast[$i]['lastname'];
			$role = $cast[$i]['role'];
			echo "
				<span id='castFirstName$i'>$fname</span> <span id='castLastName$i'>$lname</span> <span id='castRole$i'>$role</span>
				<form id='changeCast$i' method='POST' action='movie.php'>
				<input type='hidden' id='castFirstName' name='castFirstName' value='$fname'/>
				<input type='hidden' id='castLastName' name='castLastName' value='$lname'/>
				<input type='hidden' id='castRole' name='castRole' value='$role'/>
				<input type='submit' id='editCast' name='editCast' value='Edit' /></form>
				<form id='deleteCast' onsubmit='return confirmDelete()' method='POST' action='doEdit.php'>
				<input type='hidden' id='castFirstName' name='castFirstName' value='$fname'/>
				<input type='hidden' id='castLastName' name='castLastName' value='$lname'/>
				<input type='hidden' id='castRole' name='castRole' value='$role'/>
				<input type='submit' id='deleteCast' name='deleteCast' value='Delete'></form><br/>\n
				";
		}
	}

	function displayCrew($movieid, $crew){
		for($i = 0; $i < sizeof($crew); $i ++){
			$fname = $crew[$i]['firstname'];
			$lname = $crew[$i]['lastname'];
			$position = $crew[$i]['position'];
			echo "
				<span id='crewFirstName$i'>$fname</span> <span id='crewLastName$i'>$lname</span> <span id='crewPosition$i'>$position</span>
				<form id='changeCrew$i' method='POST' action='movie.php'>
				<input type='hidden' id='crewFirstName' name='crewFirstName' value='$fname'/>
				<input type='hidden' id='crewLastName' name='crewLastName' value='$lname'/>
				<input type='hidden' id='crewPosition' name='crewPosition' value='$position'/>
				<input type='submit' id='editCrew' name='editCrew' value='Edit' /></form>
				<form id='deleteCrew' onsubmit='return confirmDelete()' method='POST' action='doEdit.php'>
				<input type='hidden' id='crewFirstName' name='crewFirstName' value='$fname'/>
				<input type='hidden' id='crewLastName' name='crewLastName' value='$lname'/>
				<input type='hidden' id='crewPosition' name='crewPosition' value='$position'/>
				<input type='submit' id='deleteCrew' name='deleteCrew' value='Delete'></form><br/>\n
				";
		}
	}

	function displayMiscFacts($movieid, $misc_facts){
		echo "
			<span id='misc_factsEntry'>$misc_facts</span><br/>
			<form id='changeMisc_facts' method='POST' action='movie.php'>
			<input type='submit' id='editMisc_facts' name='editMisc_facts' value='Edit' />
			</form>
		";
	}
	
	
	function displayComments($movieid, $comments){
		echo "
			<span id='commentsEntry'>$comments</span><br/>
			<form id='changeComments' method='POST' action='movie.php'>
			<input type='submit' id='editComments' name='editComments' value='Edit' />
			</form>
		";
	}
?>

