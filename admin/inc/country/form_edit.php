			<form class="edit-form" method="post" action="edit_record.php?type=countries&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="full-name">Full Name:</label>
						<input type="text" name="full-name" placeholder="Full Name" id="full-name" value="<?php echo $full_name; ?>">
						<br>
						<label for="display-name">Display Name:</label>
						<input type="text" name="display-name" placeholder="Display Name" id="display-name" value="<?php echo $display_name; ?>">
						<br>
						<label for="abbreviation">Abbreviation:</label>
						<input type="text" name="abbreviation" placeholder="Abbreviation" id="abbreviation" value="<?php echo $abbreviation; ?>">
						<br>
						<label for="successor-to">Successor To:</label>
						<select id="successor-to" name="successor-to">
						<?php
							echo'<option label=" "></option>';
							$countries = "SELECT * FROM countries WHERE affiliated = true OR defunct = true ORDER BY display_name";
							$country_query = $connectDB->query($countries);
							while ($dataRows = $country_query->fetch()) {
								$country_name = $dataRows["display_name"];
								$country_abbreviation = $dataRows["abbreviation"];
								echo '<option ';
								if ($dataRows["abbreviation"] == $successor_to) {
									echo 'selected ';
								}
								echo 'value="'.$dataRows["abbreviation"].'">'.$dataRows["display_name"].'</option>';
							}
						?>	
						</select>
						<br>
						<label for="continent">Continent:</label>
						<select id="continent" name="continent">
						<?php
							$continents = "SELECT * FROM continents";
							$continent_query = $connectDB->query($continents);
							while ($dataRows = $continent_query->fetch()) {
								$continent_name = $dataRows["name"];
								echo '<option ';
								if ($dataRows["name"] == $continent) {
									echo 'selected ';
								}
								echo 'value="'.$dataRows["name"].'">'.$dataRows["name"].'</option>';
							}
						?>	
						</select>
						<br><br>
						<label for="active">Active:</label>
						<input type="checkbox" name="active" id="active" <?php if ($active) { echo 'checked'; } ?>>
						<label for="defunct">Defunct:</label>
						<input type="checkbox" name="defunct" id="defunct" <?php if ($defunct) { echo 'checked'; } ?>>
						<label for="affiliated">Affiliated:</label>
						<input type="checkbox" name="affiliated" id="affiliated" <?php if ($affiliated) { echo 'checked'; } ?>>
				
					</div>
						
				</div>
				
				<br>
				<label for="profile">Profile:</label>
				<textarea class="editable-area" rows="10" cols="35" name="profile"><?php echo $profile; ?></textarea>
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
		</form>
