		<table class="scoreboard">
			<tr>
				<td><?php echo htmlentities(strtoupper($team_1)); ?></td>
				<td><?php echo htmlentities($score_1); ?></td>
			</tr>
			<tr>
				<td><?php echo htmlentities(strtoupper($team_2)); ?></td>
				<td><?php echo htmlentities($score_2); ?></td>
			</tr>
		</table>
		
		<div class="match-stats">
			
			<div class="score-details">
					<?php
					if ($extra_time) {
						echo 'After Extra-Time';
					}
					if ($penalties) {
						echo ', '.$penalty_winner.' win ';
						if ($penalties_1 > $penalties_2) {
							echo $penalties_1.'-'.$penalties_2;
						} elseif ($penalties_2 > $penalties_1) {
							echo $penalties_2.'-'.$penalties_1;
						}
						echo ' on penalties';
					}
				?>
			</div>
			
			<div class="match-details">
				<?php echo htmlentities($competition).' '.htmlentities($stage).', '.date_format($date, "j F Y"); ?><br>
				<?php echo htmlentities($stadium).', <img class="poll-icon" src="img/flags/'.$country.'.png" alt="'.$country.'"> '.htmlentities($city); ?>
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
								<form method="post" action="match.php?id='.$match_id.'">
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
		
		</div>
		
		<div class="biography">
			
			<div class="formatted-text">
				<?php echo html_entity_decode($intro_text); ?>
			</div>
			
			<div>
				
				<h2>Line-Ups</h2>
				
				<table class="line-ups">
					<thead>
						<tr>
							<th>
								<?php echo html_entity_decode($team_1); ?>
							</th>
							<th>
								<?php echo html_entity_decode($team_2); ?>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="shirt">
								<img class="team-shirt" src="img/kits/teams/<?php echo strtolower($team_1_nat);?>_<?php echo $year;?>/front.png" alt="<?php echo $team_1;?>">
							</td>
							<td class="shirt">
								<img class="team-shirt" src="img/kits/teams/<?php echo strtolower($team_2_nat);?>_<?php echo $year;?>/front.png" alt="<?php echo $team_2;?>">
							</td>
						</tr>
	
						<?php
							$lineups = "SELECT 
										people.name AS name,
										people.nationality AS nationality,
										people_matches.shirt AS shirt,
										people_matches.started AS started,
										people_matches.sub_appeared AS sub_appeared,
										people_matches.captain AS captain
										FROM people_matches
										INNER JOIN people ON people_matches.person_id = people.id 
										WHERE match_id = '$match_id' 
										ORDER BY shirt";
							$lineup_query = $connectDB->query($lineups);
							
							while ($dataRows = $lineup_query->fetch()) {

								$nationality = $dataRows["nationality"];
								$person = $dataRows["name"];
								$shirt = $dataRows["shirt"];
								$started = $dataRows["started"];
								$sub_appeared = $dataRows["sub_appeared"];
								$captain = $dataRows["captain"];
								
								echo '<tr>';
								
									echo '<td>';
									if ($nationality == "FRG") {
										echo $person;
									}
									echo '</td>';
									
									echo '<td>';
									if ($nationality == "HUN") {
										echo $person;
									}
									echo '</td>';
								
								echo '</tr>';
								
							}
						?>
	
					</tbody>
				</table>
				
			</div>
			
			<div class="formatted-text">
				<?php echo html_entity_decode($match_report); ?>
			</div>
			
		</div>
		
		<div class="tags">
			
			<strong>Tags:</strong><br>
						
		</div>
