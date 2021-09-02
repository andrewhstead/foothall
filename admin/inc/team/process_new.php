<?php

	if(isset($_POST["submit"])) {
		
		$new_title = $_POST["title"];
		$new_team_type = $_POST["team-type"];
		$new_display_name = $_POST["display-name"];
		$new_team_name = $_POST["team-name"];
		$new_era = $_POST["era"];
		$new_file_code = $_POST["file-code"];
		$new_picture_credit = $_POST["picture-credit"];
		$new_license_link = $_POST["license-link"];
		if ($_POST["status"] == "active") {
			$new_active = true;
			$new_active = false;
		} elseif ($_POST["status"] == "contender") {
			$new_admitted = false;
			$new_contender = true;
		} else {
			$new_admitted = false;
			$new_contender = false;
		}
		if (empty($_POST["admission-date"])) {
			$new_admission_date = NULL;
		} else {
			$new_admission_date = $_POST["admission-date"];
		}
		if (empty($_POST["admission-poll"])) {
			$new_admission_poll = NULL;
		} else {
			$new_admission_poll = $_POST["admission-poll"];
		}
		$new_score = $_POST["score"];
		$new_votes = $_POST["votes"];
		$new_rating= $_POST["rating"];
		$new_intro_text = $_POST["intro-text"];
		$new_biography = $_POST["biography"];

		$sql = "INSERT INTO hall_teams (title, team_type, display_name, team_name, era, file_code, picture_credit, license_link, active, contender, admission_date, admission_poll, score, votes, rating, intro_text, biography)";
		$sql .= "VALUES (:NewTitle, :NewTeamType, :NewDisplayName, :NewTeamName, :NewFileCode, :NewEra, :NewPictureCredit, :NewLicenseLink, :NewContender, :NewActive, :NewAdmissionDate, :NewAdmissionPoll, :NewIntroText, :NewBiography, :NewScore, :NewVotes, :NewRating)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewTitle', $new_title);
		$stmt->bindValue(':NewTeamType', $new_team_type);
		$stmt->bindValue(':NewDisplayName', $new_display_name);
		$stmt->bindValue(':NewTeamName', $new_team_name);
		$stmt->bindValue(':NewFileCode', $new_file_code);
		$stmt->bindValue(':NewEra', $new_era);
		$stmt->bindValue(':NewPictureCredit', $new_picture_credit);
		$stmt->bindValue(':NewLicenseLink', $new_license_link);
		$stmt->bindValue(':NewContender', $new_contender);
		$stmt->bindValue(':NewActive', $new_active);
		$stmt->bindValue(':NewAdmissionDate', $new_admission_date);
		$stmt->bindValue(':NewAdmissionPoll', $new_admission_poll);
		$stmt->bindValue(':NewIntroText', $new_intro_text);
		$stmt->bindValue(':NewBiography', $new_biography);
		$stmt->bindValue(':NewScore', $new_score);
		$stmt->bindValue(':NewVotes', $new_votes);
		$stmt->bindValue(':NewRating', $new_rating);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your record has been saved successfully.";
			
			if ($new_active == true) {
				redirect_to("view_list.php?type=$table_id&status=active");
			} else if ($new_active == false) {
				redirect_to("view_list.php?type=$table_id&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
