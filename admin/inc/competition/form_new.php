			<form class="edit-form" method="post" action="add_new.php?type=competitions">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="name">Name:</label>
						<input type="text" name="name" placeholder="Name" id="name">
						<br>
						<label for="abbreviation">Abbreviation:</label>
						<input type="text" name="abbreviation" placeholder="Abbreviation" id="abbreviation">
						<br>
						<label for="type">Type:</label>
						<input type="text" name="type" placeholder="international/club" id="type">
						<br>
						<label for="male">Male:</label>
						<input type="radio" name="gender" id="male" value="male">
						<label for="female">Female:</label>
						<input type="radio" name="gender" id="female" value="female">
				
					</div>
					
					<div class="flex-item form-section">
						
						<label for="area">Area:</label>
						<input type="text" name="area" placeholder="world/regional/national" id="area">
						<br>
						<label for="continent">Continent:</label>
						<select id="continent" name="continent">
						<?php
							echo'<option label=" "></option>';
							$continents = "SELECT * FROM continents";
							$continent_query = $connectDB->query($continents);
							while ($dataRows = $continent_query->fetch()) {
								$continent_name = $dataRows["name"];
								echo '<option value="'.$dataRows["name"].'">'.$dataRows["name"].'</option>';
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
								echo '<option value="'.$dataRows["display_name"].'">'.$dataRows["display_name"].'</option>';
							}
						?>	
						</select>
						<br><br>
						<label for="active">Active On Site:</label>
						<input type="checkbox" name="active" id="active">
						<label for="current">Current:</label>
						<input type="checkbox" name="current" id="current">
				
					</div>
						
				</div>
				
				<br>
				<label for="profile">Profile:</label>
				<textarea class="editable-area" rows="10" cols="35" name="profile"></textarea>
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>	
