<?php
	$thispage = "Club Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.html';
						
	$connectDB;

	$clubs = "SELECT * FROM clubs WHERE type = "club" AND on_site = true ORDER BY display_name";
	$club_query = $connectDB->query($clubs);
	
	$country_list = array();
	$club_list = array();
	
	while ($dataRows = $club_query->fetch()) {

		$club_id = $dataRows["id"];
		$club_name = $dataRows["display_name"];
		$club_country = $dataRows["country"];
		
		$club_list[] = $dataRows;
	
		if (!in_array($club_country, $country_list)) {
			$country_list[] = $club_country;
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
			Clubs
		</h1>
		
		<?php
		
			if (!$club_list) {
				echo "<h2>Club profiles will appear here when added to the site.</h2>";
			}
					
			foreach ($countries as $country_menu) {
				
				echo '<div class="sub-menu">';
				echo '<h2>';
				echo '<img class="feed-icon" src="img/flags/'.strtolower($country_menu["abbreviation"]).'.png" alt="'.htmlentities($country_menu["display_name"]).'"> ';
				echo $country_menu["display_name"].'</h2>';
							
				echo '<div class="flex-wrapper">';
			
					foreach ($club_list as $club_menu) {
							
						if ($club_menu["country"] == $country_menu["abbreviation"]) {
							
							echo '<div class="flex-item">';	
							echo '&#9654; <a class="standard-link" href="club.php?id='.$club_menu["id"].'">'.$club_menu["display_name"].'</a>';
							echo '</div>';
							
						}
						
					}
					
				echo '</div>';
				echo '</div>';
			
			}
			
		?>
		
	</div>

	
<?php

	include 'inc/footer.html';
	
?>
