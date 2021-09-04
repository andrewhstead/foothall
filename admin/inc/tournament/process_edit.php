<?php

	if(isset($_POST["submit"])) {
		
		$new_competition = $_POST["competition"];
		$new_year = $_POST["year"];
		$new_name = $_POST["name"];
		if (isset($_POST["active"])) {
			$new_active = true;
		} else {
			$new_active = false;
		}
		if (isset($_POST["completed"])) {
			$new_completed = true;
		} else {
			$new_completed = false;
		}
		$new_host = $_POST["host"];
		if (!empty($_POST["host-2"])) {
			$new_host_2 = $_POST["host-2"];
		} else {
			$new_host_2 = NULL;
		}
		if (!empty($_POST["host-3"])) {
			$new_host_3 = $_POST["host-3"];
		} else {
			$new_host_3 = NULL;
		}
		if (!empty($_POST["host-4"])) {
			$new_host_4 = $_POST["host-4"];
		} else {
			$new_host_4 = NULL;
		}
		$new_teams = $_POST["teams"];
		$new_games = $_POST["games"];
		$new_goals = $_POST["goals"];
		$new_winner = $_POST["winner"];
		$new_runner_up = $_POST["runner-up"];
		$new_top_scorer = $_POST["top-scorer"];
		$new_goals_top = $_POST["goals-top"];
		$new_intro_text = $_POST["intro-text"];
		$new_review = $_POST["review"];
		
		$team_number = 1;
		$new_team_list = array();
		foreach ($_POST["team-list"] as $list_team) {
			$new_team_list[$team_number] = $list_team;
			$team_number++;
		}
		
		$sql = "UPDATE tournaments SET competition=:NewCompetition, year=:NewYear, name=:NewName, active=:NewActive, completed=:NewCompleted, host=:NewHost, host_2=:NewHost2, host_3=:NewHost3,  host_4=:NewHost4, teams=:NewTeams, games=:NewGames, goals=:NewGoals, winner=:NewWinner, runner_up=:NewRunnerUp, top_scorer=:NewTopScorer, scored=:NewGoalsTop, intro_text=:NewIntroText, review=:NewReview WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewCompetition', $new_competition);
		$stmt->bindValue(':NewYear', $new_year);
		$stmt->bindValue(':NewName', $new_name);
		$stmt->bindValue(':NewActive', $new_active);
		$stmt->bindValue(':NewCompleted', $new_completed);
		$stmt->bindValue(':NewHost', $new_host);
		$stmt->bindValue(':NewHost2', $new_host_2);
		$stmt->bindValue(':NewHost3', $new_host_3);
		$stmt->bindValue(':NewHost4', $new_host_4);
		$stmt->bindValue(':NewTeams', $new_teams);
		$stmt->bindValue(':NewGames', $new_games);
		$stmt->bindValue(':NewGoals', $new_goals);
		$stmt->bindValue(':NewWinner', $new_winner);
		$stmt->bindValue(':NewRunnerUp', $new_runner_up);
		$stmt->bindValue(':NewTopScorer', $new_top_scorer);
		$stmt->bindValue(':NewGoalsTop', $new_goals_top);
		$stmt->bindValue(':NewIntroText', $new_intro_text);
		$stmt->bindValue(':NewReview', $new_review);
		
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
		
	$tournament = "SELECT * FROM tournaments  
		WHERE id = '$record_id'";
	$tournament_query = $connectDB->query($tournament);
		
	while ($dataRows = $tournament_query->fetch()) {
		
		$database_id = $dataRows["id"];
		$competition = $dataRows["competition"];
		$year = $dataRows["year"];
		$name = $dataRows["name"];
		$active = $dataRows["active"];
		$completed = $dataRows["completed"];
		$host = $dataRows["host"];
		$host_2 = $dataRows["host_2"];
		$host_3 = $dataRows["host_3"];
		$host_4 = $dataRows["host_4"];
		$teams = $dataRows["teams"];
		$games = $dataRows["games"];
		$goals = $dataRows["goals"];
		$winner = $dataRows["winner"];
		$runner_up = $dataRows["runner_up"];
		$top_scorer = $dataRows["top_scorer"];
		$scored = $dataRows["scored"];
		$intro_text = $dataRows["intro_text"];
		$review = $dataRows["review"];
		
	}
	
?>
