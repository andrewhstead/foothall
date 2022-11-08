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
					if ($date > $expiry) {
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
		
		<?php
		
			if ($poll_type == 'person') {
		
				$choices = "SELECT 
					people.id AS person_id,
					people.name AS player_name,
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
					ORDER BY people_votes.votes desc, people.id";
				$contender_list = $connectDB->query($choices);
				$option_list = $connectDB->query($choices);
			
			} else if ($poll_type == 'match') {
		
				$choices = "SELECT 
					matches.id AS match_id,
					matches.title AS title,
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
					hall_teams.id AS team_id,
					hall_teams.title AS title,
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
		
		?>
		
		<h2>
			The Contenders
		</h2>
		
		<div class="contender-wrapper">
		
		<?php
		
			while ($dataRows = $contender_list->fetch()) {
			
				if ($poll_type == 'person') {
					
					$contender_id = $dataRows["person_id"];
					$admitted = $dataRows["admitted"];
					$name = $dataRows["player_name"];
					$nationality = $dataRows["nationality"];
					$intro_text = $dataRows["intro_text"];
					$position = $dataRows["position"];
					$country_id = $dataRows["country_id"];
					
				} else if ($poll_type == 'match') {
					
					$contender_id = $dataRows["match_id"];
					$admitted = $dataRows["admitted"];
					$name = $dataRows["title"];
					$intro_text = $dataRows["intro_text"];
					
				} else if ($poll_type == 'team') {
					
					$contender_id = $dataRows["team_id"];
					$admitted = $dataRows["admitted"];
					$name = $dataRows["title"];
					$intro_text = $dataRows["intro_text"];
					
				}
				
		?>
		
			<div class="poll-contender">
				<span class="contender-head">
					<?php 
						if ($poll_type == 'person') {
							echo '<img class="text-icon" src="img/flags/'.strtolower($nationality).'.png" alt="'.htmlentities($nationality).'"> ';
						}
						if ($admitted) {
							echo '<a class="standard-link" href="person.php?id='.$contender_id.'">'.htmlentities($name).'</a>';
							} else {
							echo htmlentities($name); 
						} 
						if ($poll_type == 'person') {
							echo ' (<a class="standard-link" href="country.php?id='.htmlentities($country_id).'">'.htmlentities($nationality).'</a>)';
						}
					?>
				</span>
				<br>
				<?php
					if ($poll_type == 'person') {
						echo'<strong>Position:</strong> '.htmlentities($position).'<br>';
					}
				?>
				<div class="formatted-text">
					<?php echo html_entity_decode($intro_text); ?>
				</div>
			</div>
		
		<?php } ?>
		
		</div>
		
		<h2>
			The Standings
		</h2>
		
		<table class="poll-choices">
			
			<?php

				$ranking = 0;
				
				while ($dataRows = $option_list->fetch()) {

					$ranking ++;
					
					$contender_id = $dataRows["contender_id"];
					$votes = $dataRows["votes"];
					
					if ($poll_type == 'person') {
						$name = $dataRows["player_name"];
						$nationality = $dataRows["nationality"];
					} else if ($poll_type == 'match') {
						$name = $dataRows["title"];
					} else if ($poll_type == 'team') {
						$name = $dataRows["title"];
					}
					
					if ($ranking <= $places) {
						echo '<tr class="election-place">';
					} else {
						echo '<tr>';
					}
					if ($poll_type == 'person') {
						echo '<td><img class="poll-icon" src="img/flags/'
						.strtolower($nationality).'.png" alt="'
						.$nationality.'"></td>';
					}
					echo '<td>'.htmlentities($name).'</td>';
					echo '<td><form method="post" action="poll.php?id='.$poll_id.'"> <input type="hidden" name="chosen" value="'.$contender_id.'"> <input type="hidden" name="poll-type" value="'.$poll_type.'">';
					if ((isset($_COOKIE['general'])) AND (!isset($_COOKIE[$cookie_name]))) {
						echo '<input class="vote-button" type="submit" name="vote" value="&#10003;">';
					}
					echo '</form></td>';
					
					echo '<td class="progress-bar">';
					echo '<div class="progress-box">';
					
					echo '<div class="progress-fill" style="width: ';
					if ($total_votes == 0) {
						echo '0';
					} else {
						echo number_format((htmlentities($votes)/htmlentities($total_votes))*100, 1);
					}
					echo '%;">';
					if ($total_votes == 0) {
						echo '<span class="percentage">0%</span>';
					} else {
						echo '<span class="percentage">'.number_format((htmlentities($votes)/htmlentities($total_votes))*100, 1).'%</span>';
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
