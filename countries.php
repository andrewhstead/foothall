<?php
	$thispage = "Country Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.html';
						
	$connectDB;

	$continents = "SELECT * FROM continents";
	$continent_query = $connectDB->query($continents);
	
	$continent_list = array();
	
	while ($dataRows = $continent_query->fetch()) {

		$continent_id = $dataRows["id"];
		$continent_name = $dataRows["name"];
		
		$continent_list[] = $continent_name;
	
	}
	
	$countries = "SELECT * FROM countries WHERE defunct = false AND affiliated = true ORDER BY display_name";
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
		
			foreach ($continent_list as $continent_menu) {
				
				echo '<h2>'.$continent_menu.'</h2>';
				
				echo '<div class="flex-wrapper">';
		
				foreach ($country_list as $country_menu) {
					
					if ($country_menu["continent"] == $continent_menu) {
						
						echo '<div class="flex-item">';	
						echo '<img class="poll-icon" src="img/flags/'.strtolower($country_menu["abbreviation"]).'.png" alt="'.htmlentities($country_menu["abbreviation"]).'"> ';
						echo '<a class="standard-link" href="country.php?id='.$country_menu["id"].'">'.$country_menu["display_name"].'</a>';
						echo '</div>';
							
					}
					
				}
				
				echo '</div>';
				
			}
			
		?>
		
	</div>

	
<?php

	include 'inc/footer.html';
	
?>
