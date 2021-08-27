<?php

	if(isset($_POST["submit"])) {
		
		$new_type = $_POST["type"];
		$new_title = $_POST["title"];
		$new_category = $_POST["category"];
		$new_options = $_POST["options"];
		$new_places = $_POST["places"];
		if (isset($_POST["active"])) {
			$new_active = true;
			$new_published = date('Y-m-d H:i:s');
		} else {
			$new_active = false;
			$new_published = NULL;			
		}
		if (isset($_POST["locked"])) {
			$new_locked = true;
		} else {
			$new_locked = false;
		}
		$new_modified = date('Y-m-d H:i:s');
		$new_expiry = $_POST["expiry"];
		$new_intro_text = $_POST["intro-text"];
		$new_description = $_POST["description"];
		$new_option = 1;
		
		while ($new_option <= $new_options) {
			
			${'new_option_'.$new_option} = $_POST["option-$new_option"];
			$options = "UPDATE people_votes SET option=:NewOption$new_option WHERE poll_option = $new_option";
						
			$option_stmt = $connectDB->prepare($options);
			$option_stmt->bindValue(':NewOption'.$new_option, ${'new_option_'.$new_option});
			$option_execute = $option_stmt->execute();
			
			$new_option++;
			
		}
		
		$sql = "UPDATE polls SET poll_type=:NewPollType, title=:NewTitle, category=:NewCategory, options=:NewOptions, places=:NewPlaces, active=:NewActive, locked=:NewLocked, expiry=:NewExpiry,  published=:NewPublished, modified=:NewModified,intro_text=:NewIntroText, description=:NewDescription WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewPollType', $new_type);
		$stmt->bindValue(':NewTitle', $new_title);
		$stmt->bindValue(':NewCategory', $new_category);
		$stmt->bindValue(':NewOptions', $new_options);
		$stmt->bindValue(':NewPlaces', $new_places);
		$stmt->bindValue(':NewActive', $new_active);
		$stmt->bindValue(':NewLocked', $new_locked);
		$stmt->bindValue(':NewExpiry', $new_expiry);
		$stmt->bindValue(':NewIntroText', $new_intro_text);
		$stmt->bindValue(':NewDescription', $new_description);
		$stmt->bindValue(':NewPublished', $new_published);
		$stmt->bindValue(':NewModified', $new_modified);
		$execute = $stmt->execute();
			
		if($execute AND $option_execute) {

			$_SESSION["success_message"] = "Your edits have been saved successfully.";
			
			if ($new_active == true) {
				redirect_to("view_list.php?type=polls&status=active");
			} else if ($new_active == false) {
				redirect_to("view_list.php?type=polls&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("edit_record.php?type=$table_id&code=$database_id");
			
		}

	}
		
	$poll = "SELECT * FROM polls 
		WHERE id = '$record_id'";
	$poll_query = $connectDB->query($poll);
		
	while ($dataRows = $poll_query->fetch()) {
		
		$database_id = $dataRows["id"];
		$type = $dataRows["poll_type"];
		$title = $dataRows["title"];
		$category = $dataRows["category"];
		$options = $dataRows["options"];
		$places = $dataRows["places"];
		$active = $dataRows["active"];
		$locked = $dataRows["locked"];
		$expiry = strftime('%Y-%m-%dT%H:%M:%S', strtotime($dataRows['expiry']));
		$published = strftime('%Y-%m-%dT%H:%M:%S', strtotime($dataRows['published']));
		$modified = strftime('%Y-%m-%dT%H:%M:%S', strtotime($dataRows['modified']));
		$intro_text = $dataRows["intro_text"];
		$description = $dataRows["description"];
		
	}
		
	$option_list = "SELECT * FROM people_votes 
		WHERE poll = '$record_id'";
	$option_query = $connectDB->query($option_list);
	$poll_option = array();
		
	while ($dataRows = $option_query->fetch()) {
		
		$option_number = $dataRows["poll_option"];
		$option_person = $dataRows["option"];
			
		$poll_option[$option_number] = $option_person;
		
	}
	
?>
