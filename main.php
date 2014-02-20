<?php
	session_start();
	
	if(!isset($_SESSION['user_id'])) {
		header("location: index.php");
		exit();
	}
	include("./php/dbinfo.php");
	$user_id = $_SESSION['user_id'];
?>

<?php include('header.php'); ?>

<div class="container">
	<div class="row gutters">
		<a href="logout.php" class="logout_button" alt="logout">Logout</a>
	</div>
	<div class="row gutters">
		<div class="col_12">
			<section>
				<select name="members" id="members" size="25" style="width=800;height=500">
					<?php
						$usermovies="SELECT name from movies where id in(SELECT movieid from usermovies where userid in(SELECT id FROM `users` WHERE username='$user'))";
						$result = $db->query($usermovies);
						while($row=$result->fetch_assoc())
						{
							$name= $row['name'];
							$id=$row['id'];
							echo "<option value='$id'>";
							echo "'$name'";
							echo "</option>";
						}
						
					?>
				</select>
			</section>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>