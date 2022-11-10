<?php

	if(isset($_POST["submit"])) {
		
		$new_name = $_POST["name"];
		$new_scope = $_POST["scope"];
		$new_published = $_POST["published"];
		$new_intro_text = $_POST["intro-text"];
		$new_profile = $_POST["profile"];
		if ($_POST["status"] == "active") {
			$new_active = 1;
		} else {
			$new_active = 0;
		}
		$new_df = $_POST["df"];
		$new_mf = $_POST["mf"];
		$new_fw = $_POST["fw"];
		$new_sub = $_POST["sub"];

		$sql = "UPDATE dream_teams SET name=:NewName, scope=:NewScope, published=:NewPublished, intro_text=:NewIntroText, profile=:NewProfile, active=:NewActive, df=:NewDf, mf=:NewMf, fw=:NewFw, sub=:NewSub WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewName', $new_name);
		$stmt->bindValue(':NewScope', $new_scope);
		$stmt->bindValue(':NewPublished', $new_published);
		$stmt->bindValue(':NewIntroText', $new_intro_text);
		$stmt->bindValue(':NewProfile', $new_profile);
		$stmt->bindValue(':NewActive', $new_active);
		$stmt->bindValue(':NewDf', $new_df);
		$stmt->bindValue(':NewMf', $new_mf);
		$stmt->bindValue(':NewFw', $new_fw);
		$stmt->bindValue(':NewSub', $new_sub);

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
		
	$news = "SELECT * FROM dream_teams WHERE id = '$record_id'";
	$news_query = $connectDB->query($news);
		
	while ($dataRows = $news_query->fetch()) {

		$database_id = $dataRows["id"];
		$name = $dataRows["name"];
		$scope = $dataRows["scope"];
		$published = strftime('%Y-%m-%dT%H:%M:%S', strtotime($dataRows['published']));
		$intro_text = $dataRows["intro_text"];
		$profile = $dataRows["profile"];
		$active = $dataRows["active"];
		$gk = $dataRows["gk"];
		$df = $dataRows["df"];
		$mf = $dataRows["mf"];
		$fw = $dataRows["fw"];
		$sub = $dataRows["sub"];
		
	}
	
?>
