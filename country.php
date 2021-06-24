<?php
	$thispage = "Country Profile";
	
	require_once 'inc/db.php';

	include 'inc/header.html';
					
	if (isset($_GET["id"])) {
		$country_id = $_GET["id"];
	} else {
		$country_id = 1;
	}
						
	$connectDB;

	$country = "SELECT * FROM countries WHERE id = '$country_id'";
	$country_query = $connectDB->query($country);
	
	while ($dataRows = $country_query->fetch()) {

		$display_name = $dataRows["display_name"];
		$abbreviation = $dataRows["abbreviation"];
		$continent = $dataRows["continent"];
		
	}
	
?>

	<div class="page-template">
		
		<h1 class="info-page">
			<img class="header-icon" src="img/flags/<?php echo strtolower($abbreviation); ?>
				.png" alt="<?php echo htmlentities($display_name); ?>">
			<?php echo htmlentities($display_name); ?>
		</h1>
		<strong>Continent:</strong> <?php echo htmlentities($continent); ?>
	
		<?php

			$members = "SELECT 
				people.id as person_id,
				people.name as name,
				people.nationality as nationality,
				countries.id 
				FROM people
				INNER JOIN countries ON people.nationality = countries.abbreviation
				WHERE countries.id = $country_id 
				AND people.admitted = true";
				
			$member_check = $connectDB->query($members);
			
			$has_members = $member_check->fetch();
			
			if ($has_members) {
				
				echo '<h2 class="info-page">FootHall Members</h2>';
			
			}
			
			$member_query = $connectDB->query($members);
			
			while ($dataRows = $member_query->fetch()) {

				$display_name = $dataRows["name"];
				$person_id = $dataRows["person_id"];
				
				echo '<a class="standard-link" href="person.php?id='.$person_id.'">';
				echo $display_name;
				echo '</a>';
				
			}
			
		?>
		
	</div>
	
<?php

	include 'inc/footer.html';
	
?>
