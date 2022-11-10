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
		$new_gk = 1;
		$new_df = $_POST["df"];
		$new_mf = $_POST["mf"];
		$new_fw = $_POST["fw"];
		$new_sub = $_POST["sub"];

		$sql = "INSERT INTO dream_teams (name, scope, published, intro_text, profile, active, gk, df, mf, fw, sub)";
		$sql .= "VALUES (:NewName, :NewScope, :NewPublished, :NewIntroText, :NewProfile, :NewActive, :NewGk, :NewDf, :NewMf, :NewFw, :NewSub)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewName', $new_name);
		$stmt->bindValue(':NewScope', $new_scope);
		$stmt->bindValue(':NewPublished', $new_published);
		$stmt->bindValue(':NewIntroText', $new_intro_text);
		$stmt->bindValue(':NewProfile', $new_profile);
		$stmt->bindValue(':NewActive', $new_active);
		$stmt->bindValue(':NewGk', $new_gk);
		$stmt->bindValue(':NewDf', $new_df);
		$stmt->bindValue(':NewMf', $new_mf);
		$stmt->bindValue(':NewFw', $new_fw);
		$stmt->bindValue(':NewSub', $new_sub);

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
