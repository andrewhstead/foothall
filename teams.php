<?php
	$thispage = "Team Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
				
	$connectDB;

	$teams = "
		SELECT 
		hall_teams.id AS team_id,
		hall_teams.file_code AS file_code,
		hall_teams.display_name AS name,
		hall_teams.era AS era,
		hall_teams.biography AS biography,
		teams.type AS type
		FROM hall_teams 
		INNER JOIN teams on hall_teams.display_name = teams.display_name
		WHERE hall_teams.active = true ORDER BY type desc, hall_teams.admission_date";
	$team_query = $connectDB->query($teams);
	
	$team_list = array();
	$type_list = array();
	
	while ($dataRows = $team_query->fetch()) {

		$team_id = $dataRows["team_id"];
		$era = $dataRows["era"];
		$name = $dataRows["name"];
		$biography = $dataRows["biography"];
		$type = $dataRows["type"];
		
		$team_list[] = $dataRows;
			
		if (!in_array($type, $type_list)) {
			$type_list[] = $type;
		}
		
	}
	
?>

	<div class="page-template">
		
		<h1>
			FootHall Teams
		</h1>
		
			<div class="flex-wrapper">
			
			<?php
					
				if (!$team_list) {
					echo "<h2>Teams elected to The FootHall will appear here.</h2>";
				}
										
				foreach ($type_list as $type_head) {
						
					echo '<div class="sub-menu hall-teams-menu">';
						
					echo '<h2>'.ucfirst($type_head).' Teams</h2>';
						
					echo '<div class="flex-wrapper">';
				
					foreach ($team_list as $team_menu) if ($team_menu["type"] == $type_head) {
							
						echo '<div class="flex-item">';
						echo '&#9654; <a class="standard-link" href="team.php?id='.$team_menu["team_id"].'">'.$team_menu["name"].' '.$team_menu["era"].'</a>';
						echo '</div>';
							
					}
						
					echo '</div>';
					echo '</div>';
						
				}
			?>
			
		</div>
		
	</div>

	
<?php

	include 'inc/footer.php';
	
?>
