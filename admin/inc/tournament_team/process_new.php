<?php

	if(isset($_POST["submit"])) {
		
		$new_tournament = $_POST["tournament"];
		$new_team = $_POST["team"];
		if (!empty($_POST["name-in-tournament"])) {
			$new_display_name = $_POST["name-in-tournament"];
		} else {
			$new_display_name = NULL;
		}
		if (!empty($_POST["tournament-code"])) {
			$new_tournament_code = $_POST["tournament-code"];
		} else {
			$new_tournament_code = NULL;
		}
		$new_section = $_POST["section"];
		$new_reached = $_POST["reached"];
		if ($_POST["status"] == "active") {
			$new_active = 1;
		} else {
			$new_active = 0;
		}

		$sql = "INSERT INTO tournament_teams (tournament_name, team_name, display_name, tournament_code, section, reached, active)";
		$sql .= "VALUES (:NewTournament, :NewTeam, :NewDisplayName, :NewTournamentCode, :NewSection, :NewReached, :NewActive)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewTournament', $new_tournament);
		$stmt->bindValue(':NewTeam', $new_team);
		$stmt->bindValue(':NewDisplayName', $new_display_name);
		$stmt->bindValue(':NewTournamentCode', $new_tournament_code);
		$stmt->bindValue(':NewSection', $new_section);
		$stmt->bindValue(':NewReached', $new_reached);
		$stmt->bindValue(':NewActive', $new_active);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your record has been saved successfully.";
			
			if ($_POST['submit'] == 'Save and Add Another') {
				redirect_to("add_new.php?type=$table_id");
			} else if ($_POST['submit'] == 'Save and Close') {
				if ($new_active == 1) {
				redirect_to("view_list.php?type=$table_id&status=active");
				} else if ($new_active == 0) {
					redirect_to("view_list.php?type=$table_id&status=inactive");
				}
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
