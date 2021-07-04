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
		
	}
		
?>

	<div class="page-template">
	
		<h1>
			Edit Person
		</h1>		
	
		<h2>
			<?php echo htmlentities($name); ?>
		</h2>		
		
	</div>
	
<?php

	include 'inc/footer.html';
	
?>
