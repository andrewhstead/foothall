			<form class="edit-form" method="post" action="edit_record.php?type=people&code=<?php echo $record_id; ?>">
		
				<label for="person-name">Display Name:</label>
				<input type="text" name="person-name" placeholder="Name to Display" id="person-name" value="<?php echo $name; ?>">
				<br>
				<label for="full-name">Full Name:</label>
				<input type="text" name="full-name" placeholder="Full Name" id="full-name" value="<?php echo $full_name; ?>">
				<br>
				<label for="file-code">File Code:</label>
				<input type="text" name="file-code" placeholder="File Code" id="file-code" value="<?php echo $file_code; ?>">
				<br>
				<label for="picture-credit">Picture Credit:</label>
				<input type="text" name="picture-credit" placeholder="Picture Credit" id="picture-credit" value="<?php echo $picture_credit; ?>">
				<br><br>
				<label for="admitted">Admitted?</label>
				<input type="checkbox" name="admitted" id="admitted" <?php if ($admitted) { echo 'checked'; } ?>>
				<br>
				<label for="admission-date">Admission Date:</label>
				<input type="date" name="admission-date" placeholder="DD-MM-YYYY" id="admission-date" value="<?php echo $admission_date; ?>">
				<br>
				<label for="admission-poll">Admission Poll:</label>
				<input type="text" name="admission-poll" placeholder="Admitted in Poll..." id="admission-poll" value="<?php echo $admission_poll; ?>">
				<br>Admitted As: 
				<label for="as-player">Player</label>
				<input type="checkbox" name="as-player" id="as-player" <?php if ($as_player) { echo 'checked'; } ?>>
				<label for="as-coach">Coach</label>
				<input type="checkbox" name="as-coach" id="as-coach" <?php if ($as_coach) { echo 'checked'; } ?>>
				<br><br>
				<label for="score">Total Rating Score:</label>
				<input type="text" name="score" placeholder="Total Rating Score..." id="score" value="<?php echo $score; ?>">
				<br>
				<label for="votes">Rating Votes:</label>
				<input type="text" name="votes" placeholder="Rating Votes..." id="votes" value="<?php echo $votes; ?>">
				<br>
				<label for="rating">Average Rating:</label>
				<input type="text" name="rating" placeholder="Average Rating..." id="rating" value="<?php echo $rating; ?>">
				<br><br>
				<label for="birth-date">Date of Birth:</label>
				<input type="date" name="birth-date" placeholder="DD-MM-YYYY" id="birth-date" value="<?php echo $date_of_birth; ?>">
				<br>
				<label for="birth-place">Place of Birth:</label>
				<input type="text" name="birth-place" placeholder="Place of Birth" id="birth-place" value="<?php echo $place_of_birth; ?>">
				<br>
				<label for="birth-country">Country of Birth:</label>
				<input type="text" name="birth-country" placeholder="Country of Birth" id="birth-country" value="<?php echo $country_of_birth; ?>">
				<br>
				<label for="nationality">Nationality:</label>
				<select id="nationality" name="nationality">
				<?php
					$countries = "SELECT * FROM countries WHERE affiliated = true OR defunct = true ORDER BY display_name";
					$country_query = $connectDB->query($countries);
					while ($dataRows = $country_query->fetch()) {
						$country_name = $dataRows["display_name"];
						$country_abbreviation = $dataRows["abbreviation"];
						echo '<option ';
						if ($dataRows["abbreviation"] == $nationality) {
							echo 'selected ';
						}
						echo 'value="'.$dataRows["abbreviation"].'">'.$dataRows["display_name"].'</option>';
					}
				?>	
				</select>
				<br>
				<label for="position">Position:</label>
				<input type="text" name="position" placeholder="Position" id="position" value="<?php echo $position; ?>">
				<br><br>
				<label for="is-living">Living?</label>
				<input type="checkbox" name="is-living" id="is-living" <?php if ($living) { echo 'checked'; } ?>>
				<br>
				<label for="death-date">Date of Death:</label>
				<input type="date" name="death-date" placeholder="DD-MM-YYYY" id="death-date" value="<?php echo $date_of_death; ?>">
				<br><br>
				<label for="intro-text">Introductory Text:</label>
				<textarea class="editable-area" rows="5" cols="35" name="intro-text"><?php echo $intro_text; ?></textarea>
				<br>
				<label for="biography">Biography:</label>
				<textarea class="editable-area" rows="10" cols="35" name="biography"><?php echo $biography; ?></textarea>
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
		</form>
