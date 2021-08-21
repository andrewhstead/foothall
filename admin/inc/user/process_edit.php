<?php

	if(isset($_POST["submit"])) {
		
		$new_username = $_POST["username"];
		if ((password_verify($current_password, $_POST["current-password"])) AND ($_POST["new-password"] == $_POST["confirm-password"])) {
			
			$new_password = password_hash($_POST["new-password"], PASSWORD_DEFAULT);
			
			$sql = "UPDATE users SET username=:NewUserName, password=:NewPassword WHERE id = '$record_id'";
					
			$stmt = $connectDB->prepare($sql);
			
			$stmt->bindValue(':NewUserName', $new_username);
			$stmt->bindValue(':NewPassword', $new_password);

			$execute = $stmt->execute();
			
		}

		
		
		if($execute) {

			$_SESSION["success_message"] = "Your edits have been saved successfully.";
			
			redirect_to("view_list.php?type=$table_id&status=active");
			
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("edit_record.php?type=$table_id&code=$database_id");
			
		}

	}
		
	$table = "SELECT * FROM users WHERE id = '$record_id'";
	$table_query = $connectDB->query($table);
		
	while ($dataRows = $table_query->fetch()) {

		$database_id = $dataRows["id"];
		$username = $dataRows["username"];
		$current_password = $dataRows["password"];
		
	}
	
?>
