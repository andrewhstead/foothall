<?php

	if(isset($_POST["submit"])) {
		
		$new_title = $_POST["title"];
		$new_category = $_POST["category"];
		$new_published = $_POST["published"];
		$new_intro_text = $_POST["intro-text"];
		$new_content = $_POST["content"];
		if ($_POST["status"] == "active") {
			$new_active = 1;
		} else {
			$new_active = 0;
		}

		$sql = "UPDATE stories SET title=:NewTitle, category=:NewCategory, published=:NewPublished, intro_text=:NewIntroText, content=:NewContent, active=:NewActive WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewTitle', $new_title);
		$stmt->bindValue(':NewCategory', $new_category);
		$stmt->bindValue(':NewPublished', $new_published);
		$stmt->bindValue(':NewIntroText', $new_intro_text);
		$stmt->bindValue(':NewContent', $new_content);
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
		
	$news = "SELECT * FROM stories WHERE id = '$record_id'";
	$news_query = $connectDB->query($news);
		
	while ($dataRows = $news_query->fetch()) {

		$database_id = $dataRows["id"];
		$title = $dataRows["title"];
		$category = $dataRows["category"];
		$published = strftime('%Y-%m-%dT%H:%M:%S', strtotime($dataRows['published']));
		$intro_text = $dataRows["intro_text"];
		$content = $dataRows["content"];
		$active = $dataRows["active"];
		
	}
	
?>
