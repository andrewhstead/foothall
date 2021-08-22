<?php

	if(isset($_POST["submit"])) {
		
		$new_headline = $_POST["headline"];
		$new_published = $_POST["published"];
		$new_intro_text = $_POST["intro-text"];
		$new_text = $_POST["text"];
		if ($_POST["status"] == "active") {
			$new_active = true;
		} else {
			$new_active = false;
		}

		$sql = "UPDATE news SET headline=:NewHeadline, published=:NewPublished, intro_text=:NewIntroText, text=:NewText, active=:NewActive WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewHeadline', $new_headline);
		$stmt->bindValue(':NewPublished', $new_published);
		$stmt->bindValue(':NewIntroText', $new_intro_text);
		$stmt->bindValue(':NewText', $new_text);
		$stmt->bindValue(':NewActive', $new_active);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your edits have been saved successfully.";
			
			if ($new_active == true) {
				redirect_to("view_list.php?type=news&status=active");
			} else if ($new_active == false) {
				redirect_to("view_list.php?type=news&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("edit_record.php?type=$table_id&code=$database_id");
			
		}

	}
		
	$news = "SELECT * FROM news WHERE id = '$record_id'";
	$news_query = $connectDB->query($news);
		
	while ($dataRows = $news_query->fetch()) {

		$database_id = $dataRows["id"];
		$headline = $dataRows["headline"];
		$published = strftime('%Y-%m-%dT%H:%M:%S', strtotime($dataRows['published']));
		$intro_text = $dataRows["intro_text"];
		$text = $dataRows["text"];
		$active = $dataRows["active"];
		
	}
	
?>
