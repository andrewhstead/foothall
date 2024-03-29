		<h1 class="info-page">
			<?php echo htmlentities($name); ?> 
		</h1>
		<div class="sub-heading">
			<img class="text-icon" src="img/flags/<?php echo strtolower($nationality); ?>
				.png" alt="<?php echo htmlentities($nationality); ?>">
			<a class="standard-link" href="country.php?id=<?php echo htmlentities($country_id); ?>">
				<?php echo htmlentities($country_name); ?>
			</a>
		</div>
		
		<div class="person-stats">
			
			<div class="personal-details">
			
				<div class="portrait-frame">
					<img class="portrait" src="img/portraits/
					<?php echo htmlentities($file_code); ?>.jpg" alt="<?php echo htmlentities($name); ?>">
					<div class="copyright-info">
						<?php
							if ($license_link) {
								echo '<a class="menu-link" href="'.htmlentities($license_link).'">';
							}
							echo htmlentities($picture_credit);
							if ($license_link) {
								echo '</a>';
							}
						?>
					</div>
				</div>
				<strong>Date of Birth:</strong> <?php echo date_format($date_of_birth, "d/m/Y"); ?><br>
				<strong>Place of Birth:</strong> <?php echo htmlentities($place_of_birth).', '.htmlentities($country_of_birth); ?><br>
				<?php
					if (!$living) {	
						echo '<strong>Date of Death:</strong> '.date_format($date_of_death, "d/m/Y").'<br>';
					}
				?>
				<strong>Position:</strong> <?php echo htmlentities($position); ?><br>
				
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
								<form method="post" action="person.php?id='.$person_id.'">
								<input type="hidden" name="chosen" value="'.$score.'">
								<input class="rating-block" type="submit" name="vote" value="'.$score.'">
								</form>
								</div>
								';
							}
							echo '</div>';
						} else {
							$your_rating = $_COOKIE["person_".$person_id];
							echo 'Your Rating: <span class="chosen-rating-block">'.$your_rating.'</span>';
						} 
						
					?>
				</div>
				
			</div>
		
		</div>
		
		<div class="biography">
			
			<div class="formatted-text">
				<?php echo html_entity_decode($intro_text); ?>
			</div>
			
			<div class="formatted-text">
				<?php echo html_entity_decode($biography); ?>
			</div>
			
		</div>
		
		<div class="tags">
			
			<strong>Tags:</strong>
			
			<?php 
				
				echo '<a class="tag-link" href="country.php?id='.$country_id.'"><div class="tag">'.htmlentities($country_name).'</div></a>';
	
				$tags = "
					SELECT 
						people_positions.position AS position_name, 
						people_positions.person AS position_person, 
						people_positions.type AS tag_type, 
						positions.id AS position_id
					FROM people_positions
					INNER JOIN positions 
						ON positions.name = people_positions.position
					WHERE people_positions.person = '$name'
					UNION ALL 
					SELECT 
						people_matches.match_code AS match_code, 
						people_matches.person AS match_person, 
						people_matches.type AS tag_type, 
						matches.id AS match_id
					FROM people_matches
					INNER JOIN matches 
						ON matches.file_code = people_matches.match_code
					WHERE people_matches.person = '$name'
					UNION ALL 
					SELECT 
						people_teams.hall_team AS hall_team, 
						people_teams.person AS team_person, 
						people_teams.type AS tag_type,
						hall_teams.id AS team_id
					FROM people_teams
					INNER JOIN hall_teams 
						ON hall_teams.title = people_teams.hall_team
					WHERE people_teams.person = '$name'
					UNION ALL 
					SELECT 
						people_dream.dream_team AS dream_team, 
						people_dream.person AS dream_person, 
						people_dream.type AS tag_type,
						dream_teams.id AS dream_id
					FROM people_dream
					INNER JOIN dream_teams 
						ON dream_teams.name = people_dream.dream_team
					WHERE people_dream.person = '$name'
					";
				$tag_query = $connectDB->query($tags);
								
				while ($dataRows = $tag_query->fetch()) {

					if ($dataRows["position_name"]) {
						$tag_type = $dataRows["tag_type"];
						$tag_name = $dataRows["position_name"];
						$tag_id = $dataRows["position_id"];
					} elseif ($dataRows["match_title"]) {
						$tag_type = $dataRows["tag_type"];
						$tag_name = $dataRows["match_title"];
						$tag_id = $dataRows["match_id"];
					} elseif ($dataRows["hall_team"]) {
						$tag_type = $dataRows["tag_type"];
						$tag_name = $dataRows["hall_team"];
						$tag_id = $dataRows["team_id"];
					} elseif ($dataRows["dream_team"]) {
						$tag_type = $dataRows["tag_type"];
						$tag_name = $dataRows["dream_team"];
						$tag_id = $dataRows["dream_id"];
					}
						
					echo '<a class="tag-link" href="'.str_replace('person_','',$tag_type).'.php?id='.$tag_id.'"><div class="tag">'.htmlentities($tag_name);
					if ($tag_type == "person_dream_team") {
						echo ' Dream Team';
					}
					echo '</div></a>';
					
				}
				
			?>
						
		</div>
