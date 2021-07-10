		<h1 class="info-page">
			<?php echo htmlentities($name); ?> 
		</h1>
		<div class="sub-heading">
			<img class="text-icon" src="img/flags/<?php echo strtolower($nationality); ?>
				.png" alt="<?php echo htmlentities($nationality); ?>">
			<?php echo htmlentities($country_name); ?>
		</div>
		
		<div class="person-stats">
			
			<div class="personal-details">
			
				<div class="picture-frame">
					<img class="portrait" src="img/portraits/
					<?php echo htmlentities($file_code); ?>.jpg" alt="<?php echo htmlentities($name); ?>">
					<div class="copyright-info"><?php echo htmlentities($picture_credit); ?></div>
				</div>
				<strong>Date of Birth:</strong> <?php echo date_format($date_of_birth, "d/m/Y"); ?><br>
				<strong>Place of Birth:</strong> <?php echo htmlentities($place_of_birth).', '.htmlentities($country_of_birth); ?><br>
				<?php
					if (!$living) {	
						echo '<strong>Date of Death:</strong> '.date_format($date_of_death, "d/m/Y").'<br>';
					}
				?>
				<strong>Position:</strong> <?php echo htmlentities($position); ?><br>
				
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
								<form method="post" action="person.php?id='.$person_id.'">
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
				<?php echo html_entity_decode($biography); ?>
			</div>
			
		</div>
		
		<div class="tags">
			
			<strong>Tags:</strong><br>
			<?php 
				
				foreach ($tag_list as $person_tag) {
						
					echo '<div class="tag">'.htmlentities($person_tag).'</div>';
						
				}
			?>
			
		</div>
