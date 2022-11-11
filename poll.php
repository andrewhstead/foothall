<?php
	ob_start();
	$thispage = "Hall of Fame Voting";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
					
	if (isset($_GET["id"])) {
		$poll_id = $_GET["id"];
	} else {
		$poll_id = 1;
	}
						
	$connectDB;

	$cookie_name = 'poll_'.$poll_id;
	$cookie_value = "voted";
		
	if(isset($_POST["vote"])) {
			
		$chosen_option = $_POST["chosen"];		
		if ($_POST["poll-type"] == 'person') {
			$sql = "UPDATE people_votes SET votes = votes + 1 WHERE id = $chosen_option";
		} else if ($_POST["poll-type"] == 'match') {
			$sql = "UPDATE match_votes SET votes = votes + 1 WHERE id = $chosen_option";
		} else if ($_POST["poll-type"] == 'team') {
			$sql = "UPDATE team_votes SET votes = votes + 1 WHERE id = $chosen_option";
		}
		$stmt = $connectDB->prepare($sql);
		$execute = $stmt->execute();	
			
		$sql2 = "UPDATE polls SET votes = votes + 1 WHERE id = $poll_id";
		$stmt2 = $connectDB->prepare($sql2);
		$execute2= $stmt2->execute();
		
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
		
		header("Location:poll.php?id=$poll_id");
					
	}

	$poll = "SELECT * FROM polls WHERE id = '$poll_id'";
	$page_content = $connectDB->query($poll);

	while ($dataRows = $page_content->fetch()) {

		$poll_type = $dataRows["poll_type"];
		$title = $dataRows["title"];
		$intro_text = $dataRows["intro_text"];
		$description = $dataRows["description"];
		$published = new DateTime($dataRows["published"]);
		$expiry = new DateTime($dataRows["expiry"]);
		
		$options = $dataRows["options"];
		$places = $dataRows["places"];
		$total_votes = $dataRows["votes"];
		
	}
	
	if ($poll_type == 'person') {
		
				$choices = "SELECT 
					people.id AS option_id,
					people.name AS object_heading,
					people.nationality AS nationality,
					people.active AS admitted,
					people.intro_text AS intro_text,
					people.position AS position,
					people_votes.id AS contender_id,
					people_votes.votes AS votes,
					countries.id AS country_id 
					FROM people_votes 
					INNER JOIN people ON people_votes.option = people.name
					INNER JOIN countries ON people.nationality = countries.abbreviation
					WHERE people_votes.poll = $poll_id AND people_votes.active = true
					ORDER BY votes desc, people.id";
				$contender_list = $connectDB->query($choices);
				$option_list = $connectDB->query($choices);
			
			} else if ($poll_type == 'match') {
		
				$choices = "SELECT 
					matches.id AS option_id,
					matches.title AS object_heading,
					matches.active AS admitted,
					matches.intro_text AS intro_text,
					match_votes.id AS contender_id,
					match_votes.votes AS votes
					FROM match_votes 
					INNER JOIN matches ON match_votes.option = matches.title
					WHERE match_votes.poll = $poll_id AND match_votes.active = true
					ORDER BY match_votes.votes desc, matches.id";
				$contender_list = $connectDB->query($choices);
				$option_list = $connectDB->query($choices);
			
			} else if ($poll_type == 'team') {
		
				$choices = "SELECT 
					hall_teams.id AS option_id,
					hall_teams.title AS object_heading,
					hall_teams.active AS admitted,
					hall_teams.intro_text AS intro_text,
					team_votes.id AS contender_id,
					team_votes.votes AS votes
					FROM team_votes 
					INNER JOIN hall_teams ON team_votes.option = hall_teams.title
					WHERE team_votes.poll = $poll_id AND team_votes.active = true
					ORDER BY team_votes.votes desc, hall_teams.id";
				$contender_list = $connectDB->query($choices);
				$option_list = $connectDB->query($choices);
			
	}
	
	$contenders = array();
			
	while ($dataRows = $contender_list->fetch()) {
		
		$contenders[] = $dataRows;
		
	}
	
