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

	$person = "SELECT * FROM people WHERE id = '$person_id'";
	$person_query = $connectDB->query($person);
	
	while ($dataRows = $person_query->fetch()) {

		$name = $dataRows["name"];
		$nationality = $dataRows["nationality"];
		$admission_date = $dataRows["admission_date"];
		$full_name = $dataRows["full_name"];
		$date_of_birth = $dataRows["date_of_birth"];
		$place_of_birth = $dataRows["place_of_birth"];
		$living = $dataRows["living"];
		$date_of_death = $dataRows["date_of_death"];
		$position = $dataRows["position"];
		$intro_text = $dataRows["intro_text"];
		$biography = $dataRows["biography"];
		
	}
	
?>

	<div class="page-template">
		
		<h1 class="info-page">
			<img class="header-icon" src="img/flags/<?php echo strtolower($nationality); ?>
				.png" alt="<?php echo htmlentities($nationality); ?>">
			<?php echo htmlentities($name); ?> 
			(<?php echo htmlentities($nationality); ?>)
		</h1>
		
			
		
	</div>
	
<?php

	include 'inc/footer.html';
	
?>
