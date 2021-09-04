<?php

	if(isset($_POST["submit"])) {
		
		$new_person = $_POST["person"];
		$new_team = $_POST["team"];
		$new_hall_team = $_POST["hall-team"];
		$new_first = $_POST["first"];
		$new_last = $_POST["last"];
		$new_appearances = $_POST["appearances"];
		$new_goals = $_POST["goals"];
		$new_summary = $_POST["summary"];
		$new_active = true;

		$sql = "UPDATE people_teams SET person=:NewPerson, team=:NewTeam, hall_team=:NewHallTeam, first=:NewFirst, last=:NewLast, appearances=:NewAppearances, goals=:NewGoals, summary=:NewSummary WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewPerson', $new_person);
		$stmt->bindValue(':NewTeam', $new_team);
		$stmt->bindValue(':NewHallTeam', $new_hall_team);
		$stmt->bindValue(':NewFirst', $new_first);
		$stmt->bindValue(':NewLast', $new_last);
		$stmt->bindValue(':NewAppearances', $new_appearances);
		$stmt->bindValue(':NewGoals', $new_goals);
		$stmt->bindValue(':NewSummary', $new_summary);
		
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
		
	$team_person = "SELECT * FROM people_teams WHERE id = '$record_id'";
	$team_person_query = $connectDB->query($team_person);
		
	while ($dataRows = $team_person_query->fetch()) {

		$database_id = $dataRows["id"];
		$person = $dataRows["person"];
		$team = $dataRows["team"];
		$hall_team = $dataRows["hall_team"];
		$first = $dataRows["first"];
		$last = $dataRows["last"];
		$appearances = $dataRows["appearances"];
		$goals = $dataRows["goals"];
		$summary = $dataRows["summary"];
		
	}
	
?>
