<?php

	if(isset($_POST["submit"])) {
		
		$new_team_1 = $_POST["team-1"];
		$new_team_2 = $_POST["team-2"];
		$new_teams = $_POST["teams-type"];
		$new_score_1 = $_POST["score-1"];
		$new_score_2 = $_POST["score-2"];
		if (isset($_POST["extra-time"])) {
			$new_extra_time = 1;
		} else {
			$new_extra_time = 0;
		}
		if (isset($_POST["penalties"])) {
			$new_penalties = 1;
		} else {
			$new_penalties = 0;
		}
		if (empty($POST["penalties-1"])) {
			$penalties_1 = NULL;
		} else {
			$penalties_1 = $POST["penalties-1"];
		}
		if (empty($POST["penalties-2"])) {
			$penalties_2 = NULL;
		} else {
			$penalties_2 = $POST["penalties-2"];
		}
		if (empty($_POST["walkover"])) {
			$new_walkover = NULL;
		} elseif ($_POST["walkover"] == "walkover-t1") {
			$new_walkover = 1;
		} elseif ($_POST["walkover"] == "walkover-t2") {
			$new_walkover = 2;
		}
		$new_date = $_POST["match-date"];
		$new_competition = $_POST["competition"];
		$new_tournament = $_POST["tournament"];
		$new_stage = $_POST["stage"];
		$new_section = $_POST["section"];
		$new_file_code = $_POST["file-code"];
		if (empty($_POST["title"])) {
			$title = NULL;
		} else {
			$title = $POST["title"];
		}
		$new_attendance = $_POST["attendance"];
		$new_stadium = $_POST["stadium"];
		$new_city = $_POST["city"];
		$new_country = $_POST["country"];
		$new_referee = $_POST["referee"];
		if (empty($_POST["nationality"])) {
			$new_nationality = NULL;
		} else {
			$new_nationality = $_POST["nationality"];
		}
		if ($_POST["status"] == "admitted") {
			$new_admitted = 1;
			$new_contender = 0;
		} elseif ($_POST["status"] == "contender") {
			$new_admitted = 0;
			$new_contender = 1;
		} else {
			$new_admitted = 0;
			$new_contender = 0;
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
		$new_score = $_POST["score"];
		$new_votes = $_POST["votes"];
		$new_rating= $_POST["rating"];
		$new_intro_text = $_POST["intro-text"];
		$new_match_report = $_POST["match-report"];

		$sql = "INSERT INTO matches (team_1, team_2, teams, score_1, score_2, extra_time, penalties, penalties_1, penalties_2, walkover, date, competition, tournament, stage, section, file_code, title, attendance, stadium, city, country, referee, ref_nat, active, contender, admission_date, admission_poll, score, votes, rating, intro_text, match_report)";
		$sql .= "VALUES (:NewTeam1, :NewTeam2, :NewTeams, :NewScore1, :NewScore2, :NewExtraTime, :NewPenalties, :NewPenalties1, :NewPenalties2, :NewWalkover, :NewDate, :NewCompetition, :NewTournament, :NewStage, :NewSection, :NewFileCode, :NewTitle, :NewAttendance, :NewStadium, :NewCity, :NewCountry, :NewReferee, :NewRefNat, :NewAdmitted, :NewContender, :NewAdmissionDate, :NewAdmissionPoll, :NewScore, :NewVotes, :NewRating, :NewIntroText, :NewMatchReport)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewTeam1', $new_team_1);
		$stmt->bindValue(':NewTeam2', $new_team_2);
		$stmt->bindValue(':NewTeams', $new_teams);
		$stmt->bindValue(':NewScore1', $new_score_1);
		$stmt->bindValue(':NewScore2', $new_score_2);
		$stmt->bindValue(':NewExtraTime', $new_extra_time);
		$stmt->bindValue(':NewPenalties', $new_penalties);
		$stmt->bindValue(':NewPenalties1', $new_penalties_1);
		$stmt->bindValue(':NewPenalties2', $new_penalties_2);
		$stmt->bindValue(':NewWalkover', $new_walkover);
		$stmt->bindValue(':NewDate', $new_date);
		$stmt->bindValue(':NewCompetition', $new_competition);
		$stmt->bindValue(':NewTournament', $new_tournament);
		$stmt->bindValue(':NewStage', $new_stage);
		$stmt->bindValue(':NewSection', $new_section);
		$stmt->bindValue(':NewFileCode', $new_file_code);
		$stmt->bindValue(':NewTitle', $new_title);
		$stmt->bindValue(':NewAttendance', $new_attendance);
		$stmt->bindValue(':NewStadium', $new_stadium);
		$stmt->bindValue(':NewCity', $new_city);
		$stmt->bindValue(':NewCountry', $new_country);
		$stmt->bindValue(':NewReferee', $new_referee);
		$stmt->bindValue(':NewRefNat', $new_nationality);
		$stmt->bindValue(':NewAdmitted', $new_admitted);
		$stmt->bindValue(':NewContender', $new_contender);
		$stmt->bindValue(':NewAdmissionDate', $new_admission_date);
		$stmt->bindValue(':NewAdmissionPoll', $new_admission_poll);
		$stmt->bindValue(':NewScore', $new_score);
		$stmt->bindValue(':NewVotes', $new_votes);
		$stmt->bindValue(':NewRating', $new_rating);
		$stmt->bindValue(':NewIntroText', $new_intro_text);
		$stmt->bindValue(':NewMatchReport', $new_match_report);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your match has been saved successfully.";
			
			if ($_POST['submit'] == 'Save and Add Another') {
				redirect_to("add_new.php?type=$table_id");
			} else if ($_POST['submit'] == 'Save and Add Lineups') {
				redirect_to("edit_record.php?type=people_matches");
			} else if ($_POST['submit'] == 'Save and Add Goals') {
				redirect_to("edit_record.php?type=goals");
			} else if ($_POST['submit'] == 'Save and Close') {
				if ($new_admitted == 1) {
				redirect_to("view_list.php?type=matches&status=active");
				} else if (($new_contender == 1) && ($new_admitted == 0)) {
					redirect_to("view_list.php?type=matches&status=contenders");
				} else if ($new_admitted == 0) {
					redirect_to("view_list.php?type=matches&status=inactive");
				}
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
