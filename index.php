<?php
	ob_start();
	session_start();
	
	$errormessage = '';
	
	if (isset($_POST['submitted'])) {
	
		$_SESSION['errormessage'] = '';
 
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		include_once('./php/dbinfo.php');
		
		
		if($stmt = $db->prepare("select users.username, users.userpass, users.id from users where username = ?")) {
			$stmt->bind_param("s",$username);
			$stmt->execute();
			$stmt->bind_result($dusername, $duserpass, $did);
		}
		
		
		if($stmt->fetch() == FALSE)
		{
			$_SESSION['errormessage'] = 'We\'re sorry, no user found.';
	    	header('Location: index.php');
	    }
		
		$user_id = $did;
		$user_name = $dusername;
		$user_pass = $duserpass;
		
		if ($username == null && $password == null) {
			$_SESSION['errormessage'] = 'We\'re sorry, no user found.';
			header('Location: index.php');
		}
		else if ($username != $user_name) {
			$_SESSION['errormessage'] = 'We\'re sorry, no user found.';
			header('Location: index.php');
		}
		else if ($password != $user_pass) {
			$_SESSION['errormessage'] = 'Password appears incorrect.';
			header('Location: index.php');
		}
		else {
			session_regenerate_id();
			$_SESSION['user_id'] = $user_id;
			$_SESSION['username'] = $user_name;
			session_write_close();
			header('Location: main.php');
			$_SESSION['errormessage'] = null;
		}
	}
 
	
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
					<span class="username">Log In Below</span>
					<ul>
						<li></li>
					</ul>
				</aside>
			</div>
		</div>
	</div>
</header>
<div class="main index">
	<div class="container">
		<div class="row gutters">
			<div class="col_12">
				<div class="login_box">
					<div class="errormessage">
						<?php
							if (isset($_SESSION['errormessage']) && ($_SESSION['errormessage'] != null || $_SESSION['errormessage'] != '')) {
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
</div>

<?php include('footer.php'); ?>