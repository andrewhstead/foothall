<?php

	if(isset($_POST["submit"])) {
		
		$new_headline = $_POST["headline"];
		$new_published = $_POST["published"];
		$new_intro_text = $_POST["intro-text"];
		$new_text = $_POST["text"];
		if ($_POST["status"] == "active") {
			$new_active = 1;
		} else {
			$new_active = 0;
		}

		$sql = "INSERT INTO news (headline, published, intro_text, text, active)";
		$sql .= "VALUES (:NewHeadline, :NewPublished, :NewIntroText, :NewText, :NewActive)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewHeadline', $new_headline);
		$stmt->bindValue(':NewPublished', $new_published);
		$stmt->bindValue(':NewIntroText', $new_intro_text);
		$stmt->bindValue(':NewText', $new_text);
		$stmt->bindValue(':NewActive', $new_active);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your record has been saved successfully.";
			
			if ($new_active == 1) {
				redirect_to("view_list.php?type=$table_id&status=active");
			} else if ($new_active == 0) {
				redirect_to("view_list.php?type=$table_id&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
