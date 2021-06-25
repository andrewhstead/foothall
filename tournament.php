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

	$tournament = "SELECT * FROM tournaments INNER JOIN competitions ON tournaments.competition = competitions.id WHERE tournaments.id = $tournament_id";
	$tournament_query = $connectDB->query($tournament);
	
	while ($dataRows = $tournament_query->fetch()) {

		$competition = $dataRows["name"];
		$year = $dataRows["year"];
		$host = $dataRows["host"];
		$host_2 = $dataRows["host_2"];
		$host_3 = $dataRows["host_3"];
		$winner = $dataRows["winner"];
		$runner_up = $dataRows["runner_up"];
		$review = $dataRows["review"];
		
		$tournament_list[] = $dataRows;
		
	}
	
?>

	<div class="page-template">
		
		<h1 class="info-page">
			<?php echo htmlentities($year).' '.htmlentities($competition); ?>
		</h1>
		
		<p>
			<strong>Hosts:</strong> <img class="poll-icon" src="img/flags/<?php echo strtolower($host) ?>.png" alt="<?php echo strtolower($host) ?>"> <?php echo htmlentities($host) ?>
			<?php
				if ($host_2) {
					echo '/<img class="poll-icon" src="img/flags/'.strtolower($host_2).'.png" alt="'.strtolower($host_2).'">  '.$host_2;
				}
				if ($host_3) {
					echo '/<img class="poll-icon" src="img/flags/'.strtolower($host_3).'.png" alt="'.strtolower($host_3).'">  '.$host_3;
				}
			?>
			<br>
			<strong>Winners:</strong> <img class="poll-icon" src="img/flags/<?php echo strtolower($winner) ?>.png" alt="<?php echo strtolower($winner) ?>"> <?php echo htmlentities($winner) ?><br>
			<strong>Runners-Up:</strong> <img class="poll-icon" src="img/flags/<?php echo strtolower($runner_up) ?>.png" alt="<?php echo strtolower($runner_up) ?>"> <?php echo htmlentities($runner_up) ?><br>
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
