<?php
	$thispage = "Match Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.html';
				
	$connectDB;

	$matches = "
		SELECT 
		year(matches.date) AS year,
		matches.date AS date,
		matches.competition AS competition,
		matches.stage AS stage,
		team_1.display_name AS team_1_name,
		matches.score_1 AS score_1,
		matches.score_2 AS score_2,
		team_2.display_name AS team_2_name
		FROM matches 
		INNER JOIN teams team_1 ON matches.team_1 = team_1.name 
		INNER JOIN teams team_2 ON matches.team_2 = team_2.name
		WHERE admitted = true ORDER BY date";
	$match_query = $connectDB->query($matches);
	
	$match_list = array();
	$year_list = array();
	
	while ($dataRows = $match_query->fetch()) {

		$date = new DateTime($dataRows["date"]);
		$year = $dataRows["year"];
		$competition = $dataRows["competition"];
		$stage = $dataRows["stage"];
		$team_1_name = $dataRows["team_1_name"];
		$score_1 = $dataRows["score_1"];
		$score_1 = $dataRows["score_2"];
		$team_2_name = $dataRows["team_2_name"];
		
		$match_list[] = $dataRows;
	
		if (!in_array($year, $year_list)) {
			$year_list[] = $year;
		}
		
	}
	
?>

	<div class="page-template">
		
		<h1>
			FootHall Matches
		</h1>
		
		<?php
		
			if (!$match_list) {
				echo "<h2>Matches elected to The FootHall will appear here.</h2>";
			}
					
			foreach ($year_list as $year_head) {
					
					echo '<div class="sub-menu">';
					
					echo '<h2>'.$year_head.'</h2>';
					
					echo '<div class="flex-wrapper">';
			
					foreach ($match_list as $match_menu) if ($match_menu["year"] == $year_head) {
						
						echo '<div class="flex-item">';
						echo '&#9654; <strong>'.$match_menu["competition"].' '.$match_menu["stage"].'</strong><br>';		
						echo $match_menu["team_1_name"].' '.$match_menu["score_1"].
						'-'.$match_menu["score_2"].' '.$match_menu["team_2_name"];
						echo '</div>';
						
					}
					
					echo '</div>';
					echo '</div>';
					
				}
		?>
		
	</div>

	
<?php

	include 'inc/footer.html';
	
?>
