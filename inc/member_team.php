		<h1 class="info-page">
			<img class="banner-icon" src="img/flags/<?php echo strtolower($nationality); ?>
				.png" alt="<?php echo htmlentities($nationality); ?>">
			<?php echo $name.' '.$era; ?>
		</h1>
		
		<div class="team-picture-frame">
			<img class="team-picture" src="img/teams/
			<?php echo htmlentities($file_code); ?>.jpg" alt="<?php echo htmlentities($name); ?>">
			<div class="copyright-info"><?php echo htmlentities($picture_credit); ?></div>
		</div>
		
		<div class="hall-status">
			Elected: 
			<?php 
				if ($admission_poll) {
					echo '<a class="post-link" href="poll.php?id='
						.$admission_poll.'">'
						.date_format($admission_date, "d F Y")
						.'</a>';
					} else {
					echo date_format($admission_date, "d F Y").' (EP)'; 
				}
			?>
			<br>
				
			Rating: <?php echo htmlentities($rating); ?> (<?php echo htmlentities($votes); ?> votes)
			<div class="rating-bar">
				Submit Your Rating: 
				<div class="rating-buttons">
					<?php
						for ($score = 1; $score <= 10; $score++) {
							echo '
							<div class="rating-block">
							<form method="post" action="team.php?id='.$team_id.'">
							<input type="hidden" name="chosen" value="'.$score.'">
							<input class="rating-block" type="submit" name="vote" value="'.$score.'">
							</form>
							</div>
							';
						}
					?>						
				</div>
			</div>
				
		</div>
		
		<div class="biography">
			
			<div class="formatted-text">
				<?php echo html_entity_decode($intro_text); ?>
			</div>
			
			<div>
				
			</div>
			
			<div class="formatted-text">				
				<?php echo html_entity_decode($biography); ?>
			</div>
			
		</div>
		
		<div class="tags">
			
			<strong>Tags:</strong><br>
						
		</div>
