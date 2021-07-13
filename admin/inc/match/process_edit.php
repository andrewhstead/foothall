<?php

	if(isset($_POST["submit"])) {
		
		$new_file_code = $_POST["file-code"];
		$new_teams = $_POST["teams-type"];
		if (isset($_POST["admitted"])) {
			$new_admitted = true;
		} else {
			$new_admitted = false;
		}
		if (empty($_POST["admission-date"])) {
			$new_admission_date = NULL;
		} else {
			$new_admission_date = $_POST["admission-date"];
		}
		if (empty($_POST["admission-poll"])) {
			$new_admission_poll = NULL;
		} else {
			$new_admission_poll = $_POST["admission-poll"];
		}
		$new_date = $_POST["match-date"];
		$new_competition = $_POST["competition"];
		$new_stage = $_POST["stage"];
		$new_team_1 = $_POST["team-1"];
		$new_score_1 = $_POST["score-1"];
		$new_team_2 = $_POST["team-2"];
		$new_score_2 = $_POST["score-2"];
		$new_intro_text = $_POST["intro-text"];
		$new_match_report = $_POST["match-report"];

		$sql = "UPDATE people SET file_code=:NewFileCode, teams=:NewTeams, active=:NewAdmitted, admission_date=:NewAdmissionDate, admission_poll=:NewAdmissionPoll, date=:NewDate, competition=:NewCompetition, stage=:NewStage, team_1=:NewTeam1, score_1=:NewScore1, team_2=:NewTeam2, score_2=:NewScore2, intro_text=:NewIntroText, match_report=:NewMatchReport WHERE file_code = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewFileCode', $new_file_code);
		$stmt->bindValue(':NewTeams', $new_teams);
		$stmt->bindValue(':NewAdmitted', $new_admitted);
		$stmt->bindValue(':NewAdmissionDate', $new_admission_date);
		$stmt->bindValue(':NewAdmissionPoll', $new_admission_poll);
		$stmt->bindValue(':NewDate', $new_date);
		$stmt->bindValue(':NewCompetition', $new_competition);
		$stmt->bindValue(':NewStage', $new_stage);
		$stmt->bindValue(':NewTeam1', $new_team_1);
		$stmt->bindValue(':NewScore1', $new_score_1);
		$stmt->bindValue(':NewTeam2', $new_team_2);
		$stmt->bindValue(':NewScore2', $new_score_2);
		$stmt->bindValue(':NewIntroText', $new_intro_text);
		$stmt->bindValue(':NewMatchReport', $new_match_report);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your edits have been saved successfully.";
			
			if ($new_admitted == 1) {
				redirect_to("view_list.php?type=matches&status=active");
			} else if ($new_admitted == 0) {
				redirect_to("view_list.php?type=matches&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("edit_record.php?type=matches&code=$file_code");
			
		}

	}
		
	$match = "SELECT * FROM matches WHERE file_code = '$record_id'";
	$match_query = $connectDB->query($match);
		
	while ($dataRows = $match_query->fetch()) {

		$database_id = $dataRows["id"];
		$file_code = $dataRows["file_code"];
		$teams = $dataRows["teams"];
		$admitted = $dataRows["active"];
		$admission_date = $dataRows["admission_date"];
		$admission_poll = $dataRows["admission_poll"];
		$date = $dataRows["date"];
		$competition = $dataRows["competition"];
		$stage = $dataRows["stage"];
		$team_1 = $dataRows["team_1"];
		$score_1 = $dataRows["score_1"];
		$team_2 = $dataRows["team_2"];
		$score_2 = $dataRows["score_2"];
		$intro_text = $dataRows["intro_text"];
		$match_report = $dataRows["match_report"];
		
	}
	
?>