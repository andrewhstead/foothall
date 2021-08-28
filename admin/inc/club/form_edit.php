		<form class="edit-form" method="post" action="edit_record.php?type=teams&code=<?php echo $record_id; ?>">
		
			<div class="flex-wrapper">
					
				<div class="flex-item form-section">
					
					<label for="type">Club/National:</label>
					<select id="type" name="type">
						<option value="club" <?php if ($type == 'club') { echo 'selected'; } ?>>Club</option>
						<option value="national" <?php if ($type == 'national') { echo 'selected'; } ?>>National</option>
					</select>
					<br>
					<label for="gender">Men/Women:</label>
					<select id="gender" name="gender">
						<option value="m" <?php if ($gender == 'm') { echo 'selected'; } ?>>Men</option>
						<option value="f" <?php if ($gender == 'f') { echo 'selected'; } ?>>Women</option>
					</select>
					<br>
					<label for="country">Country:</label>
					<select id="country" name="country">
					<?php
						echo'<option label=" "></option>';
						$countries = "SELECT * FROM countries WHERE affiliated = true OR defunct = true ORDER BY display_name";
						$country_query = $connectDB->query($countries);
						while ($dataRows = $country_query->fetch()) {
							$country_name = $dataRows["display_name"];
							$country_abbreviation = $dataRows["display_name"];
							echo '<option ';
							if ($dataRows["abbreviation"] == $country) {
								echo 'selected ';
							}
							echo 'value="'.$dataRows["abbreviation"].'">'.$dataRows["display_name"].'</option>';
						}
					?>	
					</select>
					
					<br><br>
					<label for="active">Active:</label>
					<input type="radio" name="status" id="active" value="active" <?php if ($active) { echo 'checked'; } ?>>
					<label for="inactive">Inactive:</label>
					<input type="radio" name="status" id="inactive" value="inactive" <?php if (!$active) { echo 'checked'; } ?>>
				
				</div>	
					
				<div class="flex-item form-section">
					
					<label for="full-name">Full Name:</label>
					<input type="text" name="full-name" placeholder="Full Name" id="full-name" value="<?php echo $name; ?>">
					<br>
					<label for="display-name">Display Name:</label>
					<input type="text" name="display-name" placeholder="Display Name" id="display-name" value="<?php echo $display_name; ?>">
					<br>
					<label for="abbreviation">Abbreviation:</label>
					<input type="text" name="abbreviation" placeholder="Abbreviation" id="abbreviation" value="<?php echo $abbreviation; ?>">
					
				</div>
				
			</div>	
				
			<br>
			<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
		</form>
