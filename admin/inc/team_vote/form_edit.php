			<form class="edit-form" method="post" action="edit_record.php?type=team_votes&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="option">Option:</label>
						<select id="option" name="option">
						<?php
							$teams = "SELECT * FROM hall_teams ORDER BY file_code";
							$team_query = $connectDB->query($teams);
							while ($dataRows = $team_query->fetch()) {
								$team_title = $dataRows["title"];
								echo '<option value="'.$dataRows["title"].'"';
							if ($dataRows["title"] == $option) {
								echo ' selected ';
							}	
							echo '>'.$dataRows["title"].'</option>';
							}
						?>	
						</select>
						
						<br><br>
						<label for="active">Active Option:</label>
						<input type="checkbox" name="active" id="active" <?php if ($active) { echo 'checked'; } ?>>
					
						
					</div>
					
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>
