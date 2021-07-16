		<table class="scoreboard">
			<tr>
				<td><?php echo htmlentities(strtoupper($team_1)); ?></td>
				<td><?php echo htmlentities($score_1); ?></td>
			</tr>
			<tr>
				<td><?php echo htmlentities(strtoupper($team_2)); ?></td>
				<td><?php echo htmlentities($score_2); ?></td>
			</tr>
		</table>
		
		<div class="match-stats">
			
			<div class="score-details">
					<?php
					if ($extra_time) {
						echo 'After Extra-Time';
					}
					if ($penalties) {
						echo ', '.$penalty_winner.' win '.$penalties_1.'-'.$penalties_2.' on penalties';
					}
				?>
			</div>
			
			<div class="match-details">
				<?php echo htmlentities($competition).' '.htmlentities($stage).', '.date_format($date, "j F Y"); ?><br>
				<?php echo htmlentities($stadium).', <img class="poll-icon" src="img/flags/'.$country.'.png" alt="'.$country.'"> '.htmlentities($city); ?>
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
								<form method="post" action="match.php?id='.$match_id.'">
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
		
		</div>
		
		<div class="biography">
			
			<div class="formatted-text">
				<?php echo html_entity_decode($intro_text); ?>
			</div>
			
			<div class="formatted-text">
				<?php echo html_entity_decode($match_report); ?>
			</div>
			
		</div>
		
		<div class="tags">
			
			<strong>Tags:</strong><br>
						
		</div>
