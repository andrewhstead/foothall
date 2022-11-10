<?php

	if(isset($_POST["submit"])) {
		
		$new_competition = $_POST["competition"];
		$new_year = $_POST["year"];
		$new_name = $_POST["name"];
		if (isset($_POST["active"])) {
			$new_active = 1;
		} else {
			$new_active = 0;
		}
		if (isset($_POST["completed"])) {
			$new_completed = 1;
		} else {
			$new_completed = 0;
		}
		if (!empty($_POST["host"])) {
			$new_host = $_POST["host"];
		} else {
			$new_host = NULL;
		}
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

		$sql = "INSERT INTO tournaments (competition, year, name, active, completed, host, host_2, host_3, host_4, teams, games, goals, winner, runner_up, top_scorer, scored, intro_text, review)";
		$sql .= "VALUES (:NewCompetition, :NewYear, :NewName, :NewActive, :NewCompleted, :NewHost, :NewHost2, :NewHost3, :NewHost4, :NewTeams, :NewGames, :NewGoals, :NewWinner, :NewRunnerUp, :NewTopScorer, :NewGoalsTop, :NewIntroText, :NewReview)";
					
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
		$new_record = $connectDB->lastInsertId();

		$team_number = 1;
		
		/*while ($team_number <= $new_teams) {
			
			$tournament_teams = "INSERT INTO tournament_teams (tournament_name)";
			$tournament_teams .= "VALUES (:NewTournamentName)";
						
			$team_stmt = $connectDB->prepare($tournament_teams);
			$team_stmt->bindValue(':NewTournamentName', $new_name);
			$teams_execute = $team_stmt->execute();
			
			$team_number++;
			
		}*/
		
		if($execute/* AND $teams_execute*/) {

			$_SESSION["success_message"] = "Your match has been saved successfully.";
			
			if ($_POST['submit'] == 'Save and Add Teams') {
				redirect_to("edit_record.php?type=tournament_teams");
			} else if ($_POST['submit'] == 'Save and Finish') {
				if ($new_active == 1) {
				redirect_to("view_list.php?type=tournaments&status=active");
				} else if (($new_contender == 1) && ($new_active == 0)) {
					redirect_to("view_list.php?type=tournaments&status=contenders");
				} else if ($new_active == 0) {
					redirect_to("view_list.php?type=tournaments&status=inactive");
				}
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
