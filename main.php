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

<div class="container">
	<div class="row gutters">
		<a href="logout.php" class="logout_button" alt="logout">Logout</a>
	</div>
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
					<form>
					<input type='submit' id='add' name='add' value='Add' size='100' style="left: 10;color: black;background-color:white">;
					</form>
			</section>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>