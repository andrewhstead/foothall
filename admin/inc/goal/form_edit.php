			<form class="edit-form" method="post" action="edit_record.php?type=goals&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="match">Match:</label>
						<select id="match" name="match">
						<?php
							$matches = "SELECT * FROM matches ORDER BY date, competition, file_code";
							$match_query = $connectDB->query($matches);
							echo'<option label=" "></option>';
							while ($dataRows = $match_query->fetch()) {
								echo '<option value="'.$dataRows["file_code"].'"';
								if ($dataRows["file_code"] == $match) {
									echo ' selected ';
								}	
								echo '>'.$dataRows["date"].': '.$dataRows["team_1"].' '.$dataRows["score_1"].'-'.$dataRows["score_2"].' '.$dataRows["team_2"].' '.'</option>';
							}
						?>
						</select>
						<br>
						<label for="team">Team:</label>
						<select id="team" name="team">
						<?php
							$teams_sql = "SELECT * FROM teams ORDER BY type, gender desc, display_name";
							$teams_query = $connectDB->query($teams_sql);
							echo'<option label=" "></option>';
							while ($dataRows = $teams_query->fetch()) {
								$team_name = $dataRows["name"];
								echo '<option value="'.$dataRows["name"].'"';
								if ($dataRows["name"] == $team) {
									echo ' selected ';
								}	
								echo'>'.$dataRows["name"].'</option>';
							}
						?>	
						</select>
						<br><br>
						<label for="scorer">Scorer:</label>
						<select id="scorer" name="scorer">
						<?php
							$scorers_sql = "SELECT * FROM people WHERE as_player = true ORDER BY file_code";
							$scorer_query = $connectDB->query($scorers_sql);
							echo'<option label=" "></option>';
							while ($dataRows = $scorer_query->fetch()) {
								$scorer_name = $dataRows["name"];
								echo '<option value="'.$dataRows["name"].'"';
								if ($dataRows["name"] == $scorer) {
									echo ' selected ';
								}	
								echo'>'.$dataRows["name"].'</option>';
							}
						?>	
						</select>
						<br>
						<label for="assist">Assist:</label>
						<select id="assist" name="assist">
						<?php
							$assist_sql = "SELECT * FROM people WHERE as_player = true ORDER BY file_code";
							$assist_query = $connectDB->query($assist_sql);
							echo'<option label=" "></option>';
							while ($dataRows = $assist_query->fetch()) {
								$scorer_name = $dataRows["name"];
								echo '<option value="'.$dataRows["name"].'"';
								if ($dataRows["name"] == $assist) {
									echo ' selected ';
								}	
								echo'>'.$dataRows["name"].'</option>';
							}
						?>	
						</select>
						
					</div>
					
					<div class="flex-item form-section">
						
						<label for="own-goal">Own Goal?</label>
						<input type="checkbox" name="own-goal" id="own-goal" <?php if ($own_goal) { echo 'checked'; } ?>>
						<label for="penalty">Penalty?</label>
						<input type="checkbox" name="penalty" id="penalty" <?php if ($penalty) { echo 'checked'; } ?>>
						
						<br><br>
						<label for="minute">Minute:</label>
						<input type="text" name="minute"id="minute" size="1" value="<?php echo $minute ?>">
						<label for="stoppage">Stoppage:</label>
						<input type="text" name="stoppage"id="stoppage" size="1" value="<?php echo $stoppage ?>">
						<label for="half">Half:</label>
						<select id="half" name="half">
							<option value="1" <?php if ($half == 1) { echo 'selected'; } ?>>1</option>
							<option value="2" <?php if ($half == 2) { echo 'selected'; } ?>>2</option>
							<option value="3" <?php if ($half == 3) { echo 'selected'; } ?>>E1</option>
							<option value="4" <?php if ($half == 4) { echo 'selected'; } ?>>E2</option>
						</select>
						<br>
						<label for="score">Score:</label>
						<input type="text" name="score" placeholder="Score After Goal..." id="score" value="<?php echo $score ?>">
						<br><strong>NB: Score of Team 1 (as shown in 'Match' field) must be given first.</strong>
				
					</div>
						
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>
