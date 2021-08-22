			<form class="edit-form" method="post" action="edit_record.php?type=news&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="headline">Headline:</label>
						<input type="text" name="headline" placeholder="Headline" id="headline" value="<?php echo $headline; ?>">
						<br>
						<label for="published">Published:</label>
						<input type="datetime-local" name="published" placeholder="Published" id="published" value="<?php echo $published; ?>">
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
				<label for="text">Text:</label>
				<textarea class="editable-area" rows="10" cols="35" name="text"><?php echo $text; ?></textarea>
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
		</form>
