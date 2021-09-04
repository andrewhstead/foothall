			<form class="edit-form" method="post" action="edit_record.php?type=people_positions&code=<?php echo $record_id; ?>">
				
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
						<label for="position">Position:</label>
						<select id="position" name="position">
						<?php
							$positions = "SELECT * FROM positions ORDER BY name";
							$position_query = $connectDB->query($positions);
							echo'<option label=" "></option>';
							while ($dataRows = $position_query->fetch()) {
								echo '<option value="'.$dataRows["name"].'"';
								if ($dataRows["name"] == $position) {
									echo 'selected ';
								}
								echo '>'.$dataRows["name"].' '.'</option>';
							}
						?>
						</select>
						
					</div>
						
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>
