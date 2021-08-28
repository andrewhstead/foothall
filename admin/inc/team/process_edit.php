<?php

	if(isset($_POST["submit"])) {
		
		$new_title = $_POST["title"];
		$new_display_name = $_POST["display-name"];
		$new_team_name = $_POST["team-name"];
		$new_era = $_POST["era"];
		$new_file_code = $_POST["file-code"];
		$new_picture_credit = $_POST["picture-credit"];
		$new_license_link = $_POST["license-link"];
		if ($_POST["status"] == "active") {
			$new_active = true;
			$new_contender = false;
		} elseif ($_POST["status"] == "contender") {
			$new_active = false;
			$new_contender = true;
		} else {
			$new_active = false;
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
		
		$sql = "UPDATE hall_teams SET title=:NewTitle, display_name=:NewDisplayName, team_name=:NewTeamName, file_code=:NewFileCode, era=:NewEra, picture_credit=:NewPictureCredit, license_link=:NewLicenseLink, contender=:NewContender, active=:NewActive, admission_date=:NewAdmissionDate, admission_poll=:NewAdmissionPoll, intro_text=:NewIntroText, biography=:NewBiography, score=:NewScore, votes=:NewVotes, rating=:NewRating WHERE file_code = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewTitle', $new_title);
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

			$_SESSION["success_message"] = "Your edits have been saved successfully.";
			
			if ($new_active == true) {
				redirect_to("view_list.php?type=$table_id&status=active");
			} else if (($new_contender == true) && ($new_active == false)) {
				redirect_to("view_list.php?type=$table_id&status=contenders");
			} else if ($new_active == 0) {
				redirect_to("view_list.php?type=$table_id&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("edit_record.php?type=$table_id&code=$file_code");
			
		}

	}
		
	$team = "SELECT * FROM hall_teams  
		WHERE file_code = '$record_id'";
	$team_query = $connectDB->query($team);
		
	while ($dataRows = $team_query->fetch()) {
		
		$database_id = $dataRows["id"];
		$title = $dataRows["title"];
		$display_name = $dataRows["display_name"];
		$team_name = $dataRows["team_name"];
		$era = $dataRows["era"];
		$file_code = $dataRows["file_code"];
		$picture_credit = $dataRows["picture_credit"];
		$license_link = $dataRows["license_link"];
		$contender = $dataRows["contender"];
		$active = $dataRows["active"];
		$admission_date = $dataRows["admission_date"];
		$admission_poll = $dataRows["admission_poll"];
		$score = $dataRows["score"];
		$votes = $dataRows["votes"];
		$rating = $dataRows["rating"];
		$intro_text = $dataRows["intro_text"];
		$biography = $dataRows["biography"];
		
	}
	
?>
