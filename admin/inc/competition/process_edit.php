<?php

	if(isset($_POST["submit"])) {
		
		$new_name = $_POST["name"];
		$new_abbreviation = $_POST["abbreviation"];
		$new_type = $_POST["type"];
		if (isset($_POST["gender"]) == 'm') {
			$new_gender = 'm';
		} else if (isset($_POST["gender"]) == 'f') {
			$new_gender = 'f';
		}
		$new_area = $_POST["area"];
		$new_continent = $_POST["continent"];
		$new_country = $_POST["country"];
		$new_active = $_POST["active"];
		$new_current = $_POST["current"];

		$sql = "UPDATE competitions SET name=:NewName, abbreviation=:NewAbbreviation, type=:new_type, gender=:NewGender, area=:NewArea, continent=:NewContinent, new_country=:NewCountry, new_active=:NewActive, new_current=:NewCurrent WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewName', $new_name);
		$stmt->bindValue(':NewAbbreviation', $new_abbreviation);
		$stmt->bindValue(':NewType', $new_type);
		$stmt->bindValue(':NewGender', $new_gender);
		$stmt->bindValue(':NewArea', $new_area);
		$stmt->bindValue(':NewContinent', $new_continent);
		$stmt->bindValue(':NewCountry', $new_country);
		$stmt->bindValue(':NewActive', $new_active);
		$stmt->bindValue(':NewCurrent', $new_current);

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
		
	$competition = "SELECT * FROM competitions WHERE id = '$record_id'";
	$competition_query = $connectDB->query($competition);
		
	while ($dataRows = $competition_query->fetch()) {

		$database_id = $dataRows["id"];
		$name = $dataRows["name"];
		$abbreviation = $dataRows["abbreviation"];
		$type = $dataRows["type"];
		$gender = $dataRows["gender"];
		$area = $dataRows["area"];
		$continent = $dataRows["continent"];
		$country = $dataRows["country"];
		$active = $dataRows["active"];
		$current = $dataRows["current"];
		$profile = $dataRows["profile"];
		
	}
	
?>
