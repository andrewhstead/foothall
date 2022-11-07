<?php
	
	$thispage = "Home Page";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
	
	$connectDB;
	
	if (isset($_GET["id"])) {
		$page_id = $_GET["id"];
	} else {
		$page_id = 1;
	}
	
	$content = array();
	
	$date = date('Y-m-d H:i:s');
	
	$polls = "SELECT * FROM polls WHERE expiry > NOW() AND published <= NOW() ORDER BY id desc";
	$poll_content = $connectDB->query($polls);
	while ($dataRows = $poll_content->fetch()) {
		$content[] = $dataRows;
	}
	
	$people = "SELECT
		id, type, name, file_code, nationality, admission_date AS published, intro_text
		FROM people WHERE active = true";
	$people_content = $connectDB->query($people);
	while ($dataRows = $people_content->fetch()) {
		$content[] = $dataRows;
	}
	
	$matches = "SELECT
		matches.id AS id,
		matches.type AS type,
		matches.admission_date AS published,
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
		WHERE matches.active = true";
	$match_content = $connectDB->query($matches);
	while ($dataRows = $match_content->fetch()) {
		$content[] = $dataRows;
	}	
	
	$teams = "
		SELECT 
		hall_teams.id AS id,
		hall_teams.file_code AS file_code,
		hall_teams.type AS type,
		hall_teams.published AS published,
		hall_teams.display_name AS name,
		hall_teams.era AS era,
		hall_teams.biography AS biography,
		hall_teams.intro_text AS intro_text,
		hall_teams.admission_date AS admission_date,
		teams.country AS nationality,
		teams.type AS team_type
		FROM hall_teams 
		INNER JOIN teams on hall_teams.display_name = teams.display_name
		WHERE hall_teams.active = true ORDER BY type desc, hall_teams.admission_date";
	$team_content = $connectDB->query($teams);
	while ($dataRows = $team_content->fetch()) {
		$content[] = $dataRows;
	}	
	
	$stories = "
		SELECT * FROM stories 
		WHERE stories.active = true 
		ORDER BY published";
	$story_content = $connectDB->query($stories);
	while ($dataRows = $story_content->fetch()) {
		$content[] = $dataRows;
	}	
	
	$dream = "
		SELECT * FROM dream_teams 
		WHERE dream_teams.active = true 
		ORDER BY published";
	$dream_content = $connectDB->query($dream);
	while ($dataRows = $dream_content->fetch()) {
		$content[] = $dataRows;
	}	
	
	$news = "
		SELECT * FROM news 
		WHERE news.active = true AND published <= NOW()
		ORDER BY published";
	$news_content = $connectDB->query($news);
	while ($dataRows = $news_content->fetch()) {
		$content[] = $dataRows;
	}
	
	echo '<div class="feed-template">';
		
	if ($content) {
		
		$total_items = count($content);
		$page_items = 10;
		$pagination_formula = $page_id * $page_items - $page_items;
		$pagination_page = "index";
				
		array_multisort(array_column($content, 'published'), SORT_DESC, $content);
		
		foreach (array_slice($content, $pagination_formula, $page_items)  as $item) {
		
			echo '<div class="feed-post">';
						
			echo '<div class="feed-heading">';
			if ($item['type'] == 'poll') {
				echo 'Hall of Fame Voting';
			} elseif ($item['type'] == 'story') {
				echo 'Football Stories';
			} elseif ($item['type'] == 'news') {
				echo 'Site News';
			} elseif ($item['type'] == 'dream') {
				echo 'Dream Teams';
			}  else {
				echo 'Hall of Fame Admission';
			}
			echo '</div>';
			
			echo '<div class="feed-body">';
			echo '<span class="post-title"><a class="post-link" href="'.$item['type'];
			if ($item['type'] == 'dream') {
				echo '_team';
			}
			echo '.php?id='.$item['id'].'">';
			
			if ($item['type'] == 'poll') {
				echo ' <img class="feed-picture" src="img/icons/poll.png" alt="Poll">';
				echo $item['title'];
				echo '</a>';
			} else if ($item['type'] == 'story') {
				echo $item['title'];
				echo '</a>';
			} else if ($item['type'] == 'dream') {
				echo $item['name'];
				echo ' Dream Team</a>';
			} else if ($item['type'] == 'news') {
				echo ' <img class="feed-picture" src="img/icons/feed_logo.png" alt="Site News">';
				echo $item['headline'];
				echo '</a>';
			} else if ($item['type'] == 'person') {
				echo ' <img class="feed-icon" src="img/flags/'
				.strtolower($item['nationality']).'.png" alt="'
				.$item['nationality'].'">';
				echo $item['name'];
				echo '</a>';
				echo ' <img class="feed-picture" src="img/portraits/'
				.$item['file_code'].'.jpg" alt="'
				.$item['name'].'">';
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
					
			echo '<div class="formatted-text">'.html_entity_decode($item['intro_text']);
			if ($item['type'] == 'poll') {
				$display_date = new DateTime($item['expiry']);
				echo ' Expires at ';
				echo date_format($display_date, "H:i, d M Y.");
			}
			echo '</div>';
			
			$published = new DateTime($item['published']);
			
			echo '<div class="right-text"><strong>Published:</strong> ';
			echo date_format($published, "d/m/Y, H:i");
			echo '</div>';
			
			echo '</div>';
				
			echo '</div>';
			
		}
	
	} else {
		
		echo '<div class="page-template"><h2>Sorry, no content is currently available.</h2></div>';
		$page_items = 0;

	}

	if (count($content) > $page_items) {
		include 'inc/pagination.php';
	}
	
	echo '</div>';
	
	include 'inc/footer.php';
?>
