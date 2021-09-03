			<form class="edit-form" method="post" action="edit_record.php?type=tournament_teams&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="tournament">Tournament:</label>
						<select id="tournament" name="tournament">
						<?php
							$tournaments = "SELECT * FROM tournaments ORDER BY competition, year";
							$tournament_query = $connectDB->query($tournaments);
							while ($dataRows = $tournament_query->fetch()) {
								$tournament_name = $dataRows["name"];
								echo '<option value="'.$dataRows["name"].'"';
								if ($dataRows["name"] == $tournament_name) {
									echo ' selected ';
								}	
								echo '>'.$dataRows["name"].'</option>';
							}
						?>
						</select>
						<br>
						<label for="team">Team:</label>
						<select id="team" name="team">
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
						<label for="section">Section:</label>
						<input type="text" name="section" placeholder="Section" id="section" value="<?php echo $section; ?>">
						<br>
						<label for="reached">Reached:</label>
						<input type="text" name="reached" placeholder="Reached" id="reached" value="<?php echo $reached; ?>">
						<br><br>
						<label for="active">Active:</label>
						<input type="radio" name="status" id="active" value="active" <?php if ($active) { echo 'checked'; } ?>>
						<label for="inactive">Inactive:</label>
						<input type="radio" name="status" id="inactive" value="inactive" <?php if (!$active) { echo 'checked'; } ?>>
				
					</div>
						
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>
