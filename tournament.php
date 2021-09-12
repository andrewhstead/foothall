<?php
	$thispage = "tournaments";
	$primary_table = "tournaments";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
					
	if (isset($_GET["id"])) {
		$tournament_id = $_GET["id"];
	} else {
		$tournament_id = 1;
	}
						
	$connectDB;

	$tournament = "SELECT 
		competitions.name AS competition,
		competitions.id AS competition_id,
		tournaments.name AS tournament,
		tournaments.year AS year,
		tournaments.host AS host,
		host.display_name AS host_name,
		tournaments.host_2 AS host_2,
		host_2.display_name AS host_2_name,
		tournaments.host_3 AS host_3,
		host_3.display_name AS host_3_name,
		tournaments.host_4 AS host_4,
		host_4.display_name AS host_4_name,
		tournaments.winner AS winner,
		winner.display_name AS winner_name,
		winner.country AS winner_nat,
		tournaments.runner_up AS runner_up,
		runner_up.display_name AS runner_up_name,
		runner_up.country AS runner_up_nat,
		tournaments.teams AS teams,
		tournaments.games AS games,
		tournaments.goals AS goals,
		tournaments.top_scorer AS top_scorer,
		tournaments.scored AS scored,
		tournaments.intro_text AS intro_text,
		tournaments.review AS review
		FROM tournaments 
		INNER JOIN competitions ON tournaments.competition = competitions.id 
		INNER JOIN countries host ON tournaments.host = host.abbreviation 
		LEFT JOIN countries host_2 ON tournaments.host_2 = host_2.abbreviation 
		LEFT JOIN countries host_3 ON tournaments.host_3 = host_3.abbreviation 
		LEFT JOIN countries host_4 ON tournaments.host_4 = host_4.abbreviation 
		LEFT JOIN teams winner ON tournaments.winner = winner.name 
		LEFT JOIN teams runner_up ON tournaments.runner_up = runner_up.name 
		WHERE tournaments.id = $tournament_id";
	$tournament_query = $connectDB->query($tournament);
	
	while ($dataRows = $tournament_query->fetch()) {

		$competition = $dataRows["competition"];
		$competition_id = $dataRows["competition_id"];
		$tournament = $dataRows["tournament"];
		$year = $dataRows["year"];
		$host_abbreviation = $dataRows["host"];
		$host_name = $dataRows["host_name"];
		$host_2 = $dataRows["host_2"];
		$host_2_name = $dataRows["host_2_name"];
		$host_3 = $dataRows["host_3"];
		$host_3_name = $dataRows["host_3_name"];
		$host_4 = $dataRows["host_4"];
		$host_4_name = $dataRows["host_4_name"];
		$winner = $dataRows["winner"];
		$winner_name = $dataRows["winner_name"];
		$winner_nat = $dataRows["winner_nat"];
		$runner_up = $dataRows["runner_up"];
		$runner_up_name = $dataRows["runner_up_name"];
		$runner_up_nat = $dataRows["runner_up_nat"];
		$teams = $dataRows["teams"];
		$games = $dataRows["games"];
		$goals = $dataRows["goals"];
		$top_scorer = $dataRows["top_scorer"];
		$scored = $dataRows["scored"];
		$intro_text = $dataRows["intro_text"];
		$review = $dataRows["review"];
		
		$tournament_list[] = $dataRows;
		
	}
	
