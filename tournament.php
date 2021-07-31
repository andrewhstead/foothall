<?php
	$thispage = "Tournament Profile";
	
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
		tournaments.name AS tournament,
		tournaments.year AS year,
		tournaments.host AS host,
		host.display_name AS host_name,
		tournaments.host_2 AS host_2,
		host_2.display_name AS host_2_name,
		tournaments.host_3 AS host_3,
		host_3.display_name AS host_3_name,
		tournaments.winner AS winner,
		winner.display_name AS winner_name,
		tournaments.runner_up AS runner_up,
		runner_up.display_name AS runner_up_name,
		tournaments.intro_text AS intro_text,
		tournaments.review AS review
		FROM tournaments 
		INNER JOIN competitions ON tournaments.competition = competitions.id 
		INNER JOIN countries host ON tournaments.host = host.abbreviation 
		LEFT JOIN countries host_2 ON tournaments.host_2 = host_2.abbreviation 
		LEFT JOIN countries host_3 ON tournaments.host_3 = host_3.abbreviation 
		LEFT JOIN countries winner ON tournaments.winner = winner.abbreviation 
		LEFT JOIN countries runner_up ON tournaments.runner_up = runner_up.abbreviation 
		WHERE tournaments.id = $tournament_id";
	$tournament_query = $connectDB->query($tournament);
	
	while ($dataRows = $tournament_query->fetch()) {

		$competition = $dataRows["competition"];
		$tournament = $dataRows["tournament"];
		$year = $dataRows["year"];
		$host_abbreviation = $dataRows["host"];
		$host_name = $dataRows["host_name"];
		$host_2 = $dataRows["host_2"];
		$host_2_name = $dataRows["host_2_name"];
		$host_3 = $dataRows["host_3"];
		$host_3_name = $dataRows["host_3_name"];
		$winner = $dataRows["winner"];
		$winner_name = $dataRows["winner_name"];
		$runner_up = $dataRows["runner_up"];
		$runner_up_name = $dataRows["runner_up_name"];
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
			?>
			<br>
			<strong>Winners:</strong> <img class="table-icon" src="img/flags/<?php echo strtolower($winner) ?>.png" alt="<?php echo strtolower($winner_name) ?>"> <?php echo htmlentities($winner_name) ?><br>
			<strong>Runners-Up:</strong> <img class="table-icon" src="img/flags/<?php echo strtolower($runner_up) ?>.png" alt="<?php echo strtolower($runner_up_name) ?>"> <?php echo htmlentities($runner_up_name) ?><br>
		</p>
		
		<div class="profile-content">
			
			<?php

				$matches = "
					SELECT 
						matches.id AS match_id,
						matches.active AS active,
						matches.competition AS competition,
						tournaments.id AS tournament_id,
						tournaments.year AS year,
						tournaments.name AS tournament,
						matches.stage AS stage,
						matches.date AS date,
						team_1.display_name AS team_1_name,
						matches.score_1 AS score_1,
						matches.score_2 AS score_2,
						team_2.display_name AS team_2_name
					FROM matches
					INNER JOIN teams team_1 ON matches.team_1 = team_1.name 
					INNER JOIN teams team_2 ON matches.team_2 = team_2.name
					INNER JOIN tournaments on tournaments.name = matches.tournament
					WHERE tournaments.id = $tournament_id
					ORDER BY date ASC";
				$matches_query = $connectDB->query($matches);
				
				$iteration = 1;
				
				while ($dataRows = $matches_query->fetch()) {

					$match_id = $dataRows["match_id"];
					$active = $dataRows["active"];
					$date = new DateTime($dataRows["date"]);
					$year = $dataRows["year"];
					$competition = $dataRows["competition"];
					$tournament = $dataRows["tournament"];
					$stage = $dataRows["stage"];
					$team_1_name = $dataRows["team_1_name"];
					$score_1 = $dataRows["score_1"];
					$score_2 = $dataRows["score_2"];
					$team_2_name = $dataRows["team_2_name"];
					
					if ($iteration == 1) {
						echo '<h2>Results</h2>';
						echo '<table class="results-table">';
					}
					
					echo '<tr>';
					echo '<td>'.date_format($date, "d/m/y").'</td>';
					echo '<td>'.htmlentities($team_1_name).'</td>';
					if ($active) {
						echo '<td class="table-member"><a class="table-link" href="match.php?id='.$match_id.'">';
						echo htmlentities($score_1).'-'.htmlentities($score_2);
						echo '</a>';
					} else {
						echo '<td>'.htmlentities($score_1).'-'.htmlentities($score_2).'</a>';
					}
					echo '</td>';
					echo '<td>'.htmlentities($team_2_name).'</td>';
					echo '</tr>';
					
					$iteration++;
					
				}
				
				echo '</table>';
				
			?>
		
			<?php 
				
				if ($review) {
					echo '<h2>Tournament Review</h2>';
					echo htmlentities($review);
				}
			?>
		
		</div>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
