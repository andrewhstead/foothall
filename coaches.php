<?php
	$thispage = "Coach Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
				
	$connectDB;

	$coaches = "
		SELECT 
			people.id AS coach_id,
			people.name AS coach_name,
			people.nationality AS nationality,
			countries.display_name AS country 
		FROM people 
		INNER JOIN countries ON people.nationality = countries.abbreviation
		WHERE active = true AND as_coach = true  
		ORDER BY nationality, file_code";
	$coach_query = $connectDB->query($coaches);
	
	$coach_list = array();
	$country_list = array();
	
	while ($dataRows = $coach_query->fetch()) {

		$coach_id = $dataRows["coach_id"];
		$coach_name = $dataRows["coach_name"];
		$nationality = $dataRows["nationality"];
		$abbreviation = $dataRows["country"];
		
		$coach_list[] = $dataRows;
		
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
			FootHall Coaches
		</h1>
		
		<?php
		
			if (!$coach_list) {
				echo "<h2>Coaches elected to The FootHall will appear here.</h2>";
			}
					
			foreach ($countries as $country_menu) {
				
				echo '<div class="sub-menu">';
				echo '<h2>';
				echo '<img class="feed-icon" src="img/flags/'.strtolower($country_menu["abbreviation"]).'.png" alt="'.htmlentities($country_menu["display_name"]).'"> ';
				echo $country_menu["display_name"].'</h2>';
							
				echo '<div class="flex-wrapper">';
			
					foreach ($coach_list as $coach_menu) {
							
						if ($coach_menu["nationality"] == $country_menu["abbreviation"]) {
							
							echo '<div class="flex-item">';	
							echo '&#9654; <a class="standard-link" href="person.php?id='.$coach_menu["coach_id"].'">'.$coach_menu["coach_name"].'</a>';
							echo '</div>';
							
						}
						
					}
					
				echo '</div>';
				echo '</div>';
			
			}
			
		?>
		
	</div>

	
<?php

	include 'inc/footer.php';
	
?>
