<?php
	$thispage = "Home Page";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
	
	$connectDB;
	
	$polls = "SELECT * FROM polls";
	$poll_content = $connectDB->query($polls);

	while ($dataRows = $poll_content->fetch()) {

		$poll_id = $dataRows["id"];
		$poll_title = $dataRows["title"];
		$poll_intro = $dataRows["intro_text"];
		$poll_posted = $dataRows["date_time"];
		$poll_expires = $dataRows["expiry"];
		
?>			
		
	<div class="feed-post">
		
		<span class="post-title">
			<a href="polls.php?id=<?php echo htmlentities($poll_id); ?>">
				<?php echo htmlentities($poll_title); ?>
			</a>
		</span>
		<br>
		<?php echo htmlentities($poll_intro); ?>
		<br>
		<strong>Started:</strong> <?php echo htmlentities($poll_posted); ?>
		<br>
		<strong>Expires:</strong> <?php echo htmlentities($poll_expires); ?>
		
	</div>
	
<?php } ?>

<?php
	include 'inc/footer.php';
?>
