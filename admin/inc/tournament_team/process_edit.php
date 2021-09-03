<?php

	if(isset($_POST["submit"])) {
		
		$new_tournament = $_POST["tournament"];
		$new_team = $_POST["team"];
		$new_section = $_POST["section"];
		$new_reached = $_POST["reached"];
		if ($_POST["status"] == "active") {
			$new_active = true;
		} else {
			$new_active = false;
		}

		$sql = "UPDATE tournament_teams SET tournament_name=:NewTournament, team_name=:NewTeam, section=:NewSection, reached=:NewReached, active=:NewActive WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewTournament', $new_tournament);
		$stmt->bindValue(':NewTeam', $new_team);
		$stmt->bindValue(':NewSection', $new_section);
		$stmt->bindValue(':NewReached', $new_reached);
		$stmt->bindValue(':NewActive', $new_active);

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
		
	$news = "SELECT * FROM tournament_teams WHERE id = '$record_id'";
	$news_query = $connectDB->query($news);
		
	while ($dataRows = $news_query->fetch()) {

		$database_id = $dataRows["id"];
		$team_name = $dataRows["team_name"];
		$tournament_name = $dataRows["tournament_name"];
		$section = $dataRows["section"];
		$reached = $dataRows["reached"];
		$active = $dataRows["active"];
		
	}
	
?>
