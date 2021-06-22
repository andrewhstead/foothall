<?php
	$thispage = "Home Page";
	
	require_once 'inc/db.php';

	include 'inc/header.html';
	
	$connectDB;
	
	$polls = "SELECT * FROM polls";
	$poll_content = $connectDB->query($polls);
	$people = "SELECT * FROM people WHERE admitted = true";
	$people_content = $connectDB->query($people);

	while ($dataRows = $poll_content->fetch()) {

		$content[] = $dataRows;
		
	}
	
	while ($dataRows = $people_content->fetch()) {

		$content[] = $dataRows;
			
	}
		
	foreach ($content as $item) {
		
		echo '<div class="feed-post">';
		
		echo '<div class="feed-heading">';
		if ($item['type'] == 'poll') {
			echo 'Hall of Fame Voting';
		} else if ($item['type'] == 'person') {
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
		}
		
		echo '</span>';
		
		echo '<br>';
		
		echo $item['intro_text'];
		
		echo '<br>';
		
		if ($item['type'] == 'poll') {
			$display_date = new DateTime($item['expiry']);
			echo '<strong>Expires:</strong> ';
			echo date_format($display_date, "d/m/Y, H:i");
		} else if ($item['type'] == 'person') {
			$display_date = new DateTime($item['admission_date']);
			echo '<strong>Admitted:</strong> ';
			echo date_format($display_date, "d F Y");
		}
		
		echo '</div>';
			
		echo '</div>';
		
	}
	
	include 'inc/footer.html';
?>
