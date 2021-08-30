			<form class="edit-form" method="post" action="edit_record.php?type=dream_teams&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="name">Name:</label>
						<input type="text" name="name" placeholder="Title" id="Name" value="<?php echo $name; ?>">
						<br>
						<label for="scope">Scope:</label>
						<select id="scope" name="scope">
							<option value="global" <?php if ($scope == 'global') { echo 'selected'; } ?>>Global</option>
							<option value="regional" <?php if ($scope == 'regional') { echo 'selected'; } ?>>Regional</option>
							<option value="national" <?php if ($scope == 'national') { echo 'selected'; } ?>>National</option>
						</select>
						<br>
						<label for="published">Published:</label>
						<input type="datetime-local" name="published" placeholder="Published" id="published" value="<?php echo $published; ?>">
						
						<br><br>
						Formation:
						<label for="df">DF:</label>
						<input type="text" name="df" id="df" size="1" value="<?php echo $df; ?>">
						<label for="mf">MF:</label>
						<input type="text" name="mf" id="mf" size="1" value="<?php echo $mf; ?>">
						<label for="fw">FW:</label>
						<input type="text" name="fw" id="fw" size="1" value="<?php echo $fw; ?>">
						<label for="sub">Subs:</label>
						<input type="text" name="sub" id="sub" size="1" value="<?php echo $sub; ?>">
						
						<br><br>
						<label for="active">Active:</label>
						<input type="radio" name="status" id="active" value="active" <?php if ($active) { echo 'checked'; } ?>>
						<label for="inactive">Inactive:</label>
						<input type="radio" name="status" id="inactive" value="inactive" <?php if (!$active) { echo 'checked'; } ?>>
				
					</div>
						
				</div>
				
				<br>		
				<label for="intro-text">Introductory Text:</label>
				<textarea class="editable-area" rows="5" cols="35" name="intro-text"><?php echo $intro_text; ?></textarea>
				<br>
				<label for="profile">Profile:</label>
				<textarea class="editable-area" rows="10" cols="35" name="profile"><?php echo $profile; ?></textarea>
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>
