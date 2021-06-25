<?php
	$thispage = "Tournament Profile";
	
	require_once 'inc/db.php';

	include 'inc/header.html';
					
	if (isset($_GET["id"])) {
		$tournament_id = $_GET["id"];
	} else {
		$tournament_id = 1;
	}
						
	$connectDB;

	$tournament = "SELECT 
		competitions.name AS name,
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

		$competition = $dataRows["name"];
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
		$review = $dataRows["review"];
		
		$tournament_list[] = $dataRows;
		
	}
	
?>

	<div class="page-template">
		
		<h1 class="info-page">
			<?php echo htmlentities($year).' '.htmlentities($competition); ?>
		</h1>
		
		<p>
			<strong>Hosts:</strong> <img class="poll-icon" src="img/flags/<?php echo strtolower($host_abbreviation) ?>.png" alt="<?php echo strtolower($host_name) ?>"> <?php echo htmlentities($host_name) ?>
			<?php
				if ($host_2) {
					echo '/<img class="poll-icon" src="img/flags/'.strtolower($host_2).'.png" alt="'.strtolower($host_2_name).'">  '.$host_2_name;
				}
				if ($host_3) {
					echo '/<img class="poll-icon" src="img/flags/'.strtolower($host_3).'.png" alt="'.strtolower($host_3_name).'">  '.$host_3_name;
				}
			?>
			<br>
			<strong>Winners:</strong> <img class="poll-icon" src="img/flags/<?php echo strtolower($winner) ?>.png" alt="<?php echo strtolower($winner_name) ?>"> <?php echo htmlentities($winner_name) ?><br>
			<strong>Runners-Up:</strong> <img class="poll-icon" src="img/flags/<?php echo strtolower($runner_up) ?>.png" alt="<?php echo strtolower($runner_up_name) ?>"> <?php echo htmlentities($runner_up_name) ?><br>
		</p>
		
		<div class="profile-content">
		
			<?php 
				
				if (!$review) {
					echo 'Tournament review will appear here.';
				} else {
					echo htmlentities($review);
				}
			?>
		
		</div>
		
	</div>
	
<?php

	include 'inc/footer.html';
	
?>
