			<form class="edit-form" method="post" action="edit_record.php?type=competitions&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="name">Name:</label>
						<input type="text" name="name" placeholder="Name" id="name" value="<?php echo $name; ?>">
						<br>
						<label for="abbreviation">Abbreviation:</label>
						<input type="text" name="abbreviation" placeholder="Abbreviation" id="abbreviation" value="<?php echo $abbreviation; ?>">
						<br>
						<label for="type">Type:</label>
						<select id="type" name="type">
							<option value="club" <?php if ($type == 'club') { echo 'selected'; } ?>>Club</option>
							<option value="international" <?php if ($type == 'international') { echo 'selected'; } ?>>International</option>
						</select>
						<br>
						<label for="male">Male:</label>
						<input type="radio" name="gender" id="male" value="male" <?php if ($gender == 'm') { echo 'checked'; } ?>>
						<label for="female">Female:</label>
						<input type="radio" name="gender" id="female" value="female" <?php if ($gender == 'f') { echo 'checked'; } ?>>
				
					</div>
					
					<div class="flex-item form-section">
						
						<label for="area">Area:</label>
						<select id="area" name="area">
							<option value="global" <?php if ($area == 'global') { echo 'selected'; } ?>>Global</option>
							<option value="regional" <?php if ($area == 'regional') { echo 'selected'; } ?>>Regional</option>
							<option value="national" <?php if ($area == 'national') { echo 'selected'; } ?>>National</option>
						</select>
						<br>
						<label for="continent">Continent:</label>
						<select id="continent" name="continent">
						<?php
							echo'<option label=" "></option>';
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
								if ($dataRows["display_name"] == $country) {
									echo 'selected ';
								}
								echo 'value="'.$dataRows["display_name"].'">'.$dataRows["display_name"].'</option>';
							}
						?>	
						</select>
						<br><br>
						<label for="active">Active On Site:</label>
						<input type="checkbox" name="active" id="active" <?php if ($active) { echo 'checked'; } ?>>
						<label for="current">Current:</label>
						<input type="checkbox" name="current" id="current"<?php if ($current) { echo 'checked'; } ?>>
				
					</div>
						
				</div>
				
				<br>
				<label for="profile">Profile:</label>
				<textarea class="editable-area" rows="10" cols="35" name="profile"><?php echo $profile; ?></textarea>
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
				
		</form>
		
		<br>
		Tournaments for this competition (click to edit):
		<br>
		<?php
			$tournaments = "SELECT * FROM tournaments WHERE competition = '$record_id'";
			$tournament_count = "SELECT COUNT(*) FROM tournaments WHERE competition = '$record_id'";
					
			$iteration = 0;
			
			$tournament_query = $connectDB->query($tournaments);
			$result_count = $connectDB->query($tournament_count);
			
			$total_results = $result_count->fetchColumn();
			
			while ($dataRows = $tournament_query->fetch()) {
				
				$database_id = $dataRows["id"];
				$year = $dataRows["year"];	
				
				echo '<a class="standard-link" href="edit_record.php?type=tournaments&code='.$database_id.'">';
				echo $year;	
				echo '</a>';
				
				$iteration++;
						
				if ($iteration < $total_results) {
					echo ' | ';
				}
				
			}	
		?>	
		
