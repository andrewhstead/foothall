
		
		<h1 class="info-page">
			<img class="header-icon" src="img/flags/<?php echo strtolower($abbreviation); ?>
				.png" alt="<?php echo htmlentities($display_name); ?>">
			<?php echo htmlentities($display_name); ?>
		</h1>
		
		<?php
		
			if ($successor_to) {
				
				echo '<strong>Includes:</strong> '.$includes.'<br>';
				
			}
			
		?>
		
		<strong>Continent:</strong> 
		<?php 
			echo htmlentities($continent);
			
			if ($defunct) {
				echo ' <em>(Defunct)</em>';
			}

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

				$person_name = $dataRows["name"];
				$person_id = $dataRows["person_id"];
				
				echo '&#9654; <a class="standard-link" href="person.php?id='.$person_id.'">';
				echo $person_name;
				echo '</a>';
				
			}
						
			/* Checking for Hall matches and then displaying them. */
			$matches = "SELECT 
				matches.id as match_id,
				matches.title as match_title
				FROM matches
				INNER JOIN teams team_1 ON team_1.name = matches.team_1
				INNER JOIN teams team_2 ON team_2.name = matches.team_2
				WHERE team_1.display_name = '$display_name'
					OR team_2.display_name = '$display_name'
					OR team_1.display_name = '$includes'
					OR team_2.display_name = '$includes'";
				
			$match_check = $connectDB->query($matches);
			
			$has_matches = $match_check->fetch();
			
			if ($has_matches) {
				
				echo '<h2 class="info-page">FootHall Matches</h2>';
			
			}
			
			$match_query = $connectDB->query($matches);
			
			while ($dataRows = $match_query->fetch()) {

				$match_id = $dataRows["match_id"];
				$match_title = $dataRows["match_title"];
				
				echo '&#9654; <a class="standard-link" href="match.php?id='.$match_id.'">';
				echo $match_title;
				echo '</a><br>';
				
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
				WHERE winner = '$abbreviation' OR runner_up = '$abbreviation' OR winner = '$successor_to' OR runner_up = '$successor_to'";
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
						
					echo '<div><strong>'.$honour_list.'</strong></div>';
					
					foreach ($honours_won as $honour) {
						
						if (($honour["tournament_name"] == $honour_list) && ($honour["tournament_winner"] ==$abbreviation )) {
							
							echo '<span class="honour-details">';
							echo '<img class="medal" alt="Gold Medal" src="img/awards/gold_world.png"> ';
							echo $honour["tournament_year"];
							echo '</span>';
									
						} elseif (($honour["tournament_name"] == $honour_list) && ($honour["tournament_runner_up"] == $abbreviation )) {
								
							echo '<span class="honour-details">';
							echo '<img class="medal" alt="Silver Medal" src="img/awards/silver_world.png"> ';
							echo $honour["tournament_year"];
							echo '</span>';
									
						} elseif (($honour["tournament_name"] == $honour_list) && ($honour["tournament_winner"] ==$successor_to )) {
							
							echo '<span class="honour-details">';
							echo '<img class="medal" alt="Gold Medal" src="img/awards/gold_world.png"> ';
							echo $honour["tournament_year"];
							echo '</span>';
									
						} elseif (($honour["tournament_name"] == $honour_list) && ($honour["tournament_runner_up"] == $successor_to )) {
								
							echo '<span class="honour-details">';
							echo '<img class="medal" alt="Silver Medal" src="img/awards/silver_world.png"> ';
							echo $honour["tournament_year"];
							echo '</span>';
									
						}
						
					}
						
				}
				
				echo '</span>';
			
			}
			
		?>