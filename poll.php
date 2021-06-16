<?php
	$thispage = "Hall of Fame Voting";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
					
	if (isset($_GET["id"])) {
		$poll_id = $_GET["id"];
	} else {
		$poll_id = 1;
	}
						
	$connectDB;

	$poll = "SELECT * FROM polls WHERE id = '$poll_id'";
	$page_content = $connectDB->query($poll);

	while ($dataRows = $page_content->fetch()) {

		$title = $dataRows["title"];
		$intro_text = $dataRows["intro_text"];
		$description = $dataRows["description"];
		$published = $dataRows["published"];
		$expiry = $dataRows["expiry"];
					
?>

	<h1><?php echo htmlentities($title); ?></h1>

<?php } ?>
	
<?php

	include 'inc/footer.php';
	
?>
