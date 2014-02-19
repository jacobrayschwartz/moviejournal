<?php
	session_start();
	
	if(!isset($_SESSION['username'])) {
		header("location: index.php");
		exit();
	}
?>

<?php include('header.php'); ?>

<div class="container">
	<div class="row gutters">
		<a href="logout.php" class="logout_button" alt="logout">Logout</a>
	</div>
	<div class="row gutters">
		<div class="col_12">
			<section>
				stuff goes here!
			</section>
		</div>
	</div>
</div>

<?php include('footer.php'); ?>