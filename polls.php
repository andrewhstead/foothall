<?php
	$thispage = "Polls Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
	
	$connectDB;
	
	$polls = "SELECT * FROM polls ORDER BY expiry desc";
	$poll_content = $connectDB->query($polls);

	$current = array();
	$expired = array();

	while ($dataRows = $poll_content->fetch()) {

		if ($dataRows["locked"] == true) {
			$expired[] = $dataRows;
		} else {
			$current[] = $dataRows;
		}
		
	}
	
	echo '<div class="feed-heading">Open Polls</div>';	
	
	if (!$current) {
		
		echo '<div class="feed-post">';
		echo '<div class="feed-body">';
		echo 'New polls will appear here soon.';
		echo '</div></div>';
		
	} else {
	
		foreach ($current as $item) if ($item['locked'] == false) {
			
			echo '<div class="feed-post">';
			
			echo '<div class="feed-body">';
			echo '<span class="post-title">'
				.'<a class="post-link" href="poll.php?id='
				.$item['id']
				.'">'
				.$item['title']
				.'</a></span>';
			
			echo '<br>'
				.$item['intro_text']
				.'<br>';
			
			$display_date = new DateTime($item['expiry']);
			echo '<strong>Expires:</strong> ';
			echo date_format($display_date, "d/m/Y, H:i");

			echo '</div></div>';
			
		}
		
	}
	
	echo '<div class="feed-heading">Completed Polls</div>';	
	
	if (!$expired) {
		
		echo '<div class="feed-post">';
		echo '<div class="feed-body">';
		echo 'Completed polls will appear here soon.';
		echo '</div></div>';
		
	} else {
	
		foreach ($expired as $item) if ($item['locked'] == true) {
			
			echo '<div class="feed-post">';
			
			echo '<div class="feed-body">';
			echo '<span class="post-title">'
				.'<a class="post-link" href="poll.php?id='
				.$item['id']
				.'">'
				.$item['title']
				.'</a></span>';
			
			echo '<br>'
				.$item['intro_text']
				.'<br>';
			
			$display_date = new DateTime($item['expiry']);
			echo '<strong>Expired:</strong> ';
			echo date_format($display_date, "d/m/Y, H:i");

			echo '</div></div>';
			
		}
		
	}
	
	include 'inc/footer.php';
?>
