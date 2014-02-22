<?php
	date_default_timezone_set('America/Los_Angeles');
	session_start();
	include_once("./header.php");
	include("./php/dbinfo.php");
	
	//$_SESSION['user_id'] = 1;
	//$_POST['movieid'] = 1;
	
	//$editing = (isset($_POST['editing'])) ? TRUE : FALSE; //boolean
	$userid; //int
	$movieid; //int
	$name; //varchar
	$overview; //varchar
	$watched; //boolean
	$date_released; //date
	$director; //varchar
	$run_length; //int (minutes)
	$misc_facts; //varchar
	$comments; //varchar
	$writers; //2D array {firstname, lastname}
	$crew; //2D array {firstname, lastname, position}
	$cast; //2D array {firstname, lastname, role}
	$producers; //2D array{firstname, lastname}
	$production_companies; //1D array {name}
	
	//Checking to see if the userid is set
	if(!isset($_SESSION['user_id'])){
		header("Location: index.php");
		echo "Hmmm... something went wrong.";
		exit();
	}
	
	$user = $_SESSION['username'];
	$userid = $_SESSION['user_id'];
	
	//Now checking to see if the user has the movie in question (If we were passed a movie)
	if(!isset($_SESSION['movieid']) && isset($_POST['movieid'])){
		$_SESSION['movieid'] = $_POST['movieid'];
	}
	
	
	$movieid = $_SESSION['movieid'];
	
	if(isset($_SESSION['movieid'])){
		$movieid=$_SESSION['movieid'];
		$resultSet = $db->query("SELECT * FROM usermovies WHERE userid=$userid AND movieid=$movieid");
		if($resultSet->num_rows !== 1){
			header("Location: main.php");
			echo "User & Movie Missmatch";
			exit();
		}
	}
	
	else{
		header("Location: index.php");
		echo "Hmmm... something went wrong.";
		exit();
	}

	include_once("./htmlgen/getData.php");
	
	
	//Generating the various elements inside of variables
	
	include_once("./htmlgen/display.php");
	include_once("./htmlgen/edit.php");
	
?>


<header>
	<div class="container">
		<div class="row gutters">
			<div class="col_4 first">
				<section>
					<h1> Movie Diary Application </h1>
				</section>
			</div>
			<div class="col_8 last">
				<aside class="user_info">
					<span id="user_image" class="icon icon-users"></span>
					<span class="username"><?php echo $user; ?></span>
					<ul>
						<li><a href="main.php" alt="logout"><span class="icon icon-camera"></span>Movie List</a></li>
						<li><a href="logout.php" alt="logout"><span class="icon icon-logout"></span>Logout</a></li>
					</ul>
				</aside>
			</div>
		</div>
	</div>
