<?php
	$thispage = "Home Page";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
	
	$connectDB;
	
	$content = array();
	
	$date = date('Y-m-d H:i:s');
	
	$polls = "SELECT * FROM polls WHERE expiry > CURDATE()";
	$poll_content = $connectDB->query($polls);
	$people = "SELECT * FROM people WHERE active = true";
	$people_content = $connectDB->query($people);
	$matches = "SELECT
		matches.id AS id,
		matches.type AS type,
		year(matches.date) AS year,
		team_1.display_name AS team_1_name,
		matches.score_1 AS score_1,
		matches.score_2 AS score_2,
		team_2.display_name AS team_2_name,
		matches.intro_text AS intro_text,
		matches.admission_date AS admission_date
		FROM matches 
		INNER JOIN teams team_1 ON matches.team_1 = team_1.name 
		INNER JOIN teams team_2 ON matches.team_2 = team_2.name
		WHERE active = true";
	$match_content = $connectDB->query($matches);
	$teams = "
		SELECT 
		hall_teams.id AS id,
		hall_teams.file_code AS file_code,
		hall_teams.type AS type,
		hall_teams.display_name AS name,
		hall_teams.era AS era,
		hall_teams.biography AS biography,
		hall_teams.intro_text AS intro_text,
		hall_teams.admission_date AS admission_date,
		teams.country AS nationality,
		teams.type AS team_type
		FROM hall_teams 
		INNER JOIN teams on hall_teams.display_name = teams.display_name
		WHERE active = true ORDER BY type desc, hall_teams.admission_date";
	$team_content = $connectDB->query($teams);

	while ($dataRows = $poll_content->fetch()) {

		$content[] = $dataRows;
		
	}
	
	while ($dataRows = $people_content->fetch()) {

		$content[] = $dataRows;
			
	}
	
	while ($dataRows = $match_content->fetch()) {

		$content[] = $dataRows;
			
	}
	
	while ($dataRows = $team_content->fetch()) {

		$content[] = $dataRows;
			
	}
	
	echo '<div class="feed-template">';
		
	if ($content) {
		
		foreach ($content as $item) {
		
			echo '<div class="feed-post">';
			
			echo '<div class="feed-heading">';
			if ($item['type'] == 'poll') {
				echo 'Hall of Fame Voting';
			} else {
				echo 'Hall of Fame Admission';
			}
			echo '</div>';
			
			echo '<div class="feed-body">';
			echo '<span class="post-title">'
				.'<a class="post-link" href="'
				.$item['type']
				.'.php?id='
				.$item['id']
				.'">';
			
			if ($item['type'] == 'poll') {
				echo $item['title'];
				echo '</a>';
			} else if ($item['type'] == 'person') {
				echo $item['name'];
				echo '</a>';
				echo ' <img class="feed-icon" src="img/flags/'
				.strtolower($item['nationality']).'.png" alt="'
				.$item['nationality'].'">';
			} else if ($item['type'] == 'match') {
				echo $item['team_1_name'].' '.$item['score_1'].'-'.$item['score_2'].' '.$item['team_2_name'].' ('.$item['year'].')';
				echo '</a>';
			} else if ($item['type'] == 'team') {
				echo $item['name'].' '.$item['era'];
				echo '</a>';
				echo ' <img class="feed-icon" src="img/flags/'
				.strtolower($item['nationality']).'.png" alt="'
				.$item['nationality'].'">';
			}
			
			echo '</span>';
			
			echo '<br>';
					
			echo '<div class="formatted-text">'.html_entity_decode($item['intro_text']).'</div>';
					
			if ($item['type'] == 'poll') {
				$display_date = new DateTime($item['expiry']);
				echo '<strong>Expires:</strong> ';
				echo date_format($display_date, "d/m/Y, H:i");
			} else {
				$display_date = new DateTime($item['admission_date']);
				echo '<strong>Admitted:</strong> ';
				echo date_format($display_date, "d F Y");
			}
			
			echo '</div>';
				
			echo '</div>';
			
		}
	
	} else {
		
		echo '<div class="page-template"><h2>Sorry, no content is currently available.</h2></div>';

	}
	
	echo '</div>';
	
	include 'inc/footer.php';
?>
