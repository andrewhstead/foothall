<?php
	$thispage = "Add New Person";

	session_start();
	
	require_once '../inc/db.php';
	require_once '../inc/functions.php';
	include 'inc/header.html';
	
	confirm_login();
	
	$connectDB;
	
	if(isset($_POST["submit"])) {
		
		$new_name = $_POST["person-name"];
		$new_file_code = $_POST["file-code"];
		$new_nationality = $_POST["nationality"];
		if (isset($_POST["admitted"])) {
			$new_admitted = true;
		} else {
			$new_admitted = false;
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
				redirect_to("view_list.php?id=8&status=active");
			} else if ($new_admitted == 0) {
				redirect_to("view_list.php?id=8&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_person.php");
			
		}

	}
	
?>

	<div class="page-template">
	
		<h1>
			Add New Person
		</h1>		
		
		<form class="edit-form" method="post" action="new_person.php">
				
				<label for="person-name">Display Name:</label>
				<input type="text" name="person-name" placeholder="Name to Display" id="person-name">
				<br>
				<label for="full-name">Full Name:</label>
				<input type="text" name="full-name" placeholder="Full Name" id="full-name" >
				<br>
				<label for="file-code">File Code:</label>
				<input type="text" name="file-code" placeholder="File Code" id="file-code">
				<br>
				<label for="picture-credit">Picture Credit:</label>
				<input type="text" name="picture-credit" placeholder="Picture Credit" id="picture-credit">
				<br><br>
				<label for="admitted">Admitted?</label>
				<input type="checkbox" name="admitted" id="admitted">
				<br>
				<label for="admission-date">Admission Date:</label>
				<input type="date" name="admission-date" placeholder="DD-MM-YYYY" id="admission-date">
				<br>
				<label for="admission-poll">Admission Poll:</label>
				<input type="text" name="admission-poll" placeholder="Admitted in Poll..." id="admission-poll">
				<br>
				<label for="as-player">Player?</label>
				<input type="checkbox" name="as-player" id="as-player">
				<label for="as-coach">Coach?</label>
				<input type="checkbox" name="as-coach" id="as-coach">
				<br><br>
				<label for="score">Total Rating Score:</label>
				<input type="text" name="score" placeholder="Total Rating Score..." id="score">
				<br>
				<label for="votes">Rating Votes:</label>
				<input type="text" name="votes" placeholder="Rating Votes..." id="votes">
				<br>
				<label for="rating">Average Rating:</label>
				<input type="text" name="rating" placeholder="Average Rating..." id="rating">
				<br><br>
				<label for="birth-date">Date of Birth:</label>
				<input type="date" name="birth-date" placeholder="DD-MM-YYYY" id="birth-date">
				<br>
				<label for="birth-place">Place of Birth:</label>
				<input type="text" name="birth-place" placeholder="Place of Birth" id="birth-place">
				<br>
				<label for="birth-country">Country of Birth:</label>
				<input type="text" name="birth-country" placeholder="Country of Birth" id="birth-country">
				<br>
				<label for="nationality">Nationality:</label>
				<select id="nationality" name="nationality">
				<?php
					$countries = "SELECT * FROM countries WHERE affiliated = true OR defunct = true ORDER BY display_name";
					$country_query = $connectDB->query($countries);
					while ($dataRows = $country_query->fetch()) {
						$country_name = $dataRows["display_name"];
						$country_abbreviation = $dataRows["abbreviation"];
						echo '<option value="'.$dataRows["abbreviation"].'">'.$dataRows["display_name"].'</option>';
					}
				?>	
				</select>
				<br>
				<label for="position">Position:</label>
				<input type="text" name="position" placeholder="Position" id="position">
				<br><br>
				<label for="is-living">Living?</label>
				<input type="checkbox" name="is-living" id="is-living">
				<br>
				<label for="death-date">Date of Death:</label>
				<input type="date" name="death-date" placeholder="DD-MM-YYYY" id="death-date">
				<br><br>
				<label for="intro-text">Introductory Text:</label>
				<textarea class="editable-area" rows="5" cols="35" name="intro-text"></textarea>
				<br><br>
				<label for="biography">Biography:</label>
				<textarea class="editable-area" rows="10" cols="35" name="biography"></textarea>
				<br><br>
				<input class="submit-button" type="submit" name="submit" value="Add Record">
			
		</form>		
		
	</div>
	
<?php

	include 'inc/footer.html';
	
?>
