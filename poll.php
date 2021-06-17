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

	if(isset($_POST["vote"])) {
			
		$chosen_option = $_POST["chosen"];		
		$sql = "UPDATE people_votes SET votes = votes + 1 WHERE id = $chosen_option";
		$stmt = $connectDB->prepare($sql);
		$execute = $stmt->execute();	
			
		$sql2 = "UPDATE polls SET votes = votes + 1 WHERE id = $poll_id";
		$stmt2 = $connectDB->prepare($sql2);
		$execute2= $stmt2->execute();
		
	}

	$poll = "SELECT * FROM polls WHERE id = '$poll_id'";
	$page_content = $connectDB->query($poll);

	while ($dataRows = $page_content->fetch()) {

		$poll_type = $dataRows["poll_type"];
		$title = $dataRows["title"];
		$intro_text = $dataRows["intro_text"];
		$description = $dataRows["description"];
		$published = $dataRows["published"];
		$expiry = $dataRows["expiry"];
		
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
			<?php echo htmlentities($published); ?>
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
			<?php echo htmlentities($expiry); ?>
		</p>
		
		<p>
			<?php echo htmlentities($intro_text); ?>
		</p>
		
		<p>
			<?php echo nl2br($description); ?>
		</p>
		
		<?php
		
			$choices = "SELECT * FROM people_votes 
				INNER JOIN people ON people_votes.option = people.name
				WHERE people_votes.poll = $poll_id
				ORDER BY people_votes.votes desc, people.id";
			$contender_list = $connectDB->query($choices);
			$option_list = $connectDB->query($choices);
			
		?>
		
		<h2>
			The Contenders
		</h2>
		
		<?php
		
			while ($dataRows = $contender_list->fetch()) {
			
				$name = $dataRows["name"];
				$nationality = $dataRows["nationality"];
				$intro_text = $dataRows["intro_text"];
				$position = $dataRows["position"];
				
		?>
		
		<div class="poll-contender">
			<span class="contender-head">
				<img class="text-icon" src="img/flags/<?php echo strtolower($nationality); ?>
				.png" alt="<?php echo htmlentities($nationality); ?>">
				<?php echo htmlentities($name); ?> (<?php echo htmlentities($nationality); ?>)
			</span>
			<br>
			<strong>Position:</strong> <?php echo htmlentities($position); ?>
			<br>
			<?php echo htmlentities($intro_text); ?>
		</div>
		
		<?php } ?>
		
		<h2>
			The Standings
		</h2>
		
		<table class="poll-choices">
			
			<?php

				$ranking = 0;
				
				while ($dataRows = $option_list->fetch()) {

					$ranking ++;
					
					$contender_id = $dataRows["id"];
					$name = $dataRows["name"];
					$votes = $dataRows["votes"];
					$nationality = $dataRows["nationality"];
					
					if ($ranking <= $places) {
						echo '<tr class="election-place">';
					} else {
						echo '<tr>';
					}
					echo '<td><img class="poll-icon" src="img/flags/'
						.strtolower($nationality).'.png" alt="'
						.$nationality.'"></td>';
					echo '<td>'.htmlentities($name).'</td>';
					echo '<td><form method="post" action="poll.php?id='.$poll_id.'">
						<input type="hidden" name="chosen" value="'.$contender_id.'">
						<input class="vote-button" type="submit" name="vote" value="&#10003;">
						</form></td>';
					
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
						echo '0%';
					} else {
						echo number_format((htmlentities($votes)/htmlentities($total_votes))*100, 1).'%';
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
		
	</div>

	
<?php

	include 'inc/footer.php';
	
?>
