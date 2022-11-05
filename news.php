<?php
	$thispage = "FootHall Site News";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
					
	if (isset($_GET["id"])) {
		$news_id = $_GET["id"];
	} else {
		$news_id = 1;
	}
						
	$connectDB;

	$story = "SELECT * FROM news WHERE id = '$news_id'";
	$page_content = $connectDB->query($story);

	while ($dataRows = $page_content->fetch()) {

		$published = new DateTime($dataRows["published"]);
		$headline = $dataRows["headline"];
		$intro_text = $dataRows["intro_text"];
		$text = $dataRows["text"];
		
	}
?>

	<div class="page-template">
		
		<h1><?php echo htmlentities($headline); ?></h1>
		
		<p>
			<strong>
				Published:
			</strong> 
			<?php echo date_format($published, "d/m/Y, H:i"); ?>
		</p>
		
		<?php echo nl2br($intro_text); ?>
		
		<div class="news-story">
			<?php echo nl2br($text); ?>
		</div>
		
	</div>

	
<?php

	include 'inc/footer.php';
	
?>
