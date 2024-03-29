		<form class="edit-form" method="post" action="edit_record.php?type=polls&code=<?php echo $record_id; ?>">
		
			<div class="flex-wrapper">
					
				<div class="flex-item form-section">

					<label for="type">Type of Poll:</label>
					<select id="type" name="type">
						<option value="person" <?php if ($type == 'person') { echo 'selected'; } ?>>Person</option>
						<option value="match" <?php if ($type == 'match') { echo 'selected'; } ?>>Match</option>
						<option value="team" <?php if ($type == 'team') { echo 'selected'; } ?>>Team</option>
					</select>
					<br>
					<label for="title">Title:</label>
					<input type="text" name="title" placeholder="Title" size="25" id="title" value="<?php echo $title; ?>">
					<br>
					<label for="category">Category:</label>
					<input type="text" name="category" placeholder="Category" id="category" value="<?php echo $category; ?>">
					<br>
					<label for="options">Options:</label>
					<input type="text" name="options" placeholder="0" id="options" size="1" value="<?php echo $options; ?>">
					<label for="places">Places:</label>
					<input type="text" name="places" placeholder="0" id="places" size="1" value="<?php echo $places; ?>">
					
					<br><br>
					<label for="active">Active On Site:</label>
					<input type="checkbox" name="active" id="active" <?php if ($active) { echo 'checked'; } ?>>
					<label for="locked">Expired:</label>
					<input type="checkbox" name="locked" id="locked" <?php if ($locked) { echo 'checked'; } ?>>
					<br>
					<label for="expiry">Published:</label>
					<input type="datetime-local" name="published" id="published" value="<?php echo $published; ?>">
					<br>
					<label for="expiry">Modified:</label>
					<input type="datetime-local" name="modified" id="modified" value="<?php echo $modified; ?>">
					<br>
					<label for="expiry">Expiry:</label>
					<input type="datetime-local" name="expiry" id="expiry" value="<?php echo $expiry; ?>">
			
				</div>
				
			</div>
			
			<br>
			<label for="intro-text">Introductory Text:</label>
			<textarea class="editable-area" rows="5" cols="35" name="intro-text"><?php echo $intro_text; ?></textarea>
			<br>
			<label for="description">Description:</label>
			<textarea class="editable-area" rows="10" cols="35" name="description"><?php echo $description; ?></textarea>
			
			<br>
			Options:
			<br>
			<?php
				if ($type == 'person') {
					echo '<strong>NB: If a player is not listed, go to <a class="standard-link" href="add_new.php?type=people">Add New Person</a> before editing the poll.</strong>';
				} else if ($type == 'match') {
					echo '<strong>NB: If a match is not listed, go to <a class="standard-link" href="add_new.php?type=matches">Add New Match</a> before editing the poll.</strong>';
				} else if ($type == 'team') {
					echo '<strong>NB: If a team is not listed, go to <a class="standard-link" href="add_new.php?type=hall_teams">Add New Team</a> before editing the poll.</strong>';	
				}
			
			?>
					
			<br>
			
			<?php
			
				foreach ($poll_option AS $option_number => $option_name) {
					
					echo '<label for="option-'.$option_number.'">'.$option_number.': </label>';
					echo '<select id="option-'.$option_number.'" name="option-'.$option_number.'">';
					echo'<option label=" "></option>';
					if ($type == 'person') {
						$options_sql = "SELECT * FROM people ORDER BY file_code";
					} else if ($type == 'match') {
						$options_sql = "SELECT * FROM matches WHERE category != 'game' ORDER BY file_code";
					} else if ($type == 'team') {
						$options_sql = "SELECT * FROM hall_teams ORDER BY file_code";
					}					
					$options_query = $connectDB->query($options_sql);
					if ($type == 'person') {
						while ($dataRows = $options_query->fetch()) {
							echo '<option value="'.$dataRows["name"].'"';
							if ($dataRows["name"] == $option_name) {
								echo ' selected ';
							}	
							echo '>'.$dataRows["name"].'</option>';
						}
					} else {
						while ($dataRows = $options_query->fetch()) {
							echo '<option value="'.$dataRows["title"].'"';
							if ($dataRows["title"] == $option_name) {
								echo ' selected ';
							}	
							echo '>'.$dataRows["title"].'</option>';
						}					
					}					
					echo '</select>';
					echo '<br>';
					${'person_'.$option_number} = $option_name;
				
				}
				
			?>
			
			<br>
			<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
		</form>
