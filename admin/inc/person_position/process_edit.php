<?php

	if(isset($_POST["submit"])) {
		
		$new_person = $_POST["person"];
		$new_position = $_POST["position"];
		$new_active = 1;

		$sql = "UPDATE people_positions SET person=:NewPerson, position=:NewPosition WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewPerson', $new_person);
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
		
	$person_position = "SELECT * FROM people_positions WHERE id = '$record_id'";
	$person_position_query = $connectDB->query($person_position);
		
	while ($dataRows = $person_position_query->fetch()) {

		$database_id = $dataRows["id"];
		$person = $dataRows["person"];
		$position = $dataRows["position"];
		
	}
	
?>
