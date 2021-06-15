<?php
	$thispage = "Home Page";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
	
	$connectDB;
	
	$polls = "SELECT * FROM polls";
	$poll_content = $connectDB->query($polls);
	$people = "SELECT * FROM people";
	$people_content = $connectDB->query($people);

	while ($dataRows = $poll_content->fetch()) {

		$content[] = $dataRows;
		
	}
	
	while ($dataRows = $people_content->fetch()) {

		if ($dataRows["admitted"] == true) {
			$content[] = $dataRows;
		}
		
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
		
		echo '<span class="post-title">';
		echo '<a href="';
		echo $item['type'];
		echo '.php?id=';
		echo $item['id'];
		echo '">';
		if ($item['type'] == 'poll') {
			echo $item['title'];
		} else if ($item['type'] == 'person') {
			echo $item['name'];
		}
		echo '</a>';
		echo '</span>';
		
		echo '<br>';
		
		echo $item['intro_text'];
		
		echo '<br>';
		
		if ($item['type'] == 'poll') {
			echo '<strong>Expires:</strong> ';
			echo $item['expiry'];
		} else if ($item['type'] == 'person') {
			echo '<strong>Admitted:</strong> ';
			echo $item['admission_date'];
		}
		
		echo '</div>';
			
		echo '</div>';
		
	}
	
	include 'inc/footer.php';
?>
