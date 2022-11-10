			<form class="edit-form" method="post" action="add_new.php?type=alternative_names">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="name">Team:</label><select id="successor-to" name="successor-to">
						<?php
							echo'<option label=" "></option>';
							$teams = "SELECT * FROM teams ORDER BY name";
							$team_query = $connectDB->query($teams);
							while ($dataRows = $team_query->fetch()) {
								$team_name = $dataRows["name"];
								echo '<option ';
								echo 'value="'.$dataRows["id"].'">'.$dataRows["name"].'</option>';
							}
						?>	
						</select>
						<br>
						<label for="name">Alternative:</label>
						<input type="text" name="alternative" placeholder="Alternative" id="alternative">
						<br>
						<label for="name">Abbreviation:</label>
						<input type="text" name="abbreviation" placeholder="Abbreviation" id="abbreviation">
						<br>
						<label for="name">Start:</label>
						<input type="text" name="start" placeholder="Start" id="start">
						<br>
						<label for="name">End:</label>
						<input type="text" name="end" placeholder="End" id="end">
						<br><br>
						<label for="active">Active:</label>
						<input type="checkbox" name="active" id="active">
				
					</div>
						
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>	
