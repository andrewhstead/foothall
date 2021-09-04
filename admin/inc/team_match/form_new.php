			<form class="edit-form" method="post" action="add_new.php?type=teams_matches">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="hall-team">FootHall Team:</label>
						<select id="hall-team" name="hall-team">
						<?php
							$teams = "SELECT * FROM hall_teams ORDER BY title";
							$team_query = $connectDB->query($teams);
							echo'<option label=" "></option>';
							while ($dataRows = $team_query->fetch()) {
								echo '<option value="'.$dataRows["title"].'">'.$dataRows["title"].'</option>';
							}
						?>
						</select>
						<br>
						<label for="match">Match:</label>
						<select id="match" name="match">
						<?php
							$matches = "SELECT * FROM matches ORDER BY date, competition, file_code";
							$match_query = $connectDB->query($matches);
							echo'<option label=" "></option>';
							while ($dataRows = $match_query->fetch()) {
								echo '<option value="'.$dataRows["file_code"].'">'.$dataRows["date"].': '.$dataRows["team_1"].' '.$dataRows["score_1"].'-'.$dataRows["score_2"].' '.$dataRows["team_2"].' '.'</option>';
							}
						?>
						</select>
						
						<br><br>
						<label for="team-text">Team-Specific Introduction:</label>
						<textarea class="editable-area" rows="5" cols="35" name="team-text"></textarea>
				
					</div>
						
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save and Close">
				<input class="submit-button" type="submit" name="submit" value="Save and Add Another">
			
			</form>	
