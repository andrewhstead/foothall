<?php
	$thispage = "Edit Person";
	
	require_once '../inc/db.php';

	include 'inc/header.html';
					
	if (isset($_GET["id"])) {
		$person_id = $_GET["id"];
	} else {
		$person_id = 1;
	}
						
	$connectDB;
	
	$person = "SELECT * FROM people WHERE id = '$person_id'";
	$person_query = $connectDB->query($person);
	
	while ($dataRows = $person_query->fetch()) {

		$name = $dataRows["name"];
		$file_code = $dataRows["file_code"];
		$nationality = $dataRows["nationality"];
		$admitted = $dataRows["active"];
		$admission_date = $dataRows["admission_date"];
		$admission_poll = $dataRows["admission_poll"];
		$as_player = $dataRows["as_player"];
		$as_coach = $dataRows["as_coach"];
		$score = $dataRows["score"];
		$votes = $dataRows["votes"];
		$rating = $dataRows["rating"];
		$full_name = $dataRows["full_name"];
		$date_of_birth = $dataRows["date_of_birth"];
		$place_of_birth = $dataRows["place_of_birth"];
		$country_of_birth = $dataRows["country_of_birth"];
		$living = $dataRows["living"];
		$date_of_death = $dataRows["date_of_death"];
		$position = $dataRows["position"];
		$intro_text = $dataRows["intro_text"];
		$picture_credit = $dataRows["picture_credit"];
		$biography = $dataRows["biography"];
		
	}
		
?>

	<div class="page-template">
	
		<h1>
			Edit Person
		</h1>		
	
		<h2>
			<img class="text-icon" src="../img/flags/<?php echo strtolower($nationality); ?>
				.png" alt="<?php echo htmlentities($nationality); ?>">
			<?php echo htmlentities($name).'<br>id: '.htmlentities($person_id); ?>
		</h2>
		
		<form class="edit-form" method="post" action="edit_person.php?id=<?php echo $name; ?>">
				
				<label for="person-name">Display Name:</label>
				<input type="text" name="person-name" placeholder="Name to Display" id="person-name" value="<?php echo $name; ?>">
				<br>
				<label for="full-name">Full Name:</label>
				<input type="text" name="full-name" placeholder="Full Name" id="full-name" value="<?php echo $full_name; ?>">
				<br>
				<label for="file-code">File Code:</label>
				<input type="text" name="file-code" placeholder="File Code" id="file-code" value="<?php echo $file_code; ?>">
				<br>
				<label for="picture-credit">Picture Credit:</label>
				<input type="text" name="picture-credit" placeholder="Picture Credit" id="picture-credit" value="<?php echo $picture_credit; ?>">
				<br><br>
				<label for="admitted">Admitted?</label>
				<input type="checkbox" name="admitted" id="admitted" value="<?php echo $admitted; ?>">
				<br>
				<label for="admission-date">Admission Date:</label>
				<input type="date" name="admission-date" placeholder="DD-MM-YYYY" id="admission-date" value="<?php echo $admission_date; ?>">
				<br>
				<label for="admission-poll">Admission Poll:</label>
				<input type="text" name="admission-poll" placeholder="Admitted in Poll..." id="admission-poll" value="<?php echo $admission_poll; ?>">
				<br>
				<label for="as-player">Player?</label>
				<input type="checkbox" name="as-player" id="as-player" value="<?php echo $as_player; ?>">
				<label for="as-coach">Coach?</label>
				<input type="checkbox" name="as-coach" id="as-coach" value="<?php echo $as_coach; ?>">
				<br><br>
				<label for="score">Total Rating Score:</label>
				<input type="text" name="score" placeholder="Total Rating Score..." id="score" value="<?php echo $score; ?>">
				<br>
				<label for="votes">Rating Votes:</label>
				<input type="text" name="votes" placeholder="Rating Votes..." id="votes" value="<?php echo $votes; ?>">
				<br>
				<label for="rating">Average Rating:</label>
				<input type="text" name="rating" placeholder="Average Rating..." id="rating" value="<?php echo $rating; ?>">
				<br><br>
				<label for="birth-date">Date of Birth:</label>
				<input type="date" name="birth-date" placeholder="DD-MM-YYYY" id="birth-date" value="<?php echo $date_of_birth; ?>">
				<br>
				<label for="birth-place">Place of Birth:</label>
				<input type="text" name="birth-place" placeholder="Place of Birth" id="birth-place" value="<?php echo $place_of_birth; ?>">
				<br>
				<label for="birth-country">Country of Birth:</label>
				<input type="text" name="birth-country" placeholder="Country of Birth" id="birth-country" value="<?php echo $country_of_birth; ?>">
				<br>
				<label for="nationality">Nationality:</label>
				<input type="text" name="nationality" placeholder="Nationality" id="nationality" value="<?php echo $nationality; ?>">
				<br>
				<label for="position">Position:</label>
				<input type="text" name="position" placeholder="Position" id="position" value="<?php echo $position; ?>">
				<br><br>
				<label for="is-living">Living?</label>
				<input type="checkbox" name="is-living" id="is-living" value="<?php echo $living; ?>">
				<br>
				<label for="death-date">Date of Death:</label>
				<input type="date" name="death-date" placeholder="DD-MM-YYYY" id="death-date" value="<?php echo $date_of_death; ?>">
				<br><br>
				<label for="intro-text">Introductory Text:</label>
				<textarea class="editable-area" rows="5" cols="35" name="intro-text"><?php echo $intro_text; ?></textarea>
				<br><br>
				<label for="biography">Biography:</label>
				<textarea class="editable-area" rows="10" cols="35" name="biography"><?php echo $biography; ?></textarea>
				<br><br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
		</form>		
		
	</div>
	
<?php

	include 'inc/footer.html';
	
?>