</header>
<div class="main movie">
	<div class="container">
		<div class="row gutters">
			<div class="col_12">
				<section class="movie_table">
				<div class="display">
					<?php 
						if(isset($_POST['editTitleBlock'])){
							editTitleBlock($movieid, $name, $date_released, $run_length, $overview, $director, $watched);
						}
						else{
							displayTitleBlock($movieid, $name, $date_released, $run_length, $overview, $director, $watched);
						}
					?>
				</div>
				</section>
			</div>
		</div>
		<div class="row gutters">
			<div class="col_12">
				<section class="movie_table">
					<div class="display gray">
					<h2>Writers</h2><br/>
					<?php
						if(isset($_POST['editWriter'])){
							$editfname = $_POST['writerFirstName'];
							$editlname = $_POST['writerLastName'];
							editWriters($movieid, $writers, $editfname, $editlname);
						}
						else if(isset($writers)){
							displayWriters($movieid, $writers);
						}
						
						if(isset($_POST['addWriter'])){
							echo "
									<div class='col_12'>
									<form id='addWriterForm' method='POST' action='doEdit.php'>
									<input type='text' length='30' id='addWriterFirstName' name='addWriterFirstName' placeholder='First Name' />
									<input type='text' length='30' id='addWriterLastName' name='addWriterLastName' placeholder='Last Name' />
									<input type='submit' id='submitAddWriter' name='submitAddWriter' value='Submit' />
									<input type='submit' id='cancel' name='cancel' value='Cancel' />
									</form>
									</div>
									";
						}
						else{
							echo "<form id='addWritterButton' method='POST' action='movie.php'><input type='submit' id='addWriter' name='addWriter' value='Add Writer' /></form>";
						}
					?>
					</div>
				</section>
			</div>
		</div>
		<div class="row gutters">
			<div class="col_12">
				<section class="movie_table">
					<div class="display gray">
					<h2>Producers</h2><br/>
						<?php 
							if(isset($_POST['editProducer'])){
								$editfname = $_POST['producerFirstName'];
								$editlname = $_POST['producerLastName'];
								editProducers($movieid, $producers, $editfname, $editlname);
							}
							else if(isset($producers)){
								displayProducers($movieid, $producers);
							}
							
							if(isset($_POST['addProducer'])){
								echo "
										<form id='addProducerForm' method='POST' action='doEdit.php'>
										<input type='text' length='30' id='addProducerFirstName' name='addProducerFirstName' placeholder='First Name' />
										<input type='text' length='30' id='addProducerLastName' name='addProducerLastName' placeholder='Last Name' />
										<input type='submit' id='submitAddProducer' name='submitAddProducer' value='Submit' />
										<input type='submit' id='cancel' name='cancel' value='Cancel' />
										</form>";
							}
							else{
								echo "<form id='addProducerButton' method='POST' action='movie.php'><input type='submit' id='addProducer' name='addProducer' value='Add Producer' /></form>";
							}
						?>
					</div>
				</section>
			</div>
		</div>
		<div class="row gutters">
			<div class="col_12">
				<section class="movie_table">
					<div class="display gray">
					<h2>Production Companies</h2><br/>
						<?php 
							if(isset($_POST['editProduction_company'])){
								$editname = $_POST['production_companyName'];
								editProduction_companies($movieid, $production_companies, $editname);
							}
							else if(isset($production_companies)){
								displayProduction_companies($movieid, $production_companies);
							}
							if(isset($_POST['addProduction_company'])){
								echo "
										<form id='addProduction_companyForm' method='POST' action='doEdit.php'>
										<input type='text' length='100' id='addProduction_companyName' name='addProduction_companyName' placeholder='Name' />
										<input type='submit' id='submitAddProduction_company' name='submitAddProduction_company' value='Submit' />
										<input type='submit' id='cancel' name='cancel' value='Cancel' />
										</form>";
							}
							else{
								echo "<form id='addProduction_companyButton' method='POST' action='movie.php'><input type='submit' id='addProduction_company' name='addProduction_company' value='Add Company' /></form>";
							}
						?>
					</div>
				</section>
			</div>
		</div>
		<div class="row gutters">
			<div class="col_12">
				<section class="movie_table">
					<div class="display gray">
					<h2>Cast</h2><br/>
						<?php 
							if(isset($_POST['editCast'])){
								$editfname = $_POST['castFirstName'];
								$editlname = $_POST['castLastName'];
								$editrole = $_POST['castRole'];
								editCast($movieid, $cast, $editfname, $editlname, $editrole);
							}
							else if(isset($cast)){
								displayCast($movieid, $cast);
							}
							
							if(isset($_POST['addCast'])){
								echo "
										<form id='addCastForm' method='POST' action='doEdit.php'>
										<input type='text' length='30' id='addCastFirstName' name='addCastFirstName' placeholder='First Name' />
										<input type='text' length='30' id='addCastLastName' name='addCastLastName' placeholder='Last Name' />
										<input type='text' length='100' id='addCastRole' name='addCastRole' placeholder='Role' />
										<input type='submit' id='submitAddCast' name='submitAddCast' value='Submit' />
										<input type='submit' id='cancel' name='cancel' value='Cancel' />
										</form>";
							}
							else{
								echo "<form id='addCastButton' method='POST' action='movie.php'><input type='submit' id='addCast' name='addCast' value='Add Cast' /></form>";
							}
						?>
					</div>
				</section>
			</div>
		</div>
		<div class="row gutters">
			<div class="col_12">
				<section class="movie_table">
					<div class="display gray">
					<h2>Crew</h2><br/>
						<?php 
							if(isset($_POST['editCrew'])){
								$editfname = $_POST['crewFirstName'];
								$editlname = $_POST['crewLastName'];
								$editposition = $_POST['crewPosition'];
								editCrew($movieid, $crew, $editfname, $editlname, $editposition);
							}
							else if(isset($crew)){
								displayCrew($movieid, $crew);
							}
							
							if(isset($_POST['addCrew'])){
								echo "
										<form id='addCrewForm' method='POST' action='doEdit.php'>
										<input type='text' length='30' id='addCrewFirstName' name='addCrewFirstName' placeholder='First Name' />
										<input type='text' length='30' id='addCrewLastName' name='addCrewLastName' placeholder='Last Name' />
										<input type='text' length='100' id='addCrewPosition' name='addCrewPosition' placeholder='Position' />
										<input type='submit' id='submitAddCrew' name='submitAddCrew' value='Submit' />
										<input type='submit' id='cancel' name='cancel' value='Cancel' />
										</form>";
							}
							else{
								echo "<form id='addCrewButton' method='POST' action='movie.php'><input type='submit' id='addCrew' name='addCrew' value='Add Crew' /></form>";
							}
						?>
					</div>
				</section>
			</div>
		</div>
		<div class="row gutters">
			<div class="col_12">
				<section class="movie_table">
				<div class="display gray" id="comments">
					<h2>Misc. Facts</h2>
						<?php
							if(isset($_POST['editMisc_facts'])){
								editMisc_facts($movieid, $misc_facts);
							}
							else{
								displayMiscFacts($movieid, $misc_facts);
							}
						?>
				</div>
				</section>
			</div>
		</div>
		<div class="row gutters">
			<div class="col_12">
				<section class="movie_table">
					<div class="display gray" id="comments">
					<h2>Comments</h2>
					<?php
						if(isset($_POST['editComments'])){
							editComments($movieid, $comments);
						}
						else{
							displayComments($movieid, $comments);
						}
					?>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	function confirmDelete(){
		return confirm("Are you sure you want to delete?");
		//return false; 
	}
</script>

<?php
	include_once("./footer.php");
?>