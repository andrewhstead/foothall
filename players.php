<?php
	$thispage = "Player Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.html';
					
	if (isset($_GET["id"])) {
		$person_id = $_GET["id"];
	} else {
		$person_id = 1;
	}
						
	$connectDB;

	$countries = "SELECT * FROM countries";
	$country_query = $connectDB->query($countries);
	
	
	while ($dataRows = $country_query->fetch()) {

		$country_id = $dataRows["id"];
		$country_name = $dataRows["display_name"];
		$country_abbreviation = $dataRows["abbreviation"];
			
	}
	
	$players = "SELECT * FROM people WHERE admitted = true AND as_player = true ORDER BY file_code";
	$player_query = $connectDB->query($players);
	
	$player_list = array();
	$country_list = array();
	
	while ($dataRows = $player_query->fetch()) {

		$player_id = $dataRows["id"];
		$player_name = $dataRows["full_name"];
		$nationality = $dataRows["nationality"];
		
		$player_list[] = $dataRows;
		
		if (in_array($dataRows["nationality"], $country_list)) {
			
		} else {
			$country_list[] = $dataRows["nationality"];
		}

	}
?>

	<div class="page-template">
		
		<h1>
			FootHall Players
		</h1>
		
		<?php
		
			foreach ($country_list as &$country_menu) {
				
				echo '<h2 class="sub-menu">'.$country_menu.'</h2>';
				
				echo '<div class="flex-wrapper">';
		
				foreach ($player_list as &$player_menu) {
					
					if ($player_menu["nationality"] == $country_menu) {
						
						echo '<div class="flex-item">';	
						echo '<a class="standard-link" href="person.php?id='.$player_menu["id"].'">'.$player_menu["name"].'</a>';
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
