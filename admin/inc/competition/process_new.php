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

		$sql = "INSERT INTO competitions (name, abbreviation, type, gender, area, continent, country, active, current)";
		$sql .= "VALUES (:NewFullName, :NewDisplayName, :NewAbbreviation, :NewSuccessorTo, :NewContinent, :NewActive, :NewDefunct, :NewAffiliated, :NewProfile)";
					
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

			$_SESSION["success_message"] = "Your record has been saved successfully.";
			
			if ($new_active == true) {
				redirect_to("view_list.php?type=$table_id&status=active");
			} else if ($new_active == false) {
				redirect_to("view_list.php?type=$table_id&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
