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
				<?php
					
					if (!isset($_COOKIE[$cookie_name])) {
						echo 'Submit Your Rating: <div class="rating-buttons">';
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
						echo '</div>';
					} else {
						$your_rating = $_COOKIE["team_".$team_id];
						echo 'Your Rating: <span class="chosen-rating-block">'.$your_rating.'</span>';
					} 
					
				?>
			</div>
				
		</div>
		
		<div class="biography">
			
			<div class="formatted-text">
				<?php echo html_entity_decode($intro_text); ?>
			</div>
			
			<div>				
				<?php echo html_entity_decode($biography); ?>
			</div>
				
			<h2>Key Players</h2>
			
				<div class="flex-wrapper">
			
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
								INNER JOIN people ON people_teams.person = people.name 
								WHERE hall_team = '$title' 
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
				
			</div>
				
			<h2>Key Matches</h2>
			
				<div class="flex-wrapper">
			
				<?php
					$matches = "SELECT 
								teams_matches.hall_team AS hall_team,
								matches.date AS date,
								matches.competition AS competition,
								matches.stage AS stage,
								team_1.country AS team_1_nat,
								team_1.display_name AS team_1_name,
								matches.score_1 AS score_1,
								matches.score_2 AS score_2,
								team_2.display_name AS team_2_name,
								team_2.country AS team_2_nat,
								matches.id AS match_id,
								teams_matches.team_text AS team_text,
								matches.active AS admitted
								FROM teams_matches
								INNER JOIN hall_teams ON teams_matches.hall_team = hall_teams.title
								INNER JOIN matches ON teams_matches.match_id = matches.id 
								INNER JOIN teams team_1 ON matches.team_1 = team_1.name 
								INNER JOIN teams team_2 ON matches.team_2 = team_2.name 
								WHERE hall_team = '$title' 
								ORDER BY date";
					$matches_query = $connectDB->query($matches);
														
					while ($dataRows = $matches_query->fetch()) {

						$date = new DateTime($dataRows["date"]);
						$team_1_nat = $dataRows["team_1_nat"];
						$team_1 = $dataRows["team_1_name"];
						$score_1 = $dataRows["score_1"];
						$team_2 = $dataRows["team_2_name"];
						$score_2 = $dataRows["score_2"];
						$team_2_nat = $dataRows["team_2_nat"];
						$competition = $dataRows["competition"];
						$stage = $dataRows["stage"];
						$admitted = $dataRows["admitted"];
						$team_text = $dataRows["team_text"];
						$match_id = $dataRows["match_id"];
						
						echo '<div class="team-match-details">';
						
						echo '<h3 class="inline-heading">';
						echo '<img class="table-icon" src="img/flags/'.$team_1_nat.'.png" alt="'.$team_1_nat.'"> ';
						if ($admitted) {
							echo '<a class="standard-link" href="match.php?id='.$match_id.'">';
							echo $team_1.' '.$score_1.'-'.$score_2.' '.$team_2;
							echo '</a>';
						} else {
							echo $team_1.' '.$score_1.'-'.$score_2.' '.$team_2;
						}
						echo ' <img class="table-icon" src="img/flags/'.$team_2_nat.'.png" alt="'.$team_2_nat.'">';
						echo '</h3>';
						echo '<strong>'.$competition.' '.$stage.'</strong><br>';
						echo date_format($date, "j F Y").'<br>';
						echo '<div class="team-text">'.$team_text.'</div>';
						
						echo '</div>';
							
					}
						
				?>
				
			</div>
			
		</div>
		
		<div class="tags">
			
			<strong>Tags:</strong>
			
			<?php 
	
				$tags = " 
					SELECT 
					hall_teams.id AS database_id, 
					hall_teams.era AS era, 
					hall_teams.team_type AS team_type, 
					teams.name AS team_name, 
					teams.display_name AS display_name
					FROM hall_teams 
					INNER JOIN teams ON hall_teams.team_name = teams.name
					WHERE hall_teams.id = '$team_id'";
				$tag_query = $connectDB->query($tags);
								
				while ($dataRows = $tag_query->fetch()) {

					$database_id = $dataRows["database_id"];
					$team_tag = $dataRows["display_name"];
					$team_type = $dataRows["team_type"];
					
					if ($team_type == 'national') {
						
						echo '<a class="tag-link" href="country.php?id='.$database_id.'"><div class="tag">'.htmlentities($team_tag).'</div></a>';
						
					} elseif ($match_type == 'club') {
						
						echo '<a class="tag-link" href="club.php?id='.$database_id.'"><div class="tag">'.htmlentities($team_tag).'</div></a>';
						
					}
						
				}
				
			?>
						
		</div>
