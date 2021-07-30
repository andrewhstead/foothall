<?php
	$thispage = "Story Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
				
	$connectDB;
	
	if (isset($_GET["id"])) {
		$page_id = $_GET["id"];
	} else {
		$page_id = 1;
	}

	$stories = "SELECT * FROM stories WHERE active = true ORDER BY published desc";
	$story_query = $connectDB->query($stories);
	
	$story_list = array();
	
	while ($dataRows = $story_query->fetch()) {

		$id = $dataRows["id"];
		$story_date = new DateTime($dataRows["published"]);
		$title = $dataRows["title"];
		$content = $dataRows["content"];
		$category = $dataRows["category"];
		
		$story_list[] = $dataRows;
		
	}
	
?>

	<?php
		
		if (!$story_list) {
			echo '<div class="page-template">';
		} else {
			echo '<div class="heading-only">';
		}
		
	?>
	
	<h1>FootHall Stories</h1>
	
	<?php
		
		if (!$story_list) {
			echo '<h2>New stories will appear here.</h2>';
		} else {
			echo '</div>';
			echo '<div class="article-feed">';
		}	
		
		$total_items = count($story_list);
		$page_items = 10;
		$pagination_formula = $page_id * $page_items - $page_items;	
		$pagination_page = "stories";

		foreach (array_slice($story_list, $pagination_formula, $page_items)  as $story) {
					
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
			
			$display_date = new DateTime($story['published']);							
			echo '<strong>Added:</strong> ';
			echo date_format($display_date, "d/m/Y, H:i");
				
			echo '</div>';
						
			echo '</div>';
					
		}

		if (count($story_list) > $page_items) {
			include 'inc/pagination.php';
		}

	?>
	
	</div>	
	
<?php

	include 'inc/footer.php';
	
?>
