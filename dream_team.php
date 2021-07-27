<?php
	$thispage = "Dream Team Profile";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
					
	if (isset($_GET["id"])) {
		$team_id = $_GET["id"];
	} else {
		$team_id = 1;
	}
						
	$connectDB;
	
	$team = "SELECT * FROM dream_teams 
		WHERE dream_teams.id = '$team_id'";
	$team_query = $connectDB->query($team);
	
	while ($dataRows = $team_query->fetch()) {

		$name = $dataRows["name"];
		
	}
		
?>

	<div class="page-template">
	
		<h1><?php echo htmlentities($name); ?> Dream Team</h1>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
