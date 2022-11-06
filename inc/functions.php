<?php
	
	function redirect_to($new_location) {

		header("Location:".$new_location);
		exit;

	}

	function login($username, $password) {

		global $connectDB;

		$sql = "SELECT * FROM users WHERE username = :Username LIMIT 1";

		$stmt = $connectDB->prepare($sql);
		$stmt->bindValue(':Username', $username);

		$stmt->execute();

		$result = $stmt->rowcount();

		if ($result == 1) {

			$user = $stmt->fetch();
			return $user;

		} else {

			return null;

		}

	}
	
	function confirm_login() {

		if(isset($_SESSION["user_id"])) {

			return true;

		} else {

			$_SESSION["error_message"] = "Login Required to View Page";
			redirect_to("login.php");

		}

	}

	function success_message() {

		if(isset($_SESSION["success_message"])) {

			$output = "<div class='message success-message'>" . htmlentities($_SESSION["success_message"]) . "</div>";

			$_SESSION["success_message"] = null;

			return $output;

		}

	}

	function error_message() {

		if(isset($_SESSION["error_message"])) {

			$output = "<div class='message error-message'>" . htmlentities($_SESSION["error_message"]) . "</div>";

			$_SESSION["error_message"] = null;

			return $output;

		}

	}

?>
