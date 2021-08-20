<?php
	$thispage = "Country Profile";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
					
	if (isset($_GET["id"])) {
		$country_id = $_GET["id"];
	} else {
		$country_id = 1;
	}
						
	$connectDB;

	$country = "SELECT * FROM countries WHERE id = '$country_id'";
	$country_query = $connectDB->query($country);
	
	while ($dataRows = $country_query->fetch()) {

		$active = $dataRows["active"];
		$display_name = $dataRows["display_name"];
		$abbreviation = $dataRows["abbreviation"];
		$successor_to = $dataRows["successor_to"];
		$continent = $dataRows["continent"];
		$defunct = $dataRows["defunct"];
		$profile = $dataRows["profile"];
		
	}

	if ($successor_to) {
		
		$successor = "SELECT * FROM countries WHERE abbreviation = '$successor_to'";
		$successor_query = $connectDB->query($successor);
		
		while ($dataRows = $successor_query->fetch()) {

			$includes = $dataRows["display_name"];
			
		}
		
	} else {
	
		$includes = 'none';
		
	}
	
?>

	<div class="page-template">

		<?php
		
			if ($active) {
				
				include 'inc/country_profile.php';
			
			} else {
				
				echo '<h1>Sorry<br>Page Does Not Exist</h1>';
			
			}
			
		?>		
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
