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
		$abbreviation = $_POST["abbreviation"];

		$sql = "INSERT INTO teams (type, gender, country, active, name, display_name, abbreviation)";
		$sql .= "VALUES (:NewType, :NewGender, :NewCountry, :NewActive, :NewName, :NewDisplayName, :NewAbbreviation)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewType', $new_type);
		$stmt->bindValue(':NewGender', $new_gender);
		$stmt->bindValue(':NewCountry', $new_country);
		$stmt->bindValue(':NewActive', $new_active);
		$stmt->bindValue(':NewName', $new_name);
		$stmt->bindValue(':NewDisplayName', $new_display_name);
		$stmt->bindValue(':NewAbbreviation', $abbreviation);

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
