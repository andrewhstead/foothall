<?php

	if(isset($_POST["submit"])) {
		
		$new_full_name = $_POST["full-name"];
		$new_display_name = $_POST["display-name"];
		$new_abbreviation = $_POST["abbreviation"];
		$new_successor_to = $_POST["successor-to"];
		$new_continent = $_POST["continent"];
		if (isset($_POST["active"])) {
			$new_active = true;
		} else {
			$new_active = false;
		}
		if (isset($_POST["defunct"])) {
			$new_defunct = true;
		} else {
			$new_defunct = false;
		}
		if (isset($_POST["affiliated"])) {
			$new_affiliated = true;
		} else {
			$new_affiliated = false;
		}
		if (isset($_POST["profile"])) {
			$new_profile = $_POST["profile"];
		} else {
			$new_profile = NULL;
		}

		$sql = "INSERT INTO countries (full_name, display_name, abbreviation, successor_to, continent, active, defunct, affiliated, profile)";
		$sql .= "VALUES (:NewFullName, :NewDisplayName, :NewAbbreviation, :NewSuccessorTo, :NewContinent, :NewActive, :NewDefunct, :NewAffiliated, :NewProfile)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewFullName', $new_full_name);
		$stmt->bindValue(':NewDisplayName', $new_display_name);
		$stmt->bindValue(':NewAbbreviation', $new_abbreviation);
		$stmt->bindValue(':NewSuccessorTo', $new_successor_to);
		$stmt->bindValue(':NewContinent', $new_continent);
		$stmt->bindValue(':NewActive', $new_active);
		$stmt->bindValue(':NewDefunct', $new_defunct);
		$stmt->bindValue(':NewAffiliated', $new_affiliated);
		$stmt->bindValue(':NewProfile', $new_profile);

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
			redirect_to("add_new.php?id=$table_id");
			
		}

	}
	
?>
