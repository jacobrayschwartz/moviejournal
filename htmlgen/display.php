<?php
	//Getting the title info
	function displayTitleBlock($movieid, $name, $date_released ,$run_length, $overview, $director, $watched)
	{
		$seen = ($watched) ? "You have seen this movie." : "You need to see this movie.";
		$formattedDate = date("m/d/Y", strtotime($date_released));
		echo "\n
		<div class='col_12'>
		<span id='name'><h1>$name</h1></span>
		</div>
		<div class='col_12 data'>
		<span id='date_released'><span class='bold'>Released: </span> $formattedDate</span> 
		</div>
		<div class='col_12 data'>
		<span id='run_time'><span class='bold'>Run Length:</span> $run_length Minutes</span>
		</div>
		<div class='col_12 data'>
		<span id='director'><span class='bold'>Directed by:</span> $director</span>
		</div>
		<div class='col_12 data'>
		<span id='overview'><span class='bold'>Overview:</span> $overview</span>
		</div>
		<div class='col_12 data'>
		<span id='watched'><span class='blue'>$seen</span></span>
		</div>
		<div class='col_12 data'>
		
		<form id='titleBlockEditForm' method='POST' action='movie.php'>\n
			<input type='submit' name='editTitleBlock' id='editTitleBlock' value='Edit' />\n
		</form>\n\n\n
		</div>
		";
	}
	
	function displayWriters($movieid, $writers){
		for($i = 0; $i < sizeof($writers); $i ++){
			$fname = $writers[$i]['firstname'];
			$lname = $writers[$i]['lastname'];
			echo "
				<div class='col_10'>
				<span id='writersFirstName$i'>$fname</span> <span id='writersLastName$i'>$lname</span>
				</div>
				<div class='col_1 hor'>
				<form id='changeWriter$i' method='POST' action='movie.php'>
				<input type='hidden' id='writerFirstName' name='writerFirstName' value='$fname'/>
				<input type='hidden' id='writerLastName' name='writerLastName' value='$lname'/>
				<input type='submit' id='editWriter' name='editWriter' value='Edit' /></form>
				</div>
				<div class='col_1 hor'>
				<form id='deleteWriter' onsubmit='return confirmDelete()' method='POST' action='doEdit.php'>
				<input type='hidden' id='writerFirstName' name='writerFirstName' value='$fname'/>
				<input type='hidden' id='writerLastName' name='writerLastName' value='$lname'/>
				<input type='submit' id='deleteWriter' name='deleteWriter' value='Delete'></form>\n
				</div>
				";
		}
	}
	
	function displayProducers($movieid, $producers){
		for($i = 0; $i < sizeof($producers); $i ++){
			$fname = $producers[$i]['firstname'];
			$lname = $producers[$i]['lastname'];
			echo "
				<div class='col_10'>
				<span id='producersFirstName$i'>$fname</span> <span id='producersLastName$i'>$lname</span>
				</div>
				<div class='col_1 hor'>
				<form id='changeProducer$i' method='POST' action='movie.php'>
				<input type='hidden' id='producerFirstName' name='producerFirstName' value='$fname'/>
				<input type='hidden' id='producerLastName' name='producerLastName' value='$lname'/>
				<input type='submit' id='editProducer' name='editProducer' value='Edit' /></form>
				</div>
				<div class='col_1 hor'>
				<form id='deleteProducer' onsubmit='return confirmDelete()' method='POST' action='doEdit.php'>
				<input type='hidden' id='producerFirstName' name='producerFirstName' value='$fname'/>
				<input type='hidden' id='producerLastName' name='producerLastName' value='$lname'/>
				<input type='submit' id='deleteProducer' name='deleteProducer' value='Delete'></form>\n
				</div>
				";
		}
	}
	
	
	function displayProduction_companies($movieid, $production_companies){
		for($i = 0; $i < sizeof($production_companies); $i ++){
			$name = $production_companies[$i];
			echo "
				<div class='col_10'>
				<span id='production_companiesName$i'>$name</span>
				</div>
				<div class='col_1 hor'>
				<form id='changeProduction_company$i' method='POST' action='movie.php'>
				<input type='hidden' id='production_companyName' name='production_companyName' value='$name'/>
				<input type='submit' id='editProduction_company' name='editProduction_company' value='Edit' /></form>
				</div>
				<div class='col_1 hor'>
				<form id='deleteProduction_company' onsubmit='return confirmDelete()' method='POST' action='doEdit.php'>
				<input type='hidden' id='production_companyName' name='production_companyName' value='$name'/>
				<input type='submit' id='deleteProduction_company' name='deleteProduction_company' value='Delete'></form>\n
				</div>
				";
		}
	}
	
	
	
	function displayCast($movieid, $cast){
		for($i = 0; $i < sizeof($cast); $i ++){
			$fname = $cast[$i]['firstname'];
			$lname = $cast[$i]['lastname'];
			$role = $cast[$i]['role'];
			echo "
				<div class='col_10'>
				<span id='castFirstName$i'>$fname</span> <span id='castLastName$i'>$lname</span> <span id='castRole$i'>$role</span>
				</div>
				<div class='col_1 hor'>
				<form id='changeCast$i' method='POST' action='movie.php'>
				<input type='hidden' id='castFirstName' name='castFirstName' value='$fname'/>
				<input type='hidden' id='castLastName' name='castLastName' value='$lname'/>
				<input type='hidden' id='castRole' name='castRole' value='$role'/>
				<input type='submit' id='editCast' name='editCast' value='Edit' /></form>
				</div>
				<div class='col_1 hor'>
				<form id='deleteCast' onsubmit='return confirmDelete()' method='POST' action='doEdit.php'>
				<input type='hidden' id='castFirstName' name='castFirstName' value='$fname'/>
				<input type='hidden' id='castLastName' name='castLastName' value='$lname'/>
				<input type='hidden' id='castRole' name='castRole' value='$role'/>
				<input type='submit' id='deleteCast' name='deleteCast' value='Delete'></form>\n
				</div>
				";
		}
	}

	function displayCrew($movieid, $crew){
		for($i = 0; $i < sizeof($crew); $i ++){
			$fname = $crew[$i]['firstname'];
			$lname = $crew[$i]['lastname'];
			$position = $crew[$i]['position'];
			echo "
				<div class='col_10'>
				<span id='crewFirstName$i'>$fname</span> <span id='crewLastName$i'>$lname</span> / <span id='crewPosition$i'>$position</span>
				</div>
				<div class='col_1 hor'>
				<form id='changeCrew$i' method='POST' action='movie.php'>
				<input type='hidden' id='crewFirstName' name='crewFirstName' value='$fname'/>
				<input type='hidden' id='crewLastName' name='crewLastName' value='$lname'/>
				<input type='hidden' id='crewPosition' name='crewPosition' value='$position'/>
				<input type='submit' id='editCrew' name='editCrew' value='Edit' /></form>
				</div>
				<div class='col_1 hor'>
				<form id='deleteCrew' onsubmit='return confirmDelete()' method='POST' action='doEdit.php'>
				<input type='hidden' id='crewFirstName' name='crewFirstName' value='$fname'/>
				<input type='hidden' id='crewLastName' name='crewLastName' value='$lname'/>
				<input type='hidden' id='crewPosition' name='crewPosition' value='$position'/>
				<input type='submit' id='deleteCrew' name='deleteCrew' value='Delete'></form>\n
				</div>
				";
		}
	}

	function displayMiscFacts($movieid, $misc_facts){
		echo "
			<div class='col_10'>
				<span id='misc_factsEntry'>$misc_facts</span>
			</div>
			<div class='col_2'>
				<form id='changeMisc_facts' method='POST' action='movie.php'>
				<input type='submit' id='editMisc_facts' name='editMisc_facts' value='Edit' />
				</form>
			</div>
		";
	}
	
	
	function displayComments($movieid, $comments){
		echo "
			<div class='col_10'>
				<span id='commentsEntry'>$comments</span>
			</div>
			<div class='col_2'>
				<form id='changeComments' method='POST' action='movie.php'>
				<input type='submit' id='editComments' name='editComments' value='Edit' />
				</form>\n
			</div>
		";
	}
?>

