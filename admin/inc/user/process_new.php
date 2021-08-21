<?php

	if(isset($_POST["submit"])) {
		
		$new_username = $_POST["username"];
		
		if ($_POST["password"] == $_POST["confirm-password"]) {
				
			$new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
			
			$sql = "INSERT INTO users (username, password)";
			$sql .= "VALUES (:NewUserName, :NewPassword)";
						
			$stmt = $connectDB->prepare($sql);
			
			$stmt->bindValue(':NewUserName', $new_username);
			$stmt->bindValue(':NewPassword', $new_password);

			$execute = $stmt->execute();
			
			if($execute) {

				$_SESSION["success_message"] = "Your record has been saved successfully.";
				
				redirect_to("view_list.php?type=$table_id&status=active");
				
			} else {

				$_SESSION["error_message"] = "Something went wrong. Please try again.";
				redirect_to("add_new.php?type=$table_id");
				
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
				
		}

	}
	
?>
