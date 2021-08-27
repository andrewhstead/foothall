<?php

	if(isset($_POST["submit"])) {
		
		$new_option = $_POST["option"];
		if (isset($_POST["active"])) {
			$new_active = true;
		} else {
			$new_active = false;
		}

		$sql = "UPDATE people_votes SET option=:NewOption, active=:NewActive WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewOption', $new_option);
		$stmt->bindValue(':NewActive', $new_active);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your edits have been saved successfully.";
			
			redirect_to("view_list.php?type=$table_id&status=active");
			
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("edit_record.php?type=$table_id&code=$database_id");
			
		}

	}
		
	$table = "SELECT * FROM people_votes WHERE id = '$record_id'";
	$table_query = $connectDB->query($table);
		
	while ($dataRows = $table_query->fetch()) {

		$database_id = $dataRows["id"];
		$poll = $dataRows["poll"];
		$poll_option = $dataRows["poll_option"];
		$option = $dataRows["option"];
		$active = $dataRows["active"];
		
	}
	
?>
