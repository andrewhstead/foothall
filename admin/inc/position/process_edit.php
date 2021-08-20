<?php

	if(isset($_POST["submit"])) {
		
		$new_name = $_POST["name"];
		$new_type = $_POST["type"];
		$new_description = $_POST["description"];

		$sql = "UPDATE positions SET name=:NewName, type=:NewType, intro_text=:NewDescription WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewName', $new_name);
		$stmt->bindValue(':NewType', $new_type);
		$stmt->bindValue(':NewDescription', $new_description);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your edits have been saved successfully.";
			
			redirect_to("view_list.php?type=$table_id&status=active");
			
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("edit_record.php?type=$table_id&code=$database_id");
			
		}

	}
		
	$position = "SELECT * FROM positions WHERE id = '$record_id'";
	$position_query = $connectDB->query($position);
		
	while ($dataRows = $position_query->fetch()) {

		$database_id = $dataRows["id"];
		$name = $dataRows["name"];
		$type = $dataRows["type"];
		$description = $dataRows["intro_text"];
		
	}
	
?>
