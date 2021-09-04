			<form class="edit-form" method="post" action="edit_record.php?type=people_teams&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="person">Person:</label>
						<select id="person" name="person">
						<?php
							$people = "SELECT * FROM people ORDER BY file_code";
							$person_query = $connectDB->query($people);
							echo'<option label=" "></option>';
							while ($dataRows = $person_query->fetch()) {
								echo '<option value="'.$dataRows["name"].'"';
								
								if ($dataRows["name"] == $person) {
									echo 'selected ';
								}
								echo '>'.$dataRows["name"].'</option>';
							}
						?>
						</select>
						<br>
						<label for="team">Team:</label>
						<select id="team" name="team">
						<?php
							$team_name = "SELECT * FROM teams ORDER BY name";
							$team_name_query = $connectDB->query($team_name);
							echo'<option label=" "></option>';
							while ($dataRows = $team_name_query->fetch()) {
								echo '<option value="'.$dataRows["name"].'"';
								
								if ($dataRows["name"] == $team) {
									echo 'selected ';
								}
								echo '>'.$dataRows["name"].'</option>';
							}
						?>
						</select>
						<br>
						<label for="hall-team">Hall Team:</label>
						<select id="hall-team" name="hall-team">
						<?php
							$hall = "SELECT * FROM hall_teams ORDER BY title";
							$hall_query = $connectDB->query($hall);
							echo'<option label=" "></option>';
							while ($dataRows = $hall_query->fetch()) {
								echo '<option value="'.$dataRows["title"].'"';
								
								if ($dataRows["title"] == $hall_team) {
									echo 'selected ';
								}
								echo '>'.$dataRows["title"].'</option>';
							}
						?>
						</select>
						
					</div>
						
					<div class="flex-item form-section">
						
						<label for="first">First:</label>
						<input type="text" name="first" id="first" size="2" value="<?php echo $first; ?>">
						<label for="last">Last:</label>
						<input type="text" name="last" id="last" size="2" value="<?php echo $last; ?>">
						<br>
						<label for="appearances">Appearances:</label>
						<input type="text" name="appearances" id="appearances" size="1" value="<?php echo $appearances; ?>">
						<label for="goals">Goals:</label>
						<input type="text" name="goals" id="goals" size="1" value="<?php echo $goals; ?>">
						
					</div>
						
				</div>
				<br>		
				<label for="summary">Summary:</label>
				<textarea class="editable-area" rows="5" cols="35" name="summary"><?php echo $summary; ?></textarea>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>
