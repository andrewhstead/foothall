
		<h1 class="info-page">
			<img class="header-icon" src="img/flags/<?php echo strtolower($nationality); ?>
				.png" alt="<?php echo htmlentities($display_name); ?>">
			<?php echo htmlentities($display_name); ?>
		</h1>
		<strong>Country:</strong> <a class="standard-link" href="country.php?id=<?php echo htmlentities($country_id); ?>"><?php echo htmlentities($country); ?></a>
		
		<?php
		
			/* Checking for Hall matches and then displaying them. */
			$matches = "SELECT 
				matches.id as match_id,
				matches.title as match_title
				FROM matches
				INNER JOIN teams team_1 ON team_1.name = matches.team_1
				INNER JOIN teams team_2 ON team_2.name = matches.team_2
				WHERE team_1.display_name = '$display_name'
					OR team_2.display_name = '$display_name'";
				
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
			
		?>
