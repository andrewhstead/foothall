<?php

	if(isset($_POST["submit"])) {
		
		$new_type = $_POST["type"];
		$new_title = $_POST["title"];
		$new_category = $_POST["category"];
		$new_options = $_POST["options"];
		$new_places = $_POST["places"];
		$new_modified = date('Y-m-d H:i:s');
		$new_expiry = $_POST["expiry"];
		$new_intro_text = $_POST["intro-text"];
		$new_description = $_POST["description"];

		$sql = "INSERT INTO polls (poll_type, title, category, options, places, expiry, intro_text, description, published, modified)";
		$sql .= "VALUES (:NewPollType, :NewTitle, :NewCategory, :NewOptions, :NewPlaces, :NewExpiry, :NewIntroText, :NewDescription, :NewPublished, :NewModified)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewPollType', $new_type);
		$stmt->bindValue(':NewTitle', $new_title);
		$stmt->bindValue(':NewCategory', $new_category);
		$stmt->bindValue(':NewOptions', $new_options);
		$stmt->bindValue(':NewPlaces', $new_places);
		$stmt->bindValue(':NewExpiry', $new_expiry);
		$stmt->bindValue(':NewIntroText', $new_intro_text);
		$stmt->bindValue(':NewDescription', $new_description);
		$stmt->bindValue(':NewPublished', $new_published);
		$stmt->bindValue(':NewModified', $new_modified);

		$execute = $stmt->execute();
		$new_record = $connectDB->lastInsertId();

		$option_number = 1;
		
		while ($option_number <= $new_options) {
			
			$options = "INSERT INTO people_votes (poll, poll_option, option)";
			$options .= "VALUES ($new_record, :OptionNumber, NULL)";
						
			$option_stmt = $connectDB->prepare($options);
			$option_stmt->bindValue(':OptionNumber', $option_number);
			$option_execute = $option_stmt->execute();
			
			$option_number++;
			
		}
		
		if($execute AND $option_execute) {

			$_SESSION["success_message"] = "Your match has been saved successfully.";
			
			if ($_POST['submit'] == 'Save and Add Options') {
				redirect_to("edit_record.php?type=polls&code=$new_record");
			} else if ($_POST['submit'] == 'Save and Finish') {
				if ($new_active == true) {
				redirect_to("view_list.php?type=polls&status=active");
				} else if ($new_active == false) {
					redirect_to("view_list.php?type=polls&status=inactive");
				}
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
