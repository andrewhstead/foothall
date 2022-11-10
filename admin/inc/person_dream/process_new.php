<?php

	if(isset($_POST["submit"])) {
		
		$new_person = $_POST["person"];
		$new_dream_team = $_POST["dream-team"];
		$new_number = $_POST["number"];
		$new_position = $_POST["position"];

		$sql = "INSERT INTO people_dream (person, dream_team, number, position)";
		$sql .= "VALUES (:NewPerson, :NewDream, :NewNumber, :NewPosition)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewPerson', $new_person);
		$stmt->bindValue(':NewDream', $new_dream_team);
		$stmt->bindValue(':NewNumber', $new_number);
		$stmt->bindValue(':NewPosition', $new_position);

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
