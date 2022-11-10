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
			$new_own_goal = 1;
		} else {
			$new_own_goal = 0;
		}
		if (isset($_POST["penalty"])) {
			$new_penalty = 1;
		} else {
			$new_penalty = 0;
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

		$sql = "UPDATE goals SET match_code=:NewMatch, team=:NewTeam, scorer=:NewScorer, assist=:NewAssist, own_goal=:NewOwnGoal, penalty=:NewPenalty, minute=:NewMinute, stoppage_time=:NewStoppage, half=:NewHalf, score=:NewScore, active=:NewActive WHERE id = '$record_id'";
					
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
		
	$news = "SELECT * FROM goals WHERE id = '$record_id'";
	$news_query = $connectDB->query($news);
		
	while ($dataRows = $news_query->fetch()) {

		$database_id = $dataRows["id"];
		$match = $dataRows["match_code"];
		$team = $dataRows["team"];
		$scorer = $dataRows["scorer"];
		$assist = $dataRows["assist"];
		$own_goal = $dataRows["own_goal"];
		$penalty = $dataRows["penalty"];
		$minute = $dataRows["minute"];
		$stoppage = $dataRows["stoppage_time"];
		$half = $dataRows["half"];
		$score = $dataRows["score"];
		$active = $dataRows["active"];
		
	}
	
?>
