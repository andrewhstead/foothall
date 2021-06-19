<?php
	$thispage = "Country Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.html';
					
	if (isset($_GET["id"])) {
		$country_id = $_GET["id"];
	} else {
		$country_id = 1;
	}
						
	$connectDB;

	$continents = "SELECT * FROM continents";
	$continent_query = $connectDB->query($continents);
	
	$continent_list = array();
	
	while ($dataRows = $continent_query->fetch()) {

		$continent_id = $dataRows["id"];
		$continent_name = $dataRows["name"];
		
		$continent_list[] = $continent_name;
	
	}
	
	$countries = "SELECT * FROM countries";
	$country_query = $connectDB->query($countries);
	
	$country_list = array();
	
	while ($dataRows = $country_query->fetch()) {

		$country_id = $dataRows["id"];
		$country_name = $dataRows["display_name"];
		$country_abbreviation = $dataRows["abbreviation"];
		$country_continent = $dataRows["continent"];
		
		$country_list[] = $dataRows;
	
	}
?>

	<div class="page-template">
		
		<h1>
			Countries
		</h1>
		
		<?php
		
			foreach ($continent_list as &$continent_menu) {
				
				echo '<h2>'.$continent_menu.'</h2>';
		
				foreach ($country_list as &$country_menu) {
					
					if ($country_menu["continent"] == $continent_menu) {
							
						echo '<img class="poll-icon" src="img/flags/'.strtolower($country_menu["abbreviation"]).'.png" alt="'.htmlentities($country_menu["abbreviation"]).'"> ';
						echo $country_menu["display_name"];
						echo '<br>';
							
					}
					
				}
				
			}
		
		?>
		
		<?php
			
		?>
		
	</div>

	
<?php

	include 'inc/footer.html';
	
?>
