<?php
	$thispage = "FootHall Story";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
					
	if (isset($_GET["id"])) {
		$story_id = $_GET["id"];
	} else {
		$story_id = 1;
	}
						
	$connectDB;

	$story = "SELECT * FROM stories WHERE id = '$story_id'";
	$page_content = $connectDB->query($story);

	while ($dataRows = $page_content->fetch()) {

		$published = new DateTime($dataRows["published"]);
		$title = $dataRows["title"];
		$intro_text = $dataRows["intro_text"];
		$content = $dataRows["content"];
		$category = $dataRows["category"];
		
	}
?>

	<div class="page-template">
		
		<h1><?php echo htmlentities($title); ?></h1>
		
		<p>
			<strong>
				Category:
			</strong> 
			<?php echo htmlentities($category); ?>
			<br>
			<strong>
				Published:
			</strong> 
			<?php echo date_format($published, "d/m/Y, H:i"); ?>
		</p>
		
		<p>
			<?php echo htmlentities($intro_text); ?>
		</p>
		
		<p>
			<?php echo nl2br($content); ?>
		</p>
		
	</div>

	
<?php

	include 'inc/footer.php';
	
?>
