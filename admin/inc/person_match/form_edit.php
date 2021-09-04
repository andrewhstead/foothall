			<form class="edit-form" method="post" action="edit_record.php?type=people_matches&code=<?php echo $record_id; ?>">
				
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
						<label for="match">Match:</label>
						<select id="match" name="match">
						<?php
							$match = "SELECT * FROM matches ORDER BY file_code";
							$match_query = $connectDB->query($match);
							echo'<option label=" "></option>';
							while ($dataRows = $match_query->fetch()) {
								echo '<option value="'.$dataRows["file_code"].'"';
								
								if ($dataRows["file_code"] == $match_code) {
									echo 'selected ';
								}
								echo '>'.$dataRows["date"].': '.$dataRows["team_1"].' '.$dataRows["score_1"].'-'.$dataRows["score_2"].' '.$dataRows["team_2"].' '.'</option>';
							}
						?>
						</select>
						<br>
						<label for="team">Team:</label>
						<select id="team" name="team">
						<?php
							$team = "SELECT * FROM teams ORDER BY name";
							$team_query = $connectDB->query($team);
							echo'<option label=" "></option>';
							while ($dataRows = $team_query->fetch()) {
								echo '<option value="'.$dataRows["abbreviation"].'"';
								
								if ($dataRows["abbreviation"] == $team_id) {
									echo 'selected ';
								}
								echo '>'.$dataRows["name"].'</option>';
							}
						?>
						</select>
						<br>
						<label for="number">Number:</label>
						<input type="text" name="number"id="number" size="1" value="<?php echo $number; ?>">
						
					</div>
						
					<div class="flex-item form-section">
						
						<label for="started">Started:</label>
						<input type="radio" name="status" id="started" value="started" <?php if ($started) { echo 'checked'; } ?>>
						<label for="substitute">Substitute:</label>
						<input type="radio" name="status" id="substitute" value="substitute" <?php if ($substitute) { echo 'checked'; } ?>>
						<br>For Substitutes: 
						<label for="replaced">Replaced #:</label>
						<input type="text" name="replaced"id="replaced" size="1" value="<?php echo $replaced; ?>">
						<label for="minute">Minute:</label>
						<input type="text" name="minute"id="minute" size="1" value="<?php echo $minute; ?>">
						<br><br>
						<label for="captain">Captain?</label>
						<input type="checkbox" name="captain" id="captain" <?php if ($captain) { echo 'checked'; } ?>>
						<label for="goalkeeper">Goalkeeper?</label>
						<input type="checkbox" name="goalkeeper" id="goalkeeper" <?php if ($goalkeeper) { echo 'checked'; } ?>>
						
					</div>
						
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>
