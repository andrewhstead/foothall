<?php
	$thispage = "Country Index";
	
	require_once 'inc/db.php';

	include 'inc/header.html';
					
	if (isset($_GET["id"])) {
		$person_id = $_GET["id"];
	} else {
		$person_id = 1;
	}
						
	$connectDB;

	if(isset($_POST["vote"])) {
		
		$chosen_score = $_POST["chosen"];		
		$sql = "UPDATE people 
			SET score = score + $chosen_score, votes = votes + 1, rating = score / votes
			WHERE id = $person_id";
		$stmt = $connectDB->prepare($sql);
		$execute = $stmt->execute();
		
		header("Location:person.php?id=$person_id");
					
	}
	
	$person = "SELECT * FROM people WHERE id = '$person_id'";
	$person_query = $connectDB->query($person);
	
	while ($dataRows = $person_query->fetch()) {

		$name = $dataRows["name"];
		$file_code = $dataRows["file_code"];
		$nationality = $dataRows["nationality"];
		$admitted = $dataRows["admitted"];
		$admission_date = new DateTime($dataRows["admission_date"]);
		$admission_poll = $dataRows["admission_poll"];
		$votes = $dataRows["votes"];
		$rating = $dataRows["rating"];
		$full_name = $dataRows["full_name"];
		$date_of_birth = new DateTime($dataRows["date_of_birth"]);
		$place_of_birth = $dataRows["place_of_birth"];
		$country_of_birth = $dataRows["country_of_birth"];
		$living = $dataRows["living"];
		$date_of_death = new DateTime($dataRows["date_of_death"]);
		$position = $dataRows["position"];
		$intro_text = $dataRows["intro_text"];
		$picture_credit = $dataRows["picture_credit"];
		$biography = $dataRows["biography"];
		
		$country = "SELECT * FROM countries WHERE abbreviation = '$nationality'";
		$country_query = $connectDB->query($country);
		
		while ($dataRows = $country_query->fetch()) {

			$country_name = $dataRows["display_name"];
			
		}
		
	}
	
	$tags = "
		SELECT 
			people_tags.person_id AS person_id,
			people_tags.tag_id AS tag_id,
			tags.name AS tag_name
		FROM people_tags 
		INNER JOIN tags on people_tags.tag_id = tags.id
		WHERE person_id = '$person_id'";
	$tag_query = $connectDB->query($tags);
	
	$tag_list = array();
	
	while ($dataRows = $tag_query->fetch()) {

		$tag_name = $dataRows["tag_name"];
		
		$tag_list[] = $tag_name;
		
	}
		
?>

	<div class="page-template">
		
		<?php

			if ($admitted) {
				
				include 'inc/member_person.php';
			
			} else {
				
				echo '<h1>Sorry<br>Page Does Not Exist</h1>';
			
			}
				
		?>
		
	</div>
	
<?php

	include 'inc/footer.html';
	
?>
