<?php
	$thispage = "Player Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
			
	$connectDB;

	
	$players = "
		SELECT 
			people.id AS player_id,
			people.name AS player_name,
			people.nationality AS nationality,
			countries.display_name AS country 
		FROM people 
		INNER JOIN countries ON people.nationality = countries.abbreviation
		WHERE people.active = true AND as_player = true  
		ORDER BY nationality, file_code";
	$player_query = $connectDB->query($players);
	
	$player_list = array();
	$country_list = array();
	
	while ($dataRows = $player_query->fetch()) {

		$player_id = $dataRows["player_id"];
		$player_name = $dataRows["player_name"];
		$nationality = $dataRows["nationality"];
		$abbreviation = $dataRows["country"];
		
		$player_list[] = $dataRows;
		
		if (!in_array($nationality, $country_list)) {
			$country_list[] = $nationality;
		}

	}
	
	$countries = "SELECT * FROM countries";
	$country_query = $connectDB->query($countries);
	
	$countries = array();
	
	while ($dataRows = $country_query->fetch()) {

		$country_id = $dataRows["id"];
		$country_name = $dataRows["display_name"];
		$country_abbreviation = $dataRows["abbreviation"];
			
		if (in_array($country_abbreviation, $country_list)) {
			$countries[] = $dataRows;
		}
		
	}
	
?>

	<div class="page-template">
		
		<h1>
			FootHall Players
		</h1>
		
		<div class="flex-wrapper">
		
			<?php
			
				if (!$player_list) {
					echo "<h2>No players have yet been elected to The FootHall.</h2>";
				}
						
				foreach ($countries as $country_menu) {
					
					echo '<div class="sub-menu">';
					echo '<h2>';
					echo '<img class="feed-icon" src="img/flags/'.strtolower($country_menu["abbreviation"]).'.png" alt="'.htmlentities($country_menu["display_name"]).'"> ';
					echo $country_menu["display_name"].'</h2>';
								
						foreach ($player_list as $player_menu) {
									
							if ($player_menu["nationality"] == $country_menu["abbreviation"]) {
									
								echo '&#9654; <a class="standard-link" href="person.php?id='.$player_menu["player_id"].'">'.$player_menu["player_name"].'</a>';
								echo '<br>';
							
							}
								
						}
							
					echo '</div>';
				
				}
				
			?>
		
		</div>
		
	</div>

	
<?php

	include 'inc/footer.php';
	
?>
