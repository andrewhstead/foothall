<?php

	if(isset($_POST["submit"])) {
		
		$new_team = $_POST["team"];
		$new_alternative = $_POST["alternative"];
		$new_abbreviation = $_POST["abbreviation"];
		$new_start = $_POST["start"];
		$new_end = $_POST["end"];
		if (isset($_POST["active"])) {
			$new_active = 1;
		} else {
			$new_active = 0;
		}

		$sql = "INSERT INTO alternative_names (team, alternative, abbreviation, start, end, active)";
		$sql .= "VALUES (:NewTeam, :NewAlternative, :NewAbbreviation, :NewStart, :NewEnd, :NewActive)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewTeam', $new_team);
		$stmt->bindValue(':NewAlternative', $new_alternative);
		$stmt->bindValue(':NewAbbreviation', $new_abbreviation);
		$stmt->bindValue(':NewStart', $new_start);
		$stmt->bindValue(':NewEnd', $new_end);
		$stmt->bindValue(':NewActive', $new_active);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your record has been saved successfully.";
			
			if ($new_active == 1) {
				redirect_to("view_list.php?type=$table_id&status=active");
			} else if ($new_active == 0) {
				redirect_to("view_list.php?type=$table_id&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
