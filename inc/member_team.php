		<h1 class="info-page">
			<img class="banner-icon" src="img/flags/<?php echo strtolower($nationality); ?>
				.png" alt="<?php echo htmlentities($nationality); ?>">
			<?php echo $name.' '.$era; ?>
		</h1>
		
		<div class="team-picture-frame">
			<img class="team-picture" src="img/teams/
			<?php echo htmlentities($file_code); ?>.jpg" alt="<?php echo htmlentities($name); ?>">
			<div class="copyright-info">
				<a class="menu-link" href="<?php echo htmlentities($license_link); ?>">
					<?php echo htmlentities($picture_credit); ?>
				</a>
			</div>
		</div>
		
		<div class="hall-status">
			Elected: 
			<?php 
				if ($admission_poll) {
					echo '<a class="post-link" href="poll.php?id='
						.$admission_poll.'">'
						.date_format($admission_date, "d F Y")
						.'</a>';
					} else {
					echo date_format($admission_date, "d F Y").' (EP)'; 
				}
			?>
			<br>
				
			Rating: <?php echo htmlentities($rating); ?> (<?php echo htmlentities($votes); ?> votes)
			<div class="rating-bar">
				Submit Your Rating: 
				<div class="rating-buttons">
					<?php
						for ($score = 1; $score <= 10; $score++) {
							echo '
							<div class="rating-block">
							<form method="post" action="team.php?id='.$team_id.'">
							<input type="hidden" name="chosen" value="'.$score.'">
							<input class="rating-block" type="submit" name="vote" value="'.$score.'">
							</form>
							</div>
							';
						}
					?>						
				</div>
			</div>
				
		</div>
		
		<div class="biography">
			
			<div class="formatted-text">
				<?php echo html_entity_decode($intro_text); ?>
			</div>
				
			<h2>Key Players</h2>
			
			<?php
					$players = "SELECT 
								people.id AS person_id,
								people.name AS name,
								people.file_code AS person_file,
								people.active AS admitted,
								people.picture_credit AS person_picture,
								people.license_link AS person_license,
								people.position AS position,
								people.nationality AS nationality,
								people_teams.first AS first,
								people_teams.last AS last,
								people_teams.appearances AS appearances,
								people_teams.goals AS goals,
								people_teams.summary AS summary
								FROM people_teams
								INNER JOIN people ON people_teams.person_id = people.id 
								WHERE hall_team_id = '$team_id' 
								ORDER BY file_code";
					$players_query = $connectDB->query($players);
														
					while ($dataRows = $players_query->fetch()) {

						$person_id = $dataRows["person_id"];
						$person = $dataRows["name"];
						$person_file = $dataRows["person_file"];
						$admitted = $dataRows["admitted"];
						$position = $dataRows["position"];
						$nationality = $dataRows["nationality"];
						$first = $dataRows["first"];
						$last = $dataRows["last"];
						$appearances = $dataRows["appearances"];
						$goals = $dataRows["goals"];
						$person_picture = $dataRows["person_picture"];
						$person_license = $dataRows["person_license"];
						$summary = $dataRows["summary"];
						
							echo '<div class="player-details">';
							echo '<div class="small-frame"><img class="small-portrait" src="img/portraits/';
							echo $person_file;
							echo '.jpg" alt="'.$person.'">';
							echo '<div class="copyright-info-small">';
							if ($person_license) {
								echo '<a class="menu-link" href="'.htmlentities($person_license).'">';
							}
							echo htmlentities($person_picture);
							if ($person_license) {
								echo '</a>';
							}
							echo '</div></div>';
						
						echo '<h3 class="inline-heading">';
						if ($admitted) {
							echo '<a class="standard-link" href="person.php?id='.$person_id.'">';
							echo $person;
							echo '</a>';
						} else {
							echo $person;
						}
						echo '</h3>';
						echo $position.', '.$first.'-'.$last.'<br>';
						echo '<strong>Appearances:</strong> '.$appearances.' <strong>Goals:</strong> '.$goals.'<br>';
						echo '<div class="player-summary">'.$summary.'</div>';
						echo '</div>';
							
					}
						
				?>
			
			<div class="formatted-text">				
				<?php echo html_entity_decode($biography); ?>
			</div>
			
		</div>
		
		<div class="tags">
			
			<strong>Tags:</strong><br>
						
		</div>
