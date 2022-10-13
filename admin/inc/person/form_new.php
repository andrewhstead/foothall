			<form class="edit-form" method="post" action="add_new.php?type=people">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
				
						<label for="person-name">Display Name:</label>
						<input type="text" name="person-name" placeholder="Name to Display" id="person-name">
						<br>
						<label for="full-name">Full Name:</label>
						<input type="text" name="full-name" placeholder="Full Name" id="full-name" >
						<br>
						<label for="file-code">File Code:</label>
						<input type="text" name="file-code" placeholder="File Code" id="file-code">
						<br>
						<label for="picture-credit">Picture Credit:</label>
						<input type="text" name="picture-credit" placeholder="Picture Credit" id="picture-credit">
						<br>
						<label for="license-link">License Link:</label>
						<input type="text" name="license-link" placeholder="License Link" id="license-link">
						<br><br>
						<label for="admitted">Admitted:</label>
						<input type="radio" name="status" id="admitted" value="admitted">
						<label for="contender">Contender:</label>
						<input type="radio" name="status" id="contender" value="contender">
						<label for="inactive">Inactive:</label>
						<input type="radio" name="status" id="inactive" value="inactive">
						<br>
						<label for="admission-date">Admission Date:</label>
						<input type="date" name="admission-date" placeholder="DD-MM-YYYY" id="admission-date">
						<br>
						<label for="admission-poll">Admission Poll:</label>
						<input type="text" name="admission-poll" placeholder="Admitted in Poll..." id="admission-poll">
						<br>Eligible As:
						<label for="as-player">Player?</label>
						<input type="checkbox" name="as-player" id="as-player">
						<label for="as-coach">Coach?</label>
						<input type="checkbox" name="as-coach" id="as-coach">
						<br><br>
						<label for="score">Total Rating Score:</label>
						<input type="text" name="score" placeholder="Total Rating Score..." id="score" value="0">
						<br>
						<label for="votes">Rating Votes:</label>
						<input type="text" name="votes" placeholder="Rating Votes..." id="votes" value="0">
						<br>
						<label for="rating">Average Rating:</label>
						<input type="text" name="rating" placeholder="Average Rating..." id="rating" value="0.00">
					.
					</div>
					
					<div class="flex-item form-section">
						
						<label for="birth-date">Date of Birth:</label>
						<input type="date" name="birth-date" placeholder="DD-MM-YYYY" id="birth-date">
						<br>
						<label for="birth-place">Place of Birth:</label>
						<input type="text" name="birth-place" placeholder="Place of Birth" id="birth-place">
						<br>
						<label for="birth-country">Country of Birth:</label>
						<input type="text" name="birth-country" placeholder="Country of Birth" id="birth-country">
						<br>
						<label for="nationality">Nationality:</label>
						<select id="nationality" name="nationality">
						<?php
							$countries = "SELECT * FROM countries WHERE affiliated = true OR defunct = true ORDER BY display_name";
							$country_query = $connectDB->query($countries);
							while ($dataRows = $country_query->fetch()) {
								$country_name = $dataRows["display_name"];
								$country_abbreviation = $dataRows["abbreviation"];
								echo '<option value="'.$dataRows["abbreviation"].'">'.$dataRows["display_name"].'</option>';
							}
						?>	
						</select>
						<br>
						<label for="position">Position:</label>
						<input type="text" name="position" placeholder="Position" id="position">
						<br><br>
						<label for="is-living">Living?</label>
						<input type="checkbox" name="is-living" id="is-living">
						<br>
						<label for="death-date">Date of Death:</label>
						<input type="date" name="death-date" placeholder="DD-MM-YYYY" id="death-date">
						
					</div>	
						
				</div>		
				
				<br>		
				<label for="intro-text">Introductory Text:</label>
				<textarea class="editable-area" rows="5" cols="35" name="intro-text"></textarea>
				<br>
				<label for="biography">Biography:</label>
				<textarea class="editable-area" rows="10" cols="35" name="biography"></textarea>
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save and Close">
				<input class="submit-button" type="submit" name="submit" value="Save and Add Another">
			
			</form>	
