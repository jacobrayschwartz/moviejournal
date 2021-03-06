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
								echo "<input type='submit' id='view' name='view' value='View' ></form>";
								echo "<form id='delform' method='post' action='view_delete.php' onsubmit='return confirmDelete()'>
									<input type= 'hidden' size='30' id = 'movieid' name='movieid' value='".$row['id']."'>
									<input type='submit' id='deletebutton' name='deletebutton' value='Delete' ></form>";
								echo "</div>";
								echo "</form>";
								echo "</div>";
							}
						?>
						<form name='submitform' action='add.php' method='post'>
						<input type='hidden' id='title' name='title' value='New Movie' />
						<input type='submit' id='add' name='submit' value='+ Add Movie' size='100'>
						</form>
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
<?php include('footer.php'); ?>