<?php

	if(isset($_POST["submit"])) {
		
		$new_match = $_POST["match"];
		$new_team = $_POST["team"];
		$new_scorer = $_POST["scorer"];
		if (isset($_POST["assist"])) {
			$new_assist = $_POST["assist"];
		} else {
			$new_assist = NULL;
		}
		if (isset($_POST["own-goal"])) {
			$new_own_goal = true;
		} else {
			$new_own_goal = false;
		}
		if (isset($_POST["penalty"])) {
			$new_penalty = true;
		} else {
			$new_penalty = false;
		}
		$new_minute = $_POST["minute"];
		if (isset($_POST["stoppage"])) {
			$new_stoppage = $_POST["stoppage"];
		} else {
			$new_stoppage = NULL;
		}
		$new_half = $_POST["half"];
		$new_score = $_POST["score"];
		$new_active = true;

		$sql = "INSERT INTO goals (match, team, scorer, assist, own_goal, penalty, minute, stoppage, half, score, active)";
		$sql .= "VALUES (:NewMatch, :NewTeam, :NewScorer, :NewAssist, :NewOwnGoal, :NewPenalty, :NewMinute, :NewStoppage, :NewHalf, :NewScore, :NewActive)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewMatch', $new_match);
		$stmt->bindValue(':NewTeam', $new_team);
		$stmt->bindValue(':NewScorer', $new_scorer);
		$stmt->bindValue(':NewAssist', $new_assist);
		$stmt->bindValue(':NewOwnGoal', $new_own_goal);
		$stmt->bindValue(':NewPenalty', $new_penalty);
		$stmt->bindValue(':NewMinute', $new_minute);
		$stmt->bindValue(':NewStoppage', $new_stoppage);
		$stmt->bindValue(':NewHalf', $new_half);
		$stmt->bindValue(':NewScore', $new_score);
		$stmt->bindValue(':NewActive', $new_active);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your record has been saved successfully.";
			
			if ($new_active == true) {
				redirect_to("view_list.php?type=$table_id&status=active");
			} else if ($new_active == false) {
				redirect_to("view_list.php?type=$table_id&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
