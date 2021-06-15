<?php
	$thispage = "Home Page";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
	
	$connectDB;
	
	$polls = "SELECT * FROM polls";
	$poll_content = $connectDB->query($polls);

	while ($dataRows = $content->fetch()) {

		$poll_id = $dataRows["id"];
		$poll_title = $dataRows["title"];
		$poll_intro = $dataRows["intro_text"];
		$poll_posted = $dataRows["date_time"];
		$poll_expires = $dataRows["expiry"];
?>			
		
	<div class="feed-post">
		
		<a href="polls.php?id=<?php echo htmlentities($poll_id); ?>">
			<?php echo htmlentities($poll_title); ?>
		</a><br>
		<?php echo htmlentities($poll_intro); ?><br>
		Posted: <?php echo htmlentities($poll_posted); ?>; Expires: <?php echo htmlentities($poll_expires); ?>
		
	</div>
	
<?php } ?>

<?php
	include 'inc/footer.php';
?>
