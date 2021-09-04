			<form class="edit-form" method="post" action="add_new.php?type=people_positions">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="person">Person:</label>
						<select id="person" name="person">
						<?php
							$people = "SELECT * FROM people ORDER BY file_code";
							$person_query = $connectDB->query($people);
							echo'<option label=" "></option>';
							while ($dataRows = $person_query->fetch()) {
								echo '<option value="'.$dataRows["name"].'">'.$dataRows["name"].'</option>';
							}
						?>
						</select>
						<br>
						<label for="position">Position:</label>
						<select id="position" name="position">
						<?php
							$positions = "SELECT * FROM positions ORDER BY name";
							$position_query = $connectDB->query($positions);
							echo'<option label=" "></option>';
							while ($dataRows = $position_query->fetch()) {
								echo '<option value="'.$dataRows["name"].'">'.$dataRows["name"].' '.'</option>';
							}
						?>
						</select>
				
					</div>
						
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save and Close">
				<input class="submit-button" type="submit" name="submit" value="Save and Add Another">
			
			</form>	
