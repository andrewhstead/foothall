			<form class="edit-form" method="post" action="edit_record.php?type=stories&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="title">Title:</label>
						<input type="text" name="title" placeholder="Title" id="title" value="<?php echo $title; ?>">
						<br>
						<label for="category">Category:</label>
						<input type="text" name="category" placeholder="Category" id="category" value="<?php echo $category; ?>">
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
				<label for="content">Content:</label>
				<textarea class="editable-area" rows="10" cols="35" name="content"><?php echo $content; ?></textarea>
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>
