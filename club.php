<?php
	$thispage = "Club Profile";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
					
	if (isset($_GET["id"])) {
		$club_id = $_GET["id"];
	} else {
		$club_id = 1;
	}
						
	$connectDB;

	$club = "SELECT teams.active AS active, teams.display_name AS club_name, teams.country as nationality, countries.display_name as country, countries.id AS country_id FROM teams INNER JOIN countries on teams.country = countries.abbreviation WHERE teams.id = $club_id ";
	$club_query = $connectDB->query($club);
	
	while ($dataRows = $club_query->fetch()) {

		$active = $dataRows["active"];
		$display_name = $dataRows["club_name"];
		$nationality = $dataRows["nationality"];
		$country = $dataRows["country"];
		$country_id = $dataRows["country_id"];
		
	}
	
?>

	<div class="page-template">

		<?php
		
			if ($active) {
				
				include 'inc/club_profile.php';
			
			} else {
				
				echo '<h1>Sorry<br>Page Does Not Exist</h1>';
			
			}
			
		?>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
