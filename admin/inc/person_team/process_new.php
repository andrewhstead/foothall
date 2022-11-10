<?php

	if(isset($_POST["submit"])) {
		
		$new_person = $_POST["person"];
		$new_team = $_POST["team"];
		$new_hall_team = $_POST["hall-team"];
		$new_first = $_POST["first"];
		$new_last = $_POST["last"];
		$new_appearances = $_POST["appearances"];
		$new_goals = $_POST["goals"];
		$new_summary = $_POST["summary"];
		$new_active = 1;

		$sql = "INSERT INTO people_teams (person, team, hall_team, first, last, appearances, goals, summary)";
		$sql .= "VALUES (:NewPerson, :NewTeam, :NewHallTeam, :NewFirst, :NewLast, :NewAppearances, :NewGoals, :NewSummary)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewPerson', $new_person);
		$stmt->bindValue(':NewTeam', $new_team);
		$stmt->bindValue(':NewHallTeam', $new_hall_team);
		$stmt->bindValue(':NewFirst', $new_first);
		$stmt->bindValue(':NewLast', $new_last);
		$stmt->bindValue(':NewAppearances', $new_appearances);
		$stmt->bindValue(':NewGoals', $new_goals);
		$stmt->bindValue(':NewSummary', $new_summary);

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
