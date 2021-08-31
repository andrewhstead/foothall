<?php

	if(isset($_POST["submit"])) {
		
		$new_poll = $_POST["poll"];
		$new_option = $_POST["option"];
		
		$highest_option = "SELECT MAX(poll_option) AS max_option FROM team_votes WHERE poll = $new_poll";
		$get_option = $connectDB->query($highest_option);
		
		while ($dataRows = $get_option->fetch()) {

			$max_option = $dataRows["max_option"];
			
		}
		
		$new_poll_option = $max_option + 1;
		
		$sql = "INSERT INTO team_votes (poll, poll_option, option)";
		$sql .= "VALUES (:NewPoll, :NewPollOption, :NewOption)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewPoll', $new_poll);
		$stmt->bindValue(':NewPollOption', $new_poll_option);
		$stmt->bindValue(':NewOption', $new_option);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your record has been saved successfully.";
			
			redirect_to("view_list.php?type=$table_id&status=active");
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
