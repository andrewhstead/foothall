		<h1 class="info-page">
			<?php echo htmlentities($name); ?> 
		</h1>
		<div class="sub-heading">
			<img class="text-icon" src="img/flags/<?php echo strtolower($nationality); ?>
				.png" alt="<?php echo htmlentities($nationality); ?>">
			<?php echo htmlentities($country_name); ?>
		</div>
		
		<div class="person-stats">
		
			<span class="admission-details">
				Elected: 
				<?php 
					if ($admission_poll) {
						echo '<a class="post-link" href="poll.php?id='.$admission_poll.'">'.htmlentities($admission_date).'</a>';
						} else {
						echo htmlentities($admission_date).' (EP)'; 
					}
				?>
				<br>
			</span>
			<br>
			<div class="picture-frame">
				<img class="portrait" src="img/portraits/
				<?php echo htmlentities($file_code); ?>.jpg" alt="<?php echo htmlentities($name); ?>">
				<div class="copyright-info"><?php echo htmlentities($picture_credit); ?></div>
			</div>
			<strong>Date of Birth:</strong> <?php echo htmlentities($date_of_birth); ?><br>
			<strong>Place of Birth:</strong> <?php echo htmlentities($place_of_birth).', '.htmlentities($country_of_birth); ?><br>
			<?php
				if (!$living) {	
					echo '<strong>Date of Death:</strong> '.htmlentities($date_of_death).'<br>';
				}
			?>
			<strong>Position:</strong> <?php echo htmlentities($position); ?><br>
		
		</div>
		
		<div class="biography">
			
			<p>
				<?php echo htmlentities($intro_text); ?>
			</p>
			
			<p>
				<?php echo htmlentities($biography); ?>
			</p>
			
		</div>
