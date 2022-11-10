<?php

	if(isset($_POST["submit"])) {
		
		$new_person = $_POST["person"];
		$new_team = $_POST["team"];
		$new_match = $_POST["match"];
		if ($_POST["status"] == "started") {
			$new_started = 1;
			$new_substitute = 0;
		} elseif ($_POST["status"] == "substitute") {
			$new_started = 0;
			$new_substitute = 1;
		}
		$new_number = $_POST["number"];
		$new_replaced = $_POST["replaced"];
		$new_minute = $_POST["minute"];
		if (isset($_POST["captain"])) {
			$new_captain = 1;
		} else {
			$new_captain = 0;
		}
		if (isset($_POST["goalkeeper"])) {
			$new_goalkeeper = 1;
		} else {
			$new_goalkeeper = 0;
		}
		$new_active = 1;

		$sql = "UPDATE people_matches SET person=:NewPerson, team=:NewTeam, match_code=:NewMatch, started=:NewStarted, sub_appeared=:NewSubstitute, replaced=:NewReplaced, minute=:NewMinute, captain=:NewCaptain, goalkeeper=:NewGoalkeeper, shirt=:NewNumber WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewPerson', $new_person);
		$stmt->bindValue(':NewTeam', $new_team);
		$stmt->bindValue(':NewMatch', $new_match);
		$stmt->bindValue(':NewStarted', $new_started);
		$stmt->bindValue(':NewSubstitute', $new_substitute);
		$stmt->bindValue(':NewReplaced', $new_replaced);
		$stmt->bindValue(':NewMinute', $new_minute);
		$stmt->bindValue(':NewCaptain', $new_captain);
		$stmt->bindValue(':NewGoalkeeper', $new_goalkeeper);
		$stmt->bindValue(':NewNumber', $new_number);
		
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
		
	$match_person = "SELECT * FROM people_matches WHERE id = '$record_id'";
	$match_person_query = $connectDB->query($match_person);
		
	while ($dataRows = $match_person_query->fetch()) {

		$database_id = $dataRows["id"];
		$person = $dataRows["person"];
		$team_id = $dataRows["team"];
		$match_code = $dataRows["match_code"];
		$started = $dataRows["started"];
		$substitute = $dataRows["sub_appeared"];
		$replaced = $dataRows["replaced"];
		$minute = $dataRows["minute"];
		$captain = $dataRows["captain"];
		$goalkeeper = $dataRows["goalkeeper"];
		$number = $dataRows["shirt"];
		
	}
	
?>
