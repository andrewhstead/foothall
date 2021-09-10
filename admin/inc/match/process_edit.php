<?php

	if(isset($_POST["submit"])) {
		
		$new_team_1 = $_POST["team-1"];
		$new_team_2 = $_POST["team-2"];
		$new_teams = $_POST["teams-type"];
		$new_score_1 = $_POST["score-1"];
		$new_score_2 = $_POST["score-2"];
		if (isset($_POST["extra-time"])) {
			$new_extra_time = true;
		} else {
			$new_extra_time = false;
		}
		if (isset($_POST["penalties"])) {
			$new_penalties = true;
		} else {
			$new_penalties = false;
		}
		if (!empty($POST["penalties-1"])) {
			$penalties_1 = $POST["penalties-1"];
		} else {
			$penalties_1 = NULL;
		}
		if (!empty($POST["penalties-2"])) {
			$penalties_2 = $POST["penalties-2"];
		} else {
			$penalties_2 = NULL;
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
		if (!empty($_POST["title"])) {
			$title = $POST["title"];
		} else {
			$title = NULL;
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
			$new_admitted = true;
			$new_contender = false;
		} elseif ($_POST["status"] == "contender") {
			$new_admitted = false;
			$new_contender = true;
		} else {
			$new_admitted = false;
			$new_contender = false;
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
		
		$sql = "UPDATE matches SET team_1=:NewTeam1, team_2=:NewTeam2, teams=:NewTeams, score_1=:NewScore1, score_2=:NewScore2, extra_time=:NewExtraTime, penalties=:NewPenalties, penalties_1=:NewPenalties1, penalties_2=:NewPenalties2, walkover=:NewWalkover, date=:NewDate, competition=:NewCompetition, tournament=:NewTournament, stage=:NewStage, section=:NewSection, file_code=:NewFileCode, title=:NewTitle, attendance=:NewAttendance, stadium=:NewStadium, city=:NewCity, country=:NewCountry, referee=:NewReferee, ref_nat=:NewRefNat, contender=:NewContender, active=:NewAdmitted, admission_date=:NewAdmissionDate, admission_poll=:NewAdmissionPoll, score=:NewScore, votes=:NewVotes, rating=:NewRating, intro_text=:NewIntroText, match_report=:NewMatchReport WHERE file_code = '$record_id'";
					
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

			$_SESSION["success_message"] = "Your edits have been saved successfully.";
			
			if ($_POST['submit'] == 'Save and Add Lineups') {
				redirect_to("edit_record.php?type=people_matches");
			} else if ($_POST['submit'] == 'Save and Add Goals') {
				redirect_to("edit_record.php?type=goals");
			} else if ($_POST['submit'] == 'Save and Finish') {
				if ($new_admitted == true) {
				redirect_to("view_list.php?type=matches&status=active");
				} else if (($new_contender == true) && ($new_admitted == false)) {
					redirect_to("view_list.php?type=matches&status=contenders");
				} else if ($new_admitted == 0) {
					redirect_to("view_list.php?type=matches&status=inactive");
				}
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("edit_record.php?type=matches&code=$file_code");
			
		}

	}
		
	$match = "SELECT matches.*, team_1.name AS team_1_full, team_2.name AS team_2_full FROM matches  
		INNER JOIN teams team_1 ON matches.team_1 = team_1.name 
		INNER JOIN teams team_2 ON matches.team_2 = team_2.name
		WHERE file_code = '$record_id'";
	$match_query = $connectDB->query($match);
		
	while ($dataRows = $match_query->fetch()) {
		
		$database_id = $dataRows["id"];
		$team_1 = $dataRows["team_1"];
		$team_2 = $dataRows["team_2"];
		$team_1_full = $dataRows["team_1_full"];
		$team_2_full = $dataRows["team_2_full"];
		$teams = $dataRows["teams"];
		$score_1 = $dataRows["score_1"];
		$score_2 = $dataRows["score_2"];
		$extra_time = $dataRows["extra_time"];
		$penalties = $dataRows["penalties"];
		if (!empty($penalties_1)) {
			$penalties_1 = $dataRows["penalties_1"];
		} else {
			$penalties_1 = NULL;
		}
		if (!empty($penalties_2)) {
			$penalties_2 = $dataRows["penalties_2"];
		} else {
			$penalties_2 = NULL;
		}
		if (!empty($walkover)) {
			$walkover = $dataRows["walkover"];
		} else {
			$walkover = NULL;
		}
		$date = $dataRows["date"];
		$competition = $dataRows["competition"];
		$tournament = $dataRows["tournament"];
		$stage = $dataRows["stage"];
		$section = $dataRows["section"];
		$file_code = $dataRows["file_code"];
		$title = $dataRows["title"];
		$attendance = $dataRows["attendance"];
		$stadium = $dataRows["stadium"];
		$city = $dataRows["city"];
		$country = $dataRows["country"];
		$referee = $dataRows["referee"];
		$nationality = $dataRows["ref_nat"];
		$contender = $dataRows["contender"];
		$admitted = $dataRows["active"];
		if (($contender == true) or ($admitted == true)) {
			$inactive = false;
		} else {
			$inactive = true;
		}
		$admission_date = $dataRows["admission_date"];
		$admission_poll = $dataRows["admission_poll"];
		$score = $dataRows["score"];
		$votes = $dataRows["votes"];
		$rating = $dataRows["rating"];
		$intro_text = $dataRows["intro_text"];
		$match_report = $dataRows["match_report"];
		
	}
	
?>
