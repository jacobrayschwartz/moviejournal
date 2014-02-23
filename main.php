<?php
	session_start();
	
	if(!isset($_SESSION['user_id'])){
		header("Location: index.php");
		echo "Hmmm... something went wrong.";
		exit();
	}
	
	$userid = $_SESSION['user_id'];
	
	
	include("./php/dbinfo.php");
	$user=$_SESSION['username'];
?>

<?php include('header.php'); ?>
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
<<<<<<< HEAD
	<div class="row gutters">
		<div class="col_12">
			<section>
				
					<?php
						$usermovies="SELECT * from movies where id in(SELECT movieid from usermovies where userid in(SELECT id FROM `users` WHERE username='$user'))";
						$result = $db->query($usermovies);
						while($row=$result->fetch_assoc())
						{
							echo "<form name='rowform' action='view_delete.php' method='post'>";
							$name= $row['name'];
							$id= $row['id'];
							echo "<input type= 'hidden' size='30' id = 'movieid' name='movieid' value='".$row['id']."'>";
							echo "$name";
							echo "<input type='submit' id='deletebutton' name='deletebutton' value='Delete' style='left: 10;color: black;background-color:white'>";
							echo "<input type='submit' id='view' name='view' value='View' style='left: 10;color: black;background-color:white'>";
							echo"</form>";
							echo "-------------------------------------------------------------------------------";
						}
					?>
					<form name='submitform' action='main.php' method='post'>
					<input type='submit' id='add' name='add' value='Add' size='100' style="left: 10;color: black;background-color:white">
					</form>
					<?php
						if(isset($_POST['add']))
						{
							echo "<form name='addform' action='add.php' method='post'>";
							echo "TITLE";
							echo "<input type='text' name='title' id='title' value=''> <br>";
							echo "<input type='submit' id='submit' name='submit' value='Submit' style='left: 10;color: black;background-color:white'>";
							echo "<input type='submit' id='cancel' name='cancel' value='CANCEL' style='left: 10;color: black;background-color:white'>";
							echo "</form>";
						
						}
					?>
			</section>
=======
</header>
<div class="main mainlist">
	<div class="container">
		<div class="row gutters">
			<div class="col_12">
				<section class="movie_table">
					<h2><?php echo $user ?>'s Movie List</h2>
					<div class="num_movies">
						<?php
							$nummovies="SELECT count(name) from movies where id in(SELECT movieid from usermovies where userid in(SELECT id FROM `users` WHERE username='$user'))";
							$result = $db->query($nummovies);
							$row = $result->fetch_row();
							if ($row)
							{
  								$num = $row[0];
  								echo "You have <span class='blue'>$num</span> movies in your diary.";
  							}
							
						?>
					</div>
					<p>Movie Name:</p>
						<?php
							$usermovies="SELECT * from movies where id in(SELECT movieid from usermovies where userid in(SELECT id FROM `users` WHERE username='$user'))";
							$result = $db->query($usermovies);
							while($row=$result->fetch_assoc())
							{
								echo "<div class='display'>";
								echo "<form name='rowform' action='view_delete.php' method='post'>";
								echo "<div class='col_10'>";
								$name= $row['name'];
								$id= $row['id'];
								echo "<input type= 'hidden' size='30' id = 'movieid' name='movieid' value='".$row['id']."'>";
								echo "<span class='moviename'>$name</span>";
								echo "</div><div class='col_2'>";
								echo "<input type='submit' id='view' name='view' value='View' >";
								echo "<input type='submit' id='deletebutton' name='deletebutton' value='Delete' >";
								echo "</div>";
								echo "</form>";
								echo "</div>";
							}
						?>
						<form name='addform' action='add.php' method='post'>
							<input type='submit' id='add' name='add' value='+ Add Movie' size='100'>
						</form>
				</section>
			</div>
>>>>>>> 01d605538e5b132fe64d13574b578d1f1c664814
		</div>
	</div>
</div>










<script type="text/javascript">
	function confirmDelete(){
		confirm("Are you sure you want to delete " + info + "?");
		return false;
	}
</script>
<?php include('footer.php'); ?>