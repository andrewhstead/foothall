<?php

	if(isset($_POST["submit"])) {
		
		$new_name = $_POST["person-name"];
		$new_file_code = $_POST["file-code"];
		$new_nationality = $_POST["nationality"];
		if ($_POST["status"] == "admitted") {
			$new_admitted = true;
			$new_contender = false;
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
		if (isset($_POST["as-player"])) {
			$new_as_player = true;
		} else {
			$new_as_player = false;
		}
		if (isset($_POST["as-coach"])) {
			$new_as_coach = true;
		} else {
			$new_as_coach = false;
		}
		$new_score = $_POST["score"];
		$new_votes = $_POST["votes"];
		$new_rating= $_POST["rating"];
		$new_full_name = $_POST["full-name"];
		$new_birth_date = $_POST["birth-date"];
		$new_birth_place = $_POST["birth-place"];
		$new_birth_country = $_POST["birth-country"];
		if (isset($_POST["is-living"])) {
			$new_is_living = true;
		} else {
			$new_is_living = false;
		}
		$new_death_date = $_POST["death-date"];
		$new_position = $_POST["position"];
		$new_intro_text = $_POST["intro-text"];
		$new_picture_credit = $_POST["picture-credit"];
		$new_biography = $_POST["biography"];

		$sql = "INSERT INTO people (name, file_code, nationality, active, admission_date, admission_poll, as_player, as_coach, score, votes, rating, full_name, date_of_birth, place_of_birth, country_of_birth, living, date_of_death, position, intro_text, picture_credit, biography)";
		$sql .= "VALUES (:NewName, :NewFileCode, :NewNationality, :NewAdmitted, :NewAdmissionDate, :NewAdmissionPoll, :NewAsPlayer, :NewAsCoach, :NewScore, :NewVotes, :NewRating, :NewFullName, :NewBirthDate, :NewBirthPlace, :NewBirthCountry, :NewIsLiving, :NewDeathDate, :NewPosition, :NewIntroText, :NewPictureCredit, :NewBiography)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewName', $new_name);
		$stmt->bindValue(':NewFileCode', $new_file_code);
		$stmt->bindValue(':NewNationality', $new_nationality);
		$stmt->bindValue(':NewAdmitted', $new_admitted);
		$stmt->bindValue(':NewAdmissionDate', $new_admission_date);
		$stmt->bindValue(':NewAdmissionPoll', $new_admission_poll);
		$stmt->bindValue(':NewAsPlayer', $new_as_player);
		$stmt->bindValue(':NewAsCoach', $new_as_coach);
		$stmt->bindValue(':NewScore', $new_score);
		$stmt->bindValue(':NewVotes', $new_votes);
		$stmt->bindValue(':NewRating', $new_rating);
		$stmt->bindValue(':NewFullName', $new_full_name);
		$stmt->bindValue(':NewBirthDate', $new_birth_date);
		$stmt->bindValue(':NewBirthPlace', $new_birth_place);
		$stmt->bindValue(':NewBirthCountry', $new_birth_country);
		$stmt->bindValue(':NewIsLiving', $new_is_living);
		$stmt->bindValue(':NewDeathDate', $new_death_date);
		$stmt->bindValue(':NewPosition', $new_position);
		$stmt->bindValue(':NewIntroText', $new_intro_text);
		$stmt->bindValue(':NewPictureCredit', $new_picture_credit);
		$stmt->bindValue(':NewBiography', $new_biography);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your edits have been saved successfully.";
			
			if ($new_admitted == 1) {
				redirect_to("view_list.php?id=$table_id&status=active");
			} else if ($new_admitted == 0) {
				redirect_to("view_list.php?id=$table_id&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?id=$table_id");
			
		}

	}
	
?>
