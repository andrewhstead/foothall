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
			<?php echo htmlentities($description); ?>
		</p>
		
		<h2>
			<?php
				$date = date('Y-m-d H:i:s');
				if ($date > $expiry) {
					echo "The Results ";
				} else {
					echo "The Contenders";
				}
			?>
		</h2>
		
		<table class="poll-choices">
			
			<?php

				$choices = "SELECT * FROM people_votes 
					INNER JOIN people ON people_votes.option = people.name
					WHERE people_votes.poll = $poll_id
					ORDER BY people_votes.votes desc, people.id";
				$option_list = $connectDB->query($choices);

				$position = 0;
				
				while ($dataRows = $option_list->fetch()) {

					$position ++;
					
					$name = $dataRows["name"];
					$votes = $dataRows["votes"];
					$nationality = $dataRows["nationality"];
					
					if ($position <= $places) {
						echo '<tr class="election-place">';
					} else {
						echo '<tr>';
					}
					echo '<td><img class="poll-icon" src="img/flags/'
						.strtolower($nationality).'.png" alt="'
						.$nationality.'"></td>';
					echo '<td>'.htmlentities($name).'</td>';
					echo '<td><span class="vote-button">Vote</span></td>';
					
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
