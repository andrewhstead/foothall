<?php

	if(isset($_POST["submit"])) {
		
		$new_hall_team = $_POST["hall-team"];
		$new_match = $_POST["match"];
		$new_team_text = $_POST["team-text"];

		$sql = "UPDATE teams_matches SET hall_team=:NewTeam, match_code=:NewMatch, team_text=:NewText WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewTeam', $new_hall_team);
		$stmt->bindValue(':NewMatch', $new_match);
		$stmt->bindValue(':NewText', $new_team_text);

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
		
	$team_match = "SELECT * FROM teams_matches WHERE id = '$record_id'";
	$team_match_query = $connectDB->query($team_match);
		
	while ($dataRows = $team_match_query->fetch()) {

		$database_id = $dataRows["id"];
		$hall_team = $dataRows["hall_team"];
		$match_code = $dataRows["match_code"];
		$team_text = $dataRows["team_text"];
		
	}
	
?>
