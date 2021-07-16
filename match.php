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
	
	$match = "SELECT 
		matches.active AS admitted,
		matches.admission_date AS admission_date,
		matches.admission_poll AS admission_poll,
		matches.votes AS votes,
		matches.rating AS rating,
		matches.date AS date,
		matches.competition AS competition,
		matches.stage AS stage,
		matches.stadium AS stadium,
		matches.city AS city,
		matches.country AS country,
		team_1.display_name AS team_1_name,
		team_1.country AS team_1_nat,
		matches.score_1 AS score_1,
		team_2.display_name AS team_2_name,
		team_2.country AS team_2_nat,
		matches.score_2 AS score_2,
		matches.extra_time AS extra_time,
		matches.penalties AS penalties,
		matches.penalties_1 AS penalties_1,
		matches.penalties_2 AS penalties_2,
		matches.intro_text AS intro_text,
		matches.match_report AS match_report
		FROM matches 
		INNER JOIN teams team_1 ON matches.team_1 = team_1.name 
		INNER JOIN teams team_2 ON matches.team_2 = team_2.name 
		WHERE matches.id = '$match_id'";
	$match_query = $connectDB->query($match);
	
	while ($dataRows = $match_query->fetch()) {

		$admitted = $dataRows["admitted"];
		$admission_date = new DateTime($dataRows["admission_date"]);
		$admission_poll = $dataRows["admission_poll"];
		$votes = $dataRows["votes"];
		$rating = $dataRows["rating"];
		$date = new DateTime($dataRows["date"]);
		$competition = $dataRows["competition"];
		$stage = $dataRows["stage"];
		$stadium = $dataRows["stadium"];
		$city = $dataRows["city"];
		$country = $dataRows["country"];
		$team_1 = $dataRows["team_1_name"];
		$team_1_nat = $dataRows["team_1_nat"];
		$score_1 = $dataRows["score_1"];
		$team_2 = $dataRows["team_2_name"];
		$team_2_nat = $dataRows["team_2_nat"];
		$score_2 = $dataRows["score_2"];
		$extra_time = $dataRows["extra_time"];
		$penalties = $dataRows["penalties"];
		$penalties_1 = $dataRows["penalties_1"];
		$penalties_2 = $dataRows["penalties_2"];
		$intro_text = $dataRows["intro_text"];
		$match_report = $dataRows["match_report"];
		
		if ($penalties_1 > $penalties_2) {
			$penalty_winner = $team_1;
		} elseif ($penalties_2 > $penalties_1) {
			$penalty_winner = $team_2;
		}
		
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
