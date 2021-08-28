		<form class="edit-form" method="post" action="edit_record.php?type=hall_teams&code=<?php echo $record_id; ?>">
		
			<div class="flex-wrapper">
					
				<div class="flex-item form-section">

					<label for="title">Title:</label>
					<input type="text" name="title" placeholder="Title" id="title" value="<?php echo $title; ?>">
					<br>
					<label for="display-name">Display Name:</label>
					<input type="text" name="display-name" placeholder="Display Name" id="display-name" value="<?php echo $display_name; ?>">
					<br>
					<label for="team-name">Team Name:</label>
					<select id="team-name" name="team-name">
					<?php
						$teams_sql = "SELECT * FROM teams ORDER BY type, gender desc, display_name";
						$teams_query = $connectDB->query($teams_sql);
						while ($dataRows = $teams_query->fetch()) {
							$team_name = $dataRows["name"];
							echo '<option value="'.$dataRows["name"].'"';
							if ($dataRows["name"] == $team_name) {
								echo ' selected ';
							}	
							echo '>'.$dataRows["name"].'</option>';
						}
					?>	
					</select>
					<br>
					<label for="era">Era:</label>
					<input type="text" name="era" placeholder="Era" id="era" value="<?php echo $era; ?>">
					<br>
					<label for="file-code">File Code:</label>
					<input type="text" name="file-code" placeholder="File Code" id="file-code" value="<?php echo $file_code; ?>">
					<br><br>
					<label for="picture-credit">Picture Credit:</label>
					<input type="text" name="picture-credit" placeholder="Picture Credit" id="picture-credit" value="<?php echo $picture_credit; ?>">
					<br>
					<label for="license-link">License Link:</label>
					<input type="text" name="license-link" placeholder="License Link" id="license-link" value="<?php echo $license_link; ?>">
				
				</div>	
					
				<div class="flex-item form-section">
					
					<label for="active">Admitted:</label>
					<input type="radio" name="status" id="active" value="active" <?php if ($active) { echo 'checked'; } ?>>
					<label for="contender">Contender:</label>
					<input type="radio" name="status" id="contender" value="contender" <?php if ($contender) { echo 'checked'; } ?>>
					<label for="admitted">Inactive:</label>
					<input type="radio" name="status" id="inactive" value="inactive" <?php if (!$active and !$contender) { echo 'checked'; } ?>>
					<br>
					<label for="admission-date">Admission Date:</label>
					<input type="date" name="admission-date" placeholder="DD-MM-YYYY" id="admission-date" value="<?php echo $admission_date; ?>">
					<br>
					<label for="admission-poll">Admission Poll:</label>
					<input type="text" name="admission-poll" placeholder="Admitted in Poll..." id="admission-poll" value="<?php echo $admission_poll; ?>">
						
					<br><br>
				
					<label for="score">Total Rating Score:</label>
					<input type="text" name="score" placeholder="Total Rating Score..." id="score" value="<?php echo $score; ?>">
					<br>
					<label for="votes">Rating Votes:</label>
					<input type="text" name="votes" placeholder="Rating Votes..." id="votes" value="<?php echo $votes; ?>">
					<br>
					<label for="rating">Average Rating:</label>
					<input type="text" name="rating" placeholder="Average Rating..." id="rating" value="<?php echo $rating; ?>">

				</div>
				
			</div>	
				
			<br>
			<label for="intro-text">Introductory Text:</label>
			<textarea class="editable-area" rows="5" cols="35" name="intro-text"><?php echo $intro_text; ?></textarea>
			<br>
			<label for="biography">Biography:</label>
			<textarea class="editable-area" rows="10" cols="35" name="biography"><?php echo $biography; ?></textarea>
			<br>
			<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
		</form>
