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
				<?php echo htmlentities($stadium).', <img class="table-icon" src="img/flags/'.$country.'.png" alt="'.$country.'"> '.htmlentities($city); ?>
				<br>
				Attendance: <?php echo number_format($attendance); ?>
				<br>
				Referee: <?php echo '<img class="table-icon" src="img/flags/'.$ref_nat.'.png" alt="'.$ref_nat.'"> '.$referee; ?>
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
	
				<?php
					$lineups = "SELECT 
								people.active AS hall_member,
								people.name AS name,
								people.nationality AS nationality,
								people_matches.shirt AS shirt,
								people_matches.team AS team,
								people_matches.started AS started,
								people_matches.sub_appeared AS sub_appeared,
								people_matches.captain AS captain
								FROM people_matches
								INNER JOIN people ON people_matches.person = people.name
								WHERE match_title = '$title' 
								ORDER BY goalkeeper desc, shirt";
					$lineup_query = $connectDB->query($lineups);
							
					$team_1_lineup = array();
					$team_2_lineup = array();
					$team_1_subs = array();
					$team_2_subs = array();
														
					while ($dataRows = $lineup_query->fetch()) {

						$nationality = $dataRows["nationality"];
						$hall_member = $dataRows["hall_member"];
						$person = $dataRows["name"];
						$shirt = $dataRows["shirt"];
						$team = $dataRows["team"];
						$started = $dataRows["started"];
						$sub_appeared = $dataRows["sub_appeared"];
						$captain = $dataRows["captain"];
						
						if ($team == $team_1_abb) {
							if ($started == true) {
								$team_1_lineup[$shirt] = $person;
							} else {
								$team_1_subs[$shirt] = $person;
							}
						} elseif ($team == $team_2_abb) {
							if ($started == true) {
								$team_2_lineup[$shirt] = $person;
							} else {
								$team_2_subs[$shirt] = $person;
							}
						}
							
					}
										
				?>
				
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
							<td class="team-shirt">
								<img src="img/kits/teams/
								<?php 
									if ($match_type == 'national') {
										echo strtolower($team_1_nat);
									} elseif ($match_type == 'club') {
										echo strtolower($team_1_abb);
									}
								?>
								_<?php echo $year;?>/front.png" alt="<?php echo $team_1;?>">
							</td>
							<td class="team-shirt">
								<img src="img/kits/teams/
								<?php 
									if ($match_type == 'national') {
										echo strtolower($team_2_nat);
									} elseif ($match_type == 'club') {
										echo strtolower($team_2_abb);
									}
								?>
								_<?php echo $year;?>/front.png" alt="<?php echo $team_2;?>">
							</td>
						</tr>
						
						<tr>
							<td class="team-1">
								<?php
									foreach($team_1_lineup as $shirt => $person) {
										echo $person;
										echo '<img class="line-up-shirt" src="img/kits/teams/';
										if ($match_type == 'national') {
											echo strtolower($team_1_nat);
										} elseif ($match_type == 'club') {
											echo strtolower($team_1_abb);
										}										
										echo '_'.$year.'/'.$shirt.'.png" alt="'.$team_1.'">';
										echo '<br>';
									}
								?>
							</td>
							<td class="team-2">
								<?php
									foreach($team_2_lineup as $shirt => $person) {
										echo '<img class="line-up-shirt" src="img/kits/teams/';
										if ($match_type == 'national') {
											echo strtolower($team_2_nat);
										} elseif ($match_type == 'club') {
											echo strtolower($team_2_abb);
										}	
										echo '_'.$year.'/'.$shirt.'.png" alt="'.$team_2.'">';
										echo $person;
										echo '<br>';
									}
								?>
							</td>
						</tr>
	
					</tbody>
					
				</table>
				
				<?php
					if (count($team_1_subs) + count($team_2_subs) > 0) {
						echo '<h3 class="centre-text">Substitutes</h3>';
						echo '<table class="line-ups">';
					} else {
						echo '<table class="hidden">';
					}
				?>
				
					<tbody>
						<tr>
							<td class="team-1">
								<?php
									foreach($team_1_subs as $shirt => $person) {
										echo $person;
										echo '<img class="line-up-shirt" src="img/kits/teams/'.strtolower($team_1_nat).'_'.$year.'/'.$shirt.'.png" alt="'.$team_1.'">';
										echo '<br>';
									}
								?>
							</td>
							<td class="team-2">
								<?php
									foreach($team_2_subs as $shirt => $person) {
										echo '<img class="line-up-shirt" src="img/kits/teams/'.strtolower($team_2_nat).'_'.$year.'/'.$shirt.'.png" alt="'.$team_2.'">';
										echo $person;
										echo '<br>';
									}
								?>
							</td>
						</tr>
	
					</tbody>
					
				</table>
				
			</div>
			
			<div class="formatted-text">
				<h2>Match Report</h2>
				
				<?php echo html_entity_decode($match_report); ?>
				
				<?php 
	
					$goals = " 
						SELECT * FROM goals
						WHERE match_name = '$title'
						ORDER BY minute, stoppage_time";
					$goal_query = $connectDB->query($goals);
					
					$goal_list = array();
								
					while ($dataRows = $goal_query->fetch()) {
						
						$goal_list[] = $dataRows;
					}
					
					echo '<strong>Goalscorers: </strong>';	
					
					if ($score_1 + $score_2 == 0) {
						echo 'None';
					} else if (empty($goal_list)) {
						echo 'Not Available';
					} else {
						foreach ($goal_list as $goal) {
							echo '<span class="goalscorer"><img class="table-icon" src="img/icons/ball.png" alt="Football">';
							echo ' '.$goal['scorer'].' ('.$goal["minute"].'\', '.$goal["score"].')</span> ';
						}			
					}
					
				?>
				
			</div>
			
		</div>
		
		<div class="tags">
			
			<strong>Tags:</strong>
			
			<?php 
	
				$tags = " 
					SELECT 
					team_1.id AS team_1_id,
					team_1.display_name AS team_1_name,
					team_1.country AS team_1_nat,
					country_1.id AS team_1_country,
					team_2.id AS team_2_id,
					team_2.display_name AS team_2_name,
					team_2.country AS team_2_nat,
					country_2.id AS team_2_country,
					competitions.id AS competition_id,
					competitions.name AS competition
					FROM matches 
					INNER JOIN teams team_1 ON matches.team_1 = team_1.name 
					INNER JOIN teams team_2 ON matches.team_2 = team_2.name 
					INNER JOIN countries country_1 ON team_1.country = country_1.abbreviation 
					INNER JOIN countries country_2 ON team_2.country = country_2.abbreviation 
					INNER JOIN competitions on competitions.name = matches.competition
					WHERE matches.id = '$match_id'";
				$tag_query = $connectDB->query($tags);
								
				while ($dataRows = $tag_query->fetch()) {

					$tag_1_name = $dataRows["team_1_name"];
					$tag_2_name = $dataRows["team_2_name"];
					
					if ($match_type == 'national') {
						
						$tag_1_id = $dataRows["team_1_country"];
						$tag_2_id = $dataRows["team_2_country"];
						
						echo '<a class="tag-link" href="country.php?id='.$tag_1_id.'"><div class="tag">'.htmlentities($tag_1_name).'</div></a>';
						echo '<a class="tag-link" href="country.php?id='.$tag_2_id.'"><div class="tag">'.htmlentities($tag_2_name).'</div></a>';
						
					} elseif ($match_type == 'club') {
						
						$tag_1_id = $dataRows["team_1_id"];
						$tag_2_id = $dataRows["team_2_id"];
						
						echo '<a class="tag-link" href="club.php?id='.$tag_1_id.'"><div class="tag">'.htmlentities($tag_1_name).'</div></a>';
						echo '<a class="tag-link" href="club.php?id='.$tag_2_id.'"><div class="tag">'.htmlentities($tag_2_name).'</div></a>';
						
					}
					
					$competition_id = $dataRows["competition_id"];
					$competition_tag = $dataRows["competition"];
					echo '<a class="tag-link" href="competition.php?id='.$competition_id.'"><div class="tag">'.htmlentities($competition_tag).'</div></a>';
									
				}
				
			?>
						
		</div>
