			<form class="edit-form" method="post" action="edit_record.php?type=people_votes&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="option">Option:</label>
						<select id="option" name="option">
						<?php
							$people = "SELECT * FROM people WHERE as_player = true ORDER BY file_code";
							$people_query = $connectDB->query($people);
							while ($dataRows = $people_query->fetch()) {
								$person_name = $dataRows["name"];
								echo '<option value="'.$dataRows["name"].'"';
							if ($dataRows["name"] == $option) {
								echo ' selected ';
							}	
							echo '>'.$dataRows["name"].'</option>';
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
