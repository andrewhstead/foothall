			<form class="edit-form" method="post" action="add_new.php?type=tournament_teams">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="tournament">Tournament:</label>
						<select id="tournament" name="tournament">
						<?php
							$tournaments = "SELECT * FROM tournaments ORDER BY competition, year";
							$tournament_query = $connectDB->query($tournaments);
							while ($dataRows = $tournament_query->fetch()) {
								$tournament_name = $dataRows["name"];
								echo '<option value="'.$dataRows["name"].'">'.$dataRows["name"].'</option>';
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
								echo '<option value="'.$dataRows["name"].'">'.$dataRows["name"].'</option>';
							}
						?>	
						</select>
						<br>
						<label for="section">Section:</label>
						<input type="text" name="section" placeholder="Section" id="section">
						<br>
						<label for="reached">Reached:</label>
						<input type="text" name="reached" placeholder="Reached" id="reached">
						<br><br>
						<label for="active">Active:</label>
						<input type="radio" name="status" id="active" value="active">
						<label for="admitted">Inactive:</label>
						<input type="radio" name="status" id="inactive" value="inactive">
				
					</div>
						
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>	
