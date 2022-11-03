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
	
	$alternatives = "
		SELECT 
			alternative_names.team AS team, 
			alternative_names.alternative AS alternative, 
			alternative_names.abbreviation AS abbreviation, 
			alternative_names.start AS start_date, 
			alternative_names.end AS end_date
		FROM alternative_names 
		INNER JOIN teams ON teams.name = alternative_names.team";
	$alternatives_query = $connectDB->query($alternatives);
	
	$alternative_list = array();
	
	while ($dataRows = $alternatives_query->fetch()) {
		
		$alternative_list[] = $dataRows;
		
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
			host_4.display_name AS host_4, 
			host_4.abbreviation AS host_4_abbreviation, 
			winner.name AS winner, 
			winner.display_name AS winner_display, 
			winner.abbreviation AS winner_abbreviation, 
			runner_up.name AS runner_up, 
			runner_up.display_name AS runner_up_display, 
			runner_up.abbreviation AS runner_up_abbreviation, 
			tournaments.active AS active
		FROM tournaments 
		INNER JOIN countries host ON tournaments.host = host.abbreviation 
		LEFT JOIN countries host_2 ON tournaments.host_2 = host_2.abbreviation
		LEFT JOIN countries host_3 ON tournaments.host_3 = host_3.abbreviation
		LEFT JOIN countries host_4 ON tournaments.host_4 = host_4.abbreviation
		INNER JOIN teams winner ON tournaments.winner = winner.name 
		INNER JOIN teams runner_up ON tournaments.runner_up = runner_up.name 
		WHERE competition = $competition_id AND completed = true";
	$tournament_query = $connectDB->query($tournaments);
	
	$tournament_list = array();
	
	while ($dataRows = $tournament_query->fetch()) {
		
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
					if ($tournament_menu["host_4"]) {
						echo '
							<script>
								if (window.innerWidth > 550) {
									document.write("/");
								} else {
									document.write("<br>");
								}
							</script>
						';
						echo '<img class="table-icon" src="img/flags/'.strtolower($tournament_menu["host_4_abbreviation"]).'.png" alt="'.strtolower($tournament_menu["host_3_abbreviation"]).'">  ';
						echo '
							<script>
								if (window.innerWidth > 550) {
									document.write("'.$tournament_menu["host_4"].'");
								} else {
									document.write("'.$tournament_menu["host_4_abbreviation"].'");
								}
							</script>
						';
					}
					echo '</td>';
					echo '<td class="winner-cell"><img class="table-icon" src="img/flags/'.strtolower($tournament_menu["winner_abbreviation"]).'.png" alt="'.strtolower($tournament_menu["winner_abbreviation"]).'">  ';
					
					foreach ($alternative_list as $alternative) {
						if ($alternative["team"] == $tournament_menu["winner"] && 
							$alternative["start_date"] <= $tournament_menu["year"] && 
							$alternative["end_date"] >= $tournament_menu["year"]) {
							echo '
								<script>
									if (window.innerWidth > 550) {
										document.write("'.$alternative["alternative"].'");
									} else {
										document.write("'.$alternative["abbreviation"].'");
									}
								</script></td>';
						} else {
							echo '
								<script>
									if (window.innerWidth > 550) {
										document.write("'.$tournament_menu["winner_display"].'");
									} else {
										document.write("'.$tournament_menu["winner_abbreviation"].'");
									}
								</script></td>';
						}
					}
					
					echo '<td class="runner-up-cell"><img class="table-icon" src="img/flags/'.strtolower($tournament_menu["runner_up_abbreviation"]).'.png" alt="'.strtolower($tournament_menu["runner_up_abbreviation"]).'">  ';

					foreach ($alternative_list as $alternative) {
						if ($alternative["team"] == $tournament_menu["runner_up"] && 
							$alternative["start_date"] <= $tournament_menu["year"] && 
							$alternative["end_date"] >= $tournament_menu["year"]) {
							echo '
								<script>
									if (window.innerWidth > 550) {
										document.write("'.$alternative["alternative"].'");
									} else {
										document.write("'.$alternative["abbreviation"].'");
									}
								</script></td>';
						} else {
							echo '
								<script>
									if (window.innerWidth > 550) {
										document.write("'.$tournament_menu["runner_up_display"].'");
									} else {
										document.write("'.$tournament_menu["runner_up_abbreviation"].'");
									}
								</script></td>';
						}
					}
					
					echo '</tr>';
					
					$row_count++;
								
				}
				
			?>
			
		</table>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
