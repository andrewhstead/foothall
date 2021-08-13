<?php
	$thispage = "Dream Team Profile";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
					
	if (isset($_GET["id"])) {
		$team_id = $_GET["id"];
	} else {
		$team_id = 1;
	}
						
	$connectDB;
	
	$team = "SELECT * FROM dream_teams 
		WHERE dream_teams.id = '$team_id'";
	$team_query = $connectDB->query($team);
	
	while ($dataRows = $team_query->fetch()) {

		$name = $dataRows["name"];
		
	}
		
?>

	<div class="page-template">
	
		<h1><?php echo htmlentities($name); ?> Dream Team</h1>
		
		<div class="flex-wrapper">
			
			<div class="flex-item dream-flex">
	
				<h2>Formation</h2>
				
				<?php
					echo '<img class="formation-diagram" alt="'.$name.'" src="img/dream/formation/'.strtolower($name).'.png" onclick="openBox(\'dream\', \'formation\', \''.strtolower($name).'\', \'png\')">';
				?>
			
			</div>
			
			<div class="flex-item dream-flex">
			
				<h2>Line-Up</h2>
				
				<?php
					
					$lineup = "
						SELECT 
							people_dream.person AS player,
							people_dream.number AS number,
							people_dream.position AS position,
							people.id AS person_id,
							people.nationality AS nationality,
							people.active AS active,
							people.file_code AS file_code,
							people.intro_text AS intro_text,
							people.picture_credit AS person_picture,
							people.license_link AS person_license,
							dream_teams.id AS team_id
						FROM people_dream
						INNER JOIN dream_teams
							ON dream_teams.name = people_dream.dream_team
						INNER JOIN people
							ON people.name = people_dream.person
						WHERE dream_teams.id = '$team_id'
						ORDER BY number";
					$lineup_query = $connectDB->query($lineup);
					
					while ($dataRows = $lineup_query->fetch()) {

						$person_id = $dataRows["person_id"];
						$name = $dataRows["player"];
						$nationality = $dataRows["nationality"];
						$number = $dataRows["number"];
						$position = $dataRows["position"];
						$file_code = $dataRows["file_code"];
						$intro_text = $dataRows["intro_text"];
						$active = $dataRows["active"];
						$person_picture = $dataRows["person_picture"];
						$person_license = $dataRows["person_license"];
						
						echo '<div class="dream-team-member">';
						
						echo '<div class="dream-team-position">'.htmlentities($number).' - '.htmlentities($position).'</div>';
						
						echo '<div class="small-frame"><img class="small-portrait" src="img/portraits/';
						echo $file_code;
						echo '.jpg" alt="'.$name.'">';
						echo '<div class="copyright-info-small">';
						if ($person_license) {
							echo '<a class="menu-link" href="'.htmlentities($person_license).'">';
						}
						echo htmlentities($person_picture);
						if ($person_license) {
							echo '</a>';
						}
						echo '</div></div>';
									
						echo '<h3><img class="table-icon" src="img/flags/'.strtolower($nationality).'.png" alt="'.htmlentities($nationality).'"> ';
						if ($active) {
							echo '<a class="standard-link" href="person.php?id='.$person_id.'">';
							echo htmlentities($name);
							echo '</a>';
						} else {
							echo htmlentities($name);
						}
						echo ' ('.htmlentities($nationality).')</h3>';
						
						echo html_entity_decode($intro_text); 
						
						echo '</div>';
						
					}

				?>
				
			</div>
			
		</div>
		
	</div>

<?php

	include 'inc/lightbox.html';
	include 'inc/footer.php';
	
?>
