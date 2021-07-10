<?php
	$thispage = "Story Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
				
	$connectDB;

	$stories = "SELECT * FROM stories ORDER BY datetime desc";
	$story_query = $connectDB->query($stories);
	
	$story_list = array();
	
	while ($dataRows = $story_query->fetch()) {

		$id = $dataRows["id"];
		$story_date = new DateTime($dataRows["datetime"]);
		$title = $dataRows["title"];
		$content = $dataRows["content"];
		$category = $dataRows["category"];
		
		$story_list[] = $dataRows;
		
	}
	
?>

	<div class="heading-only">
		
		<h1>
			FootHall Stories
		</h1>
		
		<?php
		
			if (!$story_list) {
				echo "<h2>New stories will appear here.</h2>";
			}
		
		?>
		
	</div>	
	
	<div class="article-feed">
	
	<?php		
	
		foreach ($story_list as $story) {
					
			echo '<div class="story-post">';
		
			echo '<div class="feed-heading">';
			echo $story['title'];
			echo '</div>';
				
			echo '<div class="feed-body">';
			
			echo $story['intro_text'];
			
			echo '<div class="read-link">';
			echo '<a class="post-link" href="story.php?id='
				.$story['id']
				.'">Read the Article</a>';
			echo '</div>';
					
			echo '<strong>Category:</strong> ';
			echo $story['category'];
			
			echo '<br>';
			
			$display_date = new DateTime($story['datetime']);							
			echo '<strong>Added:</strong> ';
			echo date_format($display_date, "d/m/Y, H:i");
				
			echo '</div>';
						
			echo '</div>';
					
		}

	?>
	
	</div>	
	
<?php

	include 'inc/footer.html';
	
?>
