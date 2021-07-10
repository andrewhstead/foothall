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

			/* Checking for Hall members and then displaying them. */
			$members = "SELECT 
				people.id as person_id,
				people.name as name,
				people.nationality as nationality,
				countries.id 
				FROM people
				INNER JOIN countries ON people.nationality = countries.abbreviation
				WHERE countries.id = $country_id 
				AND people.active = true";
				
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
			
			/* Checking for international tournament honours and displaying them. */
			
			$honours = "SELECT 
				tournaments.id AS tournament_id,
				tournaments.year AS tournament_year,
				competitions.name AS tournament_name,
				tournaments.winner AS tournament_winner,
				tournaments.runner_up AS tournament_runner_up
				FROM tournaments 
				INNER JOIN competitions ON tournaments.competition = competitions.id
				WHERE winner = '$abbreviation' OR runner_up = '$abbreviation'";
			$honour_check = $connectDB->query($honours);
			
			$has_honours = $honour_check->fetch();
			
			if ($has_honours) {
				
				echo '<div class="competition-honours">';
				
				echo '<h2 class="info-page">International Honours</h2>';
			
				$honour_query = $connectDB->query($honours);
				$honour_competition = array();
				$honours_won = array();
				
				while ($dataRows = $honour_query->fetch()) {

					$tournament_id = $dataRows["tournament_id"];
					$tournament_year = $dataRows["tournament_year"];
					$tournament_name = $dataRows["tournament_name"];
					$tournament_winner = $dataRows["tournament_winner"];
					$tournament_runner_up = $dataRows["tournament_runner_up"];
					
					if (!in_array($tournament_name, $honour_competition)) {
						$honour_competition[] = $tournament_name;
					}
					
					$honours_won[] = $dataRows;
					
				}
					
				foreach ($honour_competition as $honour_list) {
						
					echo '<strong>'.$honour_list.'</strong><br>';
					
					foreach ($honours_won as $honour) {
						
						echo '<span class="honour-details">';
						
						if (($honour["tournament_name"] == $honour_list) && ($honour["tournament_winner"] ==$abbreviation )) {
							
							echo '<img class="medal" alt="Gold Medal" src="img/awards/gold_world.png"> ';
							echo $honour["tournament_year"];
									
						} elseif (($honour["tournament_name"] == $honour_list) && ($honour["tournament_runner_up"] ==$abbreviation )) {
								
							echo '<img class="medal" alt="Silver Medal" src="img/awards/silver_world.png"> ';
							echo $honour["tournament_year"];
									
						}
						
						echo '</span>';
						
					}
						
				}
				
				echo '</span>';
			
			}
			
		?>
		
	</div>
	
<?php

	include 'inc/footer.html';
	
?>
