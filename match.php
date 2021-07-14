<?php
	$thispage = "Match Profile";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
					
	if (isset($_GET["id"])) {
		$match_id = $_GET["id"];
	} else {
		$match_id = 1;
	}
						
	$connectDB;

	if(isset($_POST["vote"])) {
		
		$chosen_score = $_POST["chosen"];		
		$sql = "UPDATE matches 
			SET score = score + $chosen_score, votes = votes + 1, rating = score / votes
			WHERE id = $match_id";
		$stmt = $connectDB->prepare($sql);
		$execute = $stmt->execute();
		
		header("Location:match.php?id=$match_id");
					
	}
	
	$match = "SELECT * FROM matches WHERE id = '$match_id'";
	$match_query = $connectDB->query($match);
	
	while ($dataRows = $match_query->fetch()) {

		$file_code = $dataRows["file_code"];
		$teams = $dataRows["teams"];
		$admitted = $dataRows["active"];
		$admission_date = $dataRows["admission_date"];
		$admission_poll = $dataRows["admission_poll"];
		$score = $dataRows["score"];
		$votes = $dataRows["votes"];
		$rating = $dataRows["rating"];
		$date = $dataRows["date"];
		$competition = $dataRows["competition"];
		$stage = $dataRows["stage"];
		$team_1 = $dataRows["team_1"];
		$score_1 = $dataRows["score_1"];
		$team_2 = $dataRows["team_2"];
		$score_2 = $dataRows["score_2"];
		$intro_text = $dataRows["intro_text"];
		$match_report = $dataRows["match_report"];
		
	}
		
?>

	<div class="page-template">
		
		<?php

			if ($admitted) {
				
				include 'inc/member_match.php';
			
			} else {
				
				echo '<h1>Sorry<br>Page Does Not Exist</h1>';
			
			}
				
		?>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
