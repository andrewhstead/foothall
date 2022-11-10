<?php

	if(isset($_POST["submit"])) {
		
		$new_hall_team = $_POST["hall-team"];
		$new_match = $_POST["match"];
		$new_team_text = $_POST["team-text"];

		$sql = "INSERT INTO teams_matches (hall_team, match_code, team_text)";
		$sql .= "VALUES (:NewTeam, :NewMatch, :NewText)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewTeam', $new_hall_team);
		$stmt->bindValue(':NewMatch', $new_match);
		$stmt->bindValue(':NewText', $new_team_text);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your record has been saved successfully.";
			
			if ($_POST['submit'] == 'Save and Add Another') {
				redirect_to("add_new.php?type=$table_id");
			} else if ($_POST['submit'] == 'Save and Close') {
				if ($new_active == 1) {
				redirect_to("view_list.php?type=$table_id&status=active");
				} else if ($new_active == 0) {
					redirect_to("view_list.php?type=$table_id&status=inactive");
				}
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
