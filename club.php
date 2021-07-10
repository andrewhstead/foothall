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

	$club = "SELECT clubs.on_site AS on_site, clubs.display_name AS club_name, clubs.country as nationality, countries.display_name as country, countries.id AS country_id FROM clubs INNER JOIN countries on clubs.country = countries.abbreviation WHERE clubs.id = $club_id ";
	$club_query = $connectDB->query($club);
	
	while ($dataRows = $club_query->fetch()) {

		$on_site = $dataRows["on_site"];
		$display_name = $dataRows["club_name"];
		$nationality = $dataRows["nationality"];
		$country = $dataRows["country"];
		$country_id = $dataRows["country_id"];
		
	}
	
?>

	<div class="page-template">
		
		<h1 class="info-page">
			<img class="header-icon" src="img/flags/<?php echo strtolower($nationality); ?>
				.png" alt="<?php echo htmlentities($display_name); ?>">
			<?php echo htmlentities($display_name); ?>
		</h1>
		<strong>Country:</strong> <a class="standard-link" href="country.php?id=<?php echo htmlentities($country_id); ?>"><?php echo htmlentities($country); ?></a>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