?>

	<div class="page-template">
		
		<h1><?php echo htmlentities($title); ?></h1>
		
		<p>
			<strong>
				Published:
			</strong> 
			<?php echo date_format($published, "d/m/Y, H:i"); ?>
			<br>
			<strong>
				<?php
					$date = date('Y-m-d H:i:s');
					$current_date = new DateTime($date);
					if ($current_date > $expiry) {
						echo "Expired: ";
					} else {
						echo "Expires: ";
					}
				?>
			</strong>
			<?php echo date_format($expiry, "d/m/Y, H:i"); ?>
		</p>
		
		<p>
			<?php echo html_entity_decode($intro_text); ?>
		</p>
		
		<p>
			<?php echo nl2br($description); ?>
		</p>
		
		<h2>
			The Contenders
		</h2>
		
		<div class="contender-wrapper">
		
		<?php
		
			array_multisort(array_column($contenders, 'option_id'), SORT_ASC, $contenders);
		
			foreach ($contenders as $contender_bio) {
					
				echo '<div class="poll-contender">';
					echo '<span class="contender-head">';
						if ($poll_type == 'person') {
							echo '<img class="text-icon" src="img/flags/'.strtolower($contender_bio["nationality"]).'.png" alt="'.htmlentities($contender_bio["nationality"]).'"> ';
						}
						if ($contender_bio["admitted"]) {
							echo '<a class="standard-link" href="person.php?id='.$contender_bio["object_id"].'">'.htmlentities($contender_bio["object_heading"]).'</a>';
							} else {
							echo htmlentities($contender_bio["object_heading"]); 
						} 
						if ($poll_type == 'person') {
							// echo ' (<a class="standard-link" href="country.php?id='.htmlentities($contender_bio["country_id"]).'">'.htmlentities($contender_bio["nationality"]).'</a>)';
							echo ' ('.htmlentities($contender_bio["nationality"]).')'; 
						}
					echo '</span><br>';	
					if ($poll_type == 'person') {
						echo'<strong>Position:</strong> '.htmlentities($contender_bio["position"]).'<br>';
					}
					echo '<div class="formatted-text">';
						echo html_entity_decode($contender_bio["intro_text"]);
					echo '</div>';				
				echo '</div>';
			
			}
			
		?>
		
		</div>
		
		<h2>
			The Standings
		</h2>
		
		<table class="poll-choices">
			
			<?php

				$ranking = 0;
			
				array_multisort(array_column($contenders, 'votes'), SORT_DESC, $contenders);
				
				foreach ($contenders as $contender_score) {

					$ranking ++;
					
					if ($ranking <= $places) {
						echo '<tr class="election-place">';
					} else {
						echo '<tr>';
					}
					if ($poll_type == 'person') {
						echo '<td><img class="poll-icon" src="img/flags/'
						.strtolower($contender_score["nationality"]).'.png" alt="'
						.$contender_score["nationality"].'"></td>';
					}
					echo '<td>'.htmlentities($contender_score["object_heading"]).'</td>';
					echo '<td><form method="post" action="poll.php?id='.$poll_id.'"> <input type="hidden" name="chosen" value="'.$contender_score["option_id"].'"> <input type="hidden" name="poll-type" value="'.$poll_type.'">';
					if ($current_date < $expiry AND (isset($_COOKIE['general'])) AND (!isset($_COOKIE[$cookie_name]))) {
						echo '<input class="vote-button" type="submit" name="vote" value="&#10003;">';
					}
					echo '</form></td>';
					
					echo '<td class="progress-bar">';
					echo '<div class="progress-box">';
					
					echo '<div class="progress-fill" style="width: ';
					if ($total_votes == 0) {
						echo '0';
					} else {
						echo number_format((htmlentities($contender_score["votes"])/htmlentities($total_votes))*100, 1);
					}
					echo '%;">';
					if ($total_votes == 0) {
						echo '<span class="percentage">0%</span>';
					} else {
						echo '<span class="percentage">'.number_format((htmlentities($contender_score["votes"])/htmlentities($total_votes))*100, 1).'%</span>';
					}
					echo '</div>';
					
					echo '</div>';
					echo '</td>';
					
					echo '</tr>';
					
				}
				
			?>
		
		</table>
		
		<p>
			<strong>Total Votes:</strong> <?php echo htmlentities($total_votes); ?>
		</p>
	
		<div class="poll-navigation">
			
			<?php

				$adjacent = "SELECT id, title FROM polls WHERE id = $poll_id + 1 OR id = $poll_id - 1";
				$adjacent_polls = $connectDB->query($adjacent);

				while ($dataRows = $adjacent_polls->fetch()) {
				
					if ($dataRows["id"] == $poll_id - 1) {
						$previous_id = $dataRows["id"];
						$previous_title = $dataRows["title"];
						echo '<div class="previous-poll">';
						echo '&larr; Previous Poll<br>';
						echo '<a class="post-link" href="poll.php?id='
							.$previous_id
							.'">'
							.$previous_title
							.'</a>';
						echo '</div>';
					} elseif ($dataRows["id"] == $poll_id + 1) {
						$next_id = $dataRows["id"];
						$next_title = $dataRows["title"];
						echo '<div class="next-poll">';
						echo 'Next Poll &rarr;<br>';
						echo '<a class="post-link" href="poll.php?id='
							.$next_id
							.'">'
							.$next_title
							.'</a>';
						echo '</div>';
					}
				}

			?>
			
		</div>
		
	</div>

<?php

	include 'inc/footer.php';
	
?>
