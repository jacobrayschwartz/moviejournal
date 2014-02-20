<?php
	session_start();
	
	if(!isset($_SESSION['username'])) {
		header("location: index.php");
		exit();
	}
	include("./php/dbinfo.php");
	$user=$_SESSION['username'];
	$pass=$_SESSION['password'];
?>

<?php include('header.php'); ?>

<header>
	<div class="container">
		<div class="row gutters">
			<div class="col_6 first">
				<section>
					<h1>Movie Diary Application</h1>
				</section>
			</div>
			<div class="col_6 last">
				<section class="user_info">
					<span class="username">Welcome, <?php echo $_SESSION['username']; ?></span>
					<ul>
						<li><a href="" alt=""><span class="icon icon-plus"></span>Add</a></li>
						<li><a href="" alt=""><span class="icon icon-pencil"></span>Edit</a></li>
						<li><a href="logout.php" alt="logout"><span class="icon icon-logout"></span>Logout</a></li>
					</ul>
				</section>
			</div>
		</div>
	</div>
</header>

<div class="container">
	<div class="row gutters">
		<div class="col_12">
			<section>
				
					<?php
						$usermovies="SELECT * from movies where id in(SELECT movieid from usermovies where userid in(SELECT id FROM `users` WHERE username='$user'))";
						$result = $db->query($usermovies);
						while($row=$result->fetch_assoc())
						{
							echo "<form name='rowform' action='add_edit_delete.php' method='post'>";
							$name= $row['name'];
							$id= $row['id'];
							echo "<input type= 'hidden' size='30' id = 'movieid' name='movieid' value='".$row['id']."'>";
							echo "<input type='submit' id='deletebutton' name='deletebutton' value='Delete' style='left: 10;color: black;background-color:white'>;";
							echo "<input type='submit' id='edit' name='edit' value='Edit' style='left: 10;color: black;background-color:white'>;";
							echo "$name";
							echo"</form>";
							echo "-------------------------------------------------------------------------------";
						}
					?>
					<input type='submit' id='add' name='add' value='Add' size='100' style="left: 10;color: black;background-color:white">;
			</section>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>