?>

	<div class="page-template">
		
		<h1 class="info-page">
			<?php echo htmlentities($tournament); ?>
		</h1>
		
		<?php
			if ($intro_text) {
				echo '<div class="formatted-text">'.html_entity_decode($intro_text).'</div>';	
			}
		?>
		
		<p>
			<strong>Hosts:</strong> <img class="table-icon" src="img/flags/<?php echo strtolower($host_abbreviation) ?>.png" alt="<?php echo strtolower($host_name) ?>"> <?php echo htmlentities($host_name) ?>
			<?php
				if ($host_2) {
					echo '/<img class="table-icon" src="img/flags/'.strtolower($host_2).'.png" alt="'.strtolower($host_2_name).'">  '.$host_2_name;
				}
				if ($host_3) {
					echo '/<img class="table-icon" src="img/flags/'.strtolower($host_3).'.png" alt="'.strtolower($host_3_name).'">  '.$host_3_name;
				}
				if ($host_4) {
					echo '/<img class="table-icon" src="img/flags/'.strtolower($host_4).'.png" alt="'.strtolower($host_4_name).'">  '.$host_4_name;
				}
			?>
			<br>
			<strong>Winners:</strong> <img class="table-icon" src="img/flags/<?php echo strtolower($winner_nat) ?>.png" alt="<?php echo strtolower($winner_nat) ?>"> <?php echo htmlentities($winner_name) ?><br>
			<strong>Runners-Up:</strong> <img class="table-icon" src="img/flags/<?php echo strtolower($runner_up_nat) ?>.png" alt="<?php echo strtolower($runner_up_nat) ?>"> <?php echo htmlentities($runner_up_name) ?><br>
			<br>
			<strong>Games:</strong> <?php if ($games != 0) { echo htmlentities($games); } ?><br>
			<strong>Goals:</strong> <?php if ($goals != 0) { echo htmlentities($goals); } ?><br>
			<strong>Average:</strong> <?php if ($games != 0) { echo number_format($goals/$games, 2); } ?>
			<?php
				if ($top_scorer) {
					echo '<br><strong>Top Goalscorer:</strong> <img class="table-icon" src="img/flags/'.strtolower($scorer_nation).'.png" alt="'.strtolower($scorer_nation).'"> '.htmlentities($top_scorer).' ('.htmlentities($scored).')';
				}
			?>
			
		</p>
		
		<div class="profile-content">
			
			<h2>Results</h2>
			
			<?php
				$stage_list = array();
				$results = array();

				$stages = "
					SELECT 
						matches.tournament AS tournament,
						matches.stage AS stage,
						matches.section AS section
					FROM matches
					INNER JOIN tournaments on tournaments.name = matches.tournament
					WHERE tournaments.id = $tournament_id
					ORDER BY round, section, date ASC";
				$stage_query = $connectDB->query($stages);
				$stage_query->execute();

				$matches = "
					SELECT 
						matches.id AS match_id,
						matches.active AS active,
						matches.competition AS competition,
						competitions.type AS competition_type,
						tournaments.id AS tournament_id,
						tournaments.year AS year,
						tournaments.name AS tournament,
						matches.note AS note,
						matches.standings AS standings,
						matches.round AS round,
						matches.stage AS stage,
						matches.section AS section,
						matches.date AS date,
						team_1.display_name AS team_1_name,
						team_1.country AS team_1_nat,
						matches.score_1 AS score_1,
						matches.score_2 AS score_2,
						team_2.display_name AS team_2_name,
						team_2.country AS team_2_nat
					FROM matches
					INNER JOIN teams team_1 ON matches.team_1 = team_1.name 
					INNER JOIN teams team_2 ON matches.team_2 = team_2.name
					INNER JOIN tournaments on tournaments.name = matches.tournament
					INNER JOIN competitions on tournaments.competition = competitions.id
					WHERE tournaments.id = $tournament_id
					ORDER BY section ASC";
				$matches_query = $connectDB->query($matches);
				$matches_query->execute();
				
				foreach ($stage_query as $match_stage) {
					
					$stage = $match_stage['stage'];
					$section = $match_stage['section'];
					
					if ($section) {
						$stage = $match_stage['stage'].' '.$section;
					} else {
						$stage = $match_stage['stage'];
					}
					
					if (!in_array($stage, $stage_list)) {
						$stage_list[] = $stage;
					}
			
				}
				
				foreach ($matches_query as $tournament_match) {
					
					if ($tournament_match['section']) {
						$tournament_match['stage'] .= ' '.$tournament_match['section'];
					}					
					$results[] = $tournament_match;
				
				}
				
				foreach ($stage_list as $tournament_stage) {
					
						echo '<div class="flex-wrapper">';
						echo '<div class="flex-item ">';
						
						$standings_matches = 0;
						
						echo '<h3>'.$tournament_stage.'</h3>';
						
							echo '<table class="results-table">';
					
							$stage_results = array();
							$stage_teams = array();
							$stage_standings = array();
							
							foreach ($results as $match_result) {
								
								if ($match_result['stage'] == $tournament_stage) {
									
								
									$match_id = $match_result["match_id"];
									$active = $match_result["active"];
									$note = $match_result["note"];
									$standings = $match_result["standings"];
									$date = new DateTime($match_result["date"]);
									$team_1_name = $match_result["team_1_name"];
									$team_1_nat = $match_result["team_1_nat"];
									$team_1_code = str_replace(' ','_',strtolower($team_1_name));
									$score_1 = $match_result["score_1"];
									$score_2 = $match_result["score_2"];
									$team_2_name = $match_result["team_2_name"];
									$team_2_nat = $match_result["team_2_nat"];
									$team_2_code = str_replace(' ','_',strtolower($team_2_name));
									
									echo '<tr>';
									echo '<td>'.date_format($date, "d/m/y").'</td>';
									if ($score_1 > $score_2) {
										echo '<td class="match-team-1"><strong>'.htmlentities($team_1_name).'</strong>';
									} else { 
										echo '<td class="match-team-1">'.htmlentities($team_1_name);
									}
									echo ' <img class="standings-icon" src="img/flags/'.strtolower($team_1_nat).'.png" alt="'.htmlentities($team_1_name).'">';
									echo '</td>';
									if ($active) {
										echo '<td class="table-member"><a class="table-link" href="match.php?id='.$match_id.'">';
										echo htmlentities($score_1).'-'.htmlentities($score_2);
										echo '</a>';
									} else {
										echo '<td>'.htmlentities($score_1).'-'.htmlentities($score_2).'</a>';
									}
									echo '</td>';
									echo '<td class="match-team-2"><img class="standings-icon" src="img/flags/'.strtolower($team_2_nat).'.png" alt="'.htmlentities($team_2_name).'"> ';
									if ($score_1 < $score_2) {
										echo '<strong>'.htmlentities($team_2_name).'</strong></td>';
									} else { 
										echo htmlentities($team_2_name).'</td>';
									}
									if ($note) {
										echo '<td>('.htmlentities($note).')</a>';
									}
									echo '</tr>';
							
									if ($standings == true) {
										
										$stage_results[] = $match_result;
									
										if (!in_array($team_1_name, $stage_teams)) {
											$stage_teams[$team_1_nat] = $team_1_name;
										}
										if (!in_array($team_2_name, $stage_teams)) {
											$stage_teams[$team_2_nat] = $team_2_name;
										}	
									
										foreach ($stage_teams as $team_abbreviation => $team_record) {
											if (!in_array($team_record, $stage_standings)) {
												$stage_standings[$team_record] = array(
													'abbr' => $team_abbreviation,
													'team' => $team_record,
													'played' => 0,
													'won' => 0,
													'drawn' => 0,
													'lost' => 0,
													'for' => 0,
													'against' => 0,
													'difference' => 0,
													'points' => 0,
												);
											}
													
										}
										
										$standings_matches += 1;
										
									}
									
								}
								
							}
							
							echo '</table>';	
						
						echo '</div>';					
						
						echo '<div class="flex-item ">';
					
						if ($standings_matches > 0) {
							
							echo '<table class="standings">';
							echo '<tr>
								<th>Pos</th>
								<th class="standings-team">Team</th>
								<th>P</th>
								<th>W</th>
								<th>D</th>
								<th>L</th>
								<th>F</th>
								<th>A</th>
								<th>GD</th>
								<th>Pts</th>
								</tr>';
								
							$position = 1;
							
							$display_standings = array();
							
							foreach ($stage_standings as $standings_record) {
								
								foreach ($stage_results as $standings_match) {
									
									if ($standings_match['team_1_name'] == $standings_record['team']) {
										$standings_record['played'] += 1;
										if ($standings_match['score_1'] > $standings_match['score_2']) {
											$standings_record['won'] += 1;
											$standings_record['points'] += 2;
										} elseif ($standings_match['score_1'] < $standings_match['score_2']) {
											$standings_record['lost'] += 1;
										} else {
											$standings_record['drawn'] += 1;
											$standings_record['points'] += 1;
										}
										$standings_record['for'] += $standings_match['score_1'];
										$standings_record['against'] += $standings_match['score_2'];
									} elseif ($standings_match['team_2_name'] == $standings_record['team']) {
										$standings_record['played'] += 1;
										if ($standings_match['score_1'] < $standings_match['score_2']) {
											$standings_record['won'] += 1;
											$standings_record['points'] += 2;
										} elseif ($standings_match['score_1'] > $standings_match['score_2']) {
											$standings_record['lost'] += 1;
										} else {
											$standings_record['drawn'] += 1;
											$standings_record['points'] += 1;
										}
										$standings_record['for'] += $standings_match['score_2'];
										$standings_record['against'] += $standings_match['score_1'];
										
									}
									$standings_record['difference'] = $standings_record['for'] - $standings_record['against'];
									
								}
								
								$display_standings[] = $standings_record;
								
							}
							
							$points = array_column($display_standings, 'points');
							$difference = array_column($display_standings, 'difference');
							$goals_for = array_column($display_standings, 'for');
							array_multisort($points, SORT_DESC, $difference, SORT_DESC, $goals_for, SORT_DESC, $display_standings);
							
							foreach ($display_standings as $display_record) {
							
								echo '<tr>
								<td>'.$position.'</td>
								<td>';
								echo '<img class="standings-icon" src="img/flags/'.strtolower($display_record["abbr"]).'.png" alt="'.htmlentities($display_record["team"]).'"> '.$display_record['team'];
								echo '</td>
								<td>'.$display_record['played'].'</td>
								<td>'.$display_record['won'].'</td>
								<td>'.$display_record['drawn'].'</td>
								<td>'.$display_record['lost'].'</td>
								<td>'.$display_record['for'].'</td>
								<td>'.$display_record['against'].'</td>
								<td>'.$display_record['difference'].'</td>
								<td>'.$display_record['points'].'</td>
								</tr>';
								$position++;
							}
							echo '</table>';
							
						}
						
						echo '</div>';
					
					echo '</div>';
					
				}
				
			?>
		
			<?php 
				
				if ($review) {
					echo '<h2>Tournament Review</h2>';
					echo htmlentities($review);
				}
			?>
		
		</div>
		
		<?php
			
			$navhead_page = "competition";
			$navhead_parameter = $competition_id;
			$navhead_text = $competition;
			
			$navbox_sql = "SELECT * FROM tournaments WHERE completed = true AND competition = $competition_id";
			$result_count = "SELECT COUNT(*) FROM tournaments WHERE completed = true AND competition = $competition_id";
			
			$navbox_column = "year";
			$navbox_page = "tournament";
			$navbox_current = $tournament_id;
			
			$navlink_parameter = "id";

			include 'inc/navbox.php';
		
		?>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
