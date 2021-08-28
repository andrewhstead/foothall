<?php

	if(isset($_POST["submit"])) {
		
		$new_type = $_POST["type"];
		$new_gender = $_POST["gender"];
		$new_country = $_POST["country"];
		if (isset($_POST["active"])) {
			$new_active = true;
		} else {
			$new_active = false;
		}
		$new_name = $_POST["full-name"];
		$new_display_name = $_POST["display-name"];
		$new_abbreviation = $_POST["abbreviation"];
		
		$sql = "UPDATE teams SET type=:NewType, gender=:NewGender, country=:NewCountry, active=:NewActive, name=:NewName, display_name=:NewDisplayName, abbreviation=:NewAbbreviation WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewType', $new_type);
		$stmt->bindValue(':NewGender', $new_gender);
		$stmt->bindValue(':NewCountry', $new_country);
		$stmt->bindValue(':NewActive', $new_active);
		$stmt->bindValue(':NewName', $new_name);
		$stmt->bindValue(':NewDisplayName', $new_display_name);
		$stmt->bindValue(':NewAbbreviation', $new_abbreviation);
		
		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your edits have been saved successfully.";
			
			if ($new_active == true) {
				redirect_to("view_list.php?type=$table_id&status=active");
			} else if ($new_active == false) {
				redirect_to("view_list.php?type=$table_id&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("edit_record.php?type=$table_id&code=$database_id");
			
		}

	}
		
	$team = "SELECT * FROM teams  
		WHERE id = '$record_id'";
	$team_query = $connectDB->query($team);
		
	while ($dataRows = $team_query->fetch()) {
		
		$database_id = $dataRows["id"];
		$type = $dataRows["type"];
		$gender = $dataRows["gender"];
		$country = $dataRows["country"];
		$active = $dataRows["active"];
		$name = $dataRows["name"];
		$display_name = $dataRows["display_name"];
		$abbreviation = $dataRows["abbreviation"];
		
	}
	
?>
