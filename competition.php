<?php
	$thispage = "Competition Profile";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
					
	if (isset($_GET["id"])) {
		$competition_id = $_GET["id"];
	} else {
		$competition_id = 1;
	}
						
	$connectDB;

	$competition = "SELECT * FROM competitions WHERE id = '$competition_id'";
	$competition_query = $connectDB->query($competition);
	
	while ($dataRows = $competition_query->fetch()) {

		$name = $dataRows["name"];
		$profile = $dataRows["profile"];
		
	}
	
	$tournaments = "
		SELECT 
			tournaments.id AS id, 
			tournaments.year AS year, 
			host.display_name AS host,
			host.abbreviation AS host_abbreviation, 
			host_2.display_name AS host_2,
			host_2.abbreviation AS host_2_abbreviation,  
			host_3.display_name AS host_3, 
			host_3.abbreviation AS host_3_abbreviation, 
			winner.display_name AS winner, 
			winner.abbreviation AS winner_abbreviation, 
			runner_up.display_name AS runner_up, 
			runner_up.abbreviation AS runner_up_abbreviation, 
			tournaments.active AS active
		FROM tournaments 
		INNER JOIN countries host ON tournaments.host = host.abbreviation 
		LEFT JOIN countries host_2 ON tournaments.host_2 = host_2.abbreviation
		LEFT JOIN countries host_3 ON tournaments.host_3 = host_3.abbreviation
		INNER JOIN countries winner ON tournaments.winner = winner.abbreviation 
		INNER JOIN countries runner_up ON tournaments.runner_up = runner_up.abbreviation 
		WHERE competition = $competition_id AND completed = true";
	$tournament_query = $connectDB->query($tournaments);
	
	$tournament_list = array();
	
	while ($dataRows = $tournament_query->fetch()) {

		$id = $dataRows["id"];
		$year = $dataRows["year"];
		$host = $dataRows["host"];
		$host_2 = $dataRows["host_2"];
		$host_3 = $dataRows["host_3"];
		$winner = $dataRows["winner"];
		$runner_up = $dataRows["runner_up"];
		$active = $dataRows["active"];
		
		$tournament_list[] = $dataRows;
		
	}
	
?>

	<div class="page-template">
		
		<h1 class="info-page">
			<?php echo htmlentities($name); ?>
		</h1>
		
		<div class="profile-content">
		
			<?php
			
				echo htmlentities($profile);
				
			?>
		
		</div>
		
		<?php
		
			if (!$tournament_list) {
				echo '<h2>Editions of this competition will appear here when added to the site.</h2>';
			} else {
				echo '<div class="sub-menu"><h2>Competition History</h2></div>';
			}
		
		?>	
		
		<table class="tournament-list">
			<tr>
				<th class="year-head">Year</th>
				<th class="host-head">Host</th>
				<th class="winner-head">Winner</th>
				<th class="runner-up-head">Runner-Up</th>
			</tr>
			
			<?php
				$row_count = 1;
					
				foreach ($tournament_list as $tournament_menu) {
					
					if($row_count % 2 == 0){
						echo '<tr class="tournament-summary-even">';
					} else {
						echo '<tr class="tournament-summary-odd">';
					}
					
					echo '<td>';
					if ($tournament_menu["active"] == true) {
						echo '<a class="standard-link" href="tournament.php?id='.$tournament_menu["id"].'">'.$tournament_menu["year"].'</a>';
					} else {
						echo $tournament_menu["year"];
					}
					echo '</td>';
					echo '<td class="host-cell">';
					if ($tournament_menu["host"] != "N/A") {
						echo '<img class="table-icon" src="img/flags/'.strtolower($tournament_menu["host_abbreviation"]).'.png" alt="'.strtolower($tournament_menu["host_abbreviation"]).'">  ';
					}
					echo '<script>if (window.innerWidth > 550) {document.write("'.$tournament_menu["host"].'");} else {document.write("'.$tournament_menu["host_abbreviation"].'");}</script>
					';
					if ($tournament_menu["host_2"]) {
						echo '
							<script>
								if (window.innerWidth > 550) {
									document.write("/");
								} else {
									document.write("<br>");
								}
							</script>
						';
						echo '<img class="table-icon" src="img/flags/'.strtolower($tournament_menu["host_2_abbreviation"]).'.png" alt="'.strtolower($tournament_menu["host_2_abbreviation"]).'">  ';
						echo '
							<script>
								if (window.innerWidth > 550) {
									document.write("'.$tournament_menu["host_2"].'");
								} else {
									document.write("'.$tournament_menu["host_2_abbreviation"].'");
								}
							</script>
						';
					}
					if ($tournament_menu["host_3"]) {
												echo '
							<script>
								if (window.innerWidth > 550) {
									document.write("/");
								} else {
									document.write("<br>");
								}
							</script>
						';
						echo '<img class="table-icon" src="img/flags/'.strtolower($tournament_menu["host_3_abbreviation"]).'.png" alt="'.strtolower($tournament_menu["host_3_abbreviation"]).'">  ';
						echo '
							<script>
								if (window.innerWidth > 550) {
									document.write("'.$tournament_menu["host_3"].'");
								} else {
									document.write("'.$tournament_menu["host_3_abbreviation"].'");
								}
							</script>
						';
					}
					echo '</td>';
					echo '<td class="winner-cell"><img class="table-icon" src="img/flags/'.strtolower($tournament_menu["winner_abbreviation"]).'.png" alt="'.strtolower($tournament_menu["winner_abbreviation"]).'">  ';
					echo '
						<script>
							if (window.innerWidth > 550) {
								document.write("'.$tournament_menu["winner"].'");
							} else {
								document.write("'.$tournament_menu["winner_abbreviation"].'");
							}
						</script></td>';
					echo '<td class="runner-up-cell"><img class="table-icon" src="img/flags/'.strtolower($tournament_menu["runner_up_abbreviation"]).'.png" alt="'.strtolower($tournament_menu["runner_up_abbreviation"]).'">  ';
					echo '
						<script>
							if (window.innerWidth > 550) {
								document.write("'.$tournament_menu["runner_up"].'");
							} else {
								document.write("'.$tournament_menu["runner_up_abbreviation"].'");
							}
						</script></td>';
					echo '</tr>';
					
					$row_count++;
								
				}
				
			?>
			
		</table>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
