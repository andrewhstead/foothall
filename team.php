<?php
	$thispage = "Team Profile";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
					
	if (isset($_GET["id"])) {
		$team_id = $_GET["id"];
	} else {
		$team_id = 1;
	}
						
	$connectDB;

	if(isset($_POST["vote"])) {
		
		$chosen_score = $_POST["chosen"];		
		$sql = "UPDATE hall_teams 
			SET score = score + $chosen_score, votes = votes + 1, rating = score / votes
			WHERE id = $team_id";
		$stmt = $connectDB->prepare($sql);
		$execute = $stmt->execute();
		
		header("Location:match.php?id=$match_id");
					
	}
	
	$team = "SELECT 
		hall_teams.file_code AS file_code,
		hall_teams.active AS admitted,
		hall_teams.admission_date AS admission_date,
		hall_teams.admission_poll AS admission_poll,
		hall_teams.votes AS votes,
		hall_teams.rating AS rating,
		hall_teams.display_name AS name,
		hall_teams.era AS era,
		teams.country AS nationality,
		hall_teams.intro_text AS intro_text,
		hall_teams.biography AS biography
		FROM hall_teams 
		INNER JOIN teams ON hall_teams.team_name = teams.name 
		WHERE hall_teams.id = '$team_id'";
	$team_query = $connectDB->query($team);
	
	while ($dataRows = $team_query->fetch()) {

		$file_code = $dataRows["file_code"];
		$admitted = $dataRows["admitted"];
		$admission_date = new DateTime($dataRows["admission_date"]);
		$admission_poll = $dataRows["admission_poll"];
		$votes = $dataRows["votes"];
		$rating = $dataRows["rating"];
		$name = $dataRows["name"];
		$era = $dataRows["era"];
		$nationality = $dataRows["nationality"];
		$intro_text = $dataRows["intro_text"];
		$biography = $dataRows["biography"];
		
	}
		
?>

	<div class="page-template">
		
		<?php

			if ($admitted) {
				
				include 'inc/member_team.php';
			
			} else {
				
				echo '<h1>Sorry<br>Page Does Not Exist</h1>';
			
			}
				
		?>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
