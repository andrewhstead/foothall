		<form class="edit-form" method="post" action="add_new.php?type=teams">
				
			<div class="flex-wrapper">
					
				<div class="flex-item form-section">

					<label for="type">Club/National:</label>
					<select id="type" name="type">
						<option value="club">Club</option>
						<option value="national">National</option>
					</select>
					<br>
					<label for="gender">Men/Women:</label>
					<select id="gender" name="gender">
						<option value="m">Men</option>
						<option value="f">Women</option>
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
							$country_abbreviation = $dataRows["abbreviation"];
							echo '<option value="'.$dataRows["abbreviation"].'">'.$dataRows["display_name"].'</option>';
						}
					?>	
					</select>
					
					<br><br>
					<label for="active">Active:</label>
					<input type="radio" name="status" id="active" value="active">
					<label for="admitted">Inactive:</label>
					<input type="radio" name="status" id="inactive" value="inactive">
				
				</div>	
					
				<div class="flex-item form-section">
					
					<label for="full-name">Full Name:</label>
					<input type="text" name="full-name" placeholder="Full Name" id="full-name">
					<br>
					<label for="display-name">Display Name:</label>
					<input type="text" name="display-name" placeholder="Display Name" id="display-name">
					<br>
					<label for="abbreviation">Abbreviation:</label>
					<input type="text" name="abbreviation" placeholder="Abbreviation" id="abbreviation">
					
				</div>
				
			</div>
			
			<br>
			<input class="submit-button" type="submit" name="submit" value="Add Record">
			
		</form>
