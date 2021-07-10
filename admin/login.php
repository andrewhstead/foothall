<?php
	
	$thispage = "Login Page";

	session_start();
	
	require_once '../inc/db.php';
	require_once '../inc/functions.php';
	include 'inc/header.html';
	
	$connectDB;

	if(isset($_SESSION["user_id"])) {

		redirect_to("index.php");

	}
	
	
	if (isset($_POST["submit"])) {

		$username = $_POST["username"];
		$password = $_POST["password"];
		
		if (empty($username) || empty($password)) {

			redirect_to("login.php");

		} else {

			$user = login($username, $password);
			
			if ($user) {
				
				if (password_verify($password, $user["password"])) {
					
					$_SESSION["success_message"] = "You have successfully logged in.";
					
					$_SESSION["user_id"] = $user["id"];
					$_SESSION["username"] = $user["username"];

					redirect_to("index.php");
					
				} else {
					
					$_SESSION["error_message"] = "Unable to log you in. Please try again.";
					
					redirect_to("login.php");
					
				}

			} else {

				redirect_to("login.php");

			}

		}

	}
	
?>

	<div class="page-template">
		
		<?php
						
			echo error_message();
			echo success_message();

		?>
				
		<h1>
			Log In to the Admin Area
		</h1>
				
		<form class="edit-form" action="login.php" method="post">
			
			<fieldset class="login-fields">
				<legend>Please enter your login details:</legend>
				<label for="username">Username*:</label>
				<input type="text" id="username" name="username" required>
				<label for="password">Password*:</label>
				<input type="password" id="password" name="password" required>
			</fieldset>
					
			<input type="submit" name="submit" value="Login" />
					
		</form>
				
	</div>

<?php
	
	include 'inc/footer.php';
	
?>
