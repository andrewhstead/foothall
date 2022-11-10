<?php

	if(isset($_POST["submit"])) {
		
		$new_person = $_POST["person"];
		$new_dream_team = $_POST["dream-team"];
		$new_number = $_POST["number"];
		$new_position = $_POST["position"];
		$new_active = 1;

		$sql = "UPDATE people_dream SET person=:NewPerson, dream_team=:NewDream, number=:NewNumber, position=:NewPosition WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewPerson', $new_person);
		$stmt->bindValue(':NewDream', $new_dream_team);
		$stmt->bindValue(':NewNumber', $new_number);
		$stmt->bindValue(':NewPosition', $new_position);
		
		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your edits have been saved successfully.";
			
			if ($new_active == 1) {
				redirect_to("view_list.php?type=$table_id&status=active");
			} else if ($new_active == 0) {
				redirect_to("view_list.php?type=$table_id&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("edit_record.php?type=$table_id&code=$database_id");
			
		}

	}
		
	$dream_person = "SELECT * FROM people_dream WHERE id = '$record_id'";
	$dream_person_query = $connectDB->query($dream_person);
		
	while ($dataRows = $dream_person_query->fetch()) {

		$database_id = $dataRows["id"];
		$person = $dataRows["person"];
		$dream_team = $dataRows["dream_team"];
		$number = $dataRows["number"];
		$position = $dataRows["position"];
		
	}
	
?>
