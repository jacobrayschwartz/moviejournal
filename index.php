<?php
	ob_start();
	session_start();
	
	$errormessage = '';
	
	if (isset($_POST['submitted'])) {
	
		$_SESSION['errormessage'] = '';
 
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		include_once('./php/dbinfo.php');
		
		
		if($stmt = $db->prepare("select username, userpass from users where username = ?")) {
			$stmt->bind_param("s",$username);
			$stmt->execute();
			$result = $stmt->get_result();
		}
			
		if(mysqli_num_rows($result) == 0)
		{
			$_SESSION['errormessage'] = 'We\'re sorry, no user found.';
	    	header('Location: index.php');
	    }
		
		while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
			$user_name = $row['username'];
			$user_pass = $row['userpass'];
		}
		
		if ($username != $user_name) {
			$_SESSION['errormessage'] = 'We\'re sorry, no user found.';
			header('Location: index.php');
		}
		else if ($password != $user_pass) {
			$_SESSION['errormessage'] = 'Password appears incorrect.';
			header('Location: index.php');
		}
		else {
			session_regenerate_id();
			$_SESSION['username'] = $user_name;
			$_SESSION['password'] = $user_pass;
			session_write_close();
			header('Location: main.php');
			$_SESSION['errormessage'] = null;
		}
	}
 
	
?>

<?php include('header.php'); ?>

	<div class="container">
		<div class="row gutters">
			<div class="col_12">
				<div class="login_box">
					<div class="errormessage">
						<?php
							if ($_SESSION['errormessage'] != null) {
								echo '<p>';
								echo $_SESSION['errormessage'];
								echo '</p>';
							}
						?>
					</div>
					<form name="login_box" action="index.php" method="post">
						<input type="hidden" name="submitted" value="true" />
						<label name="username">Username:</label>
						<input type="text" name="username" />
						<label name="password">Password:</label>
						<input type="password" name="password" />
						<input type="submit" value="Login">
					</form>
				</div>
			</div>
		</div>
	</div>

<?php include('footer.php'); ?>