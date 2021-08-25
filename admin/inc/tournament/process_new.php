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
		$new_games = $_POST["games"];
		$new_goals = $_POST["goals"];
		$new_winner = $_POST["winner"];
		$new_runner_up = $_POST["runner-up"];
		$new_top_scorer = $_POST["top-scorer"];
		$new_goals_top = $_POST["goals-top"];
		$new_intro_text = $_POST["intro-text"];
		$new_review = $_POST["review"];

		$sql = "INSERT INTO tournaments (competition, year, name, active, completed, host, host_2, host_3, host_4, games, goals, winner, runner_up, top_scorer, scored, intro_text, review)";
		$sql .= "VALUES (:NewCompetition, :NewYear, :NewName, :NewActive, :NewCompleted, :NewHost, :NewHost2, :NewHost3, :NewHost4, :NewGames, :NewGoals, :NewWinner, :NewRunnerUp, :NewTopScorer, :NewNationality, :NewGoalsTop, :NewIntroText, :NewReview)";
					
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

			$_SESSION["success_message"] = "Your match has been saved successfully.";
			
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
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
