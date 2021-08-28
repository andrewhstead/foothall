			<form class="edit-form" method="post" action="add_new.php?type=stories">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="title">Title:</label>
						<input type="text" name="title" placeholder="Title" id="title">
						<br>
						<label for="category">Category:</label>
						<input type="text" name="category" placeholder="Category" id="category">
						<br>
						<label for="published">Published:</label>
						<input type="datetime-local" name="published" placeholder="Published" id="published">
						<br><br>
						<label for="active">Active:</label>
						<input type="radio" name="status" id="active" value="active">
						<label for="admitted">Inactive:</label>
						<input type="radio" name="status" id="inactive" value="inactive">
				
					</div>
						
				</div>
				
				<br>		
				<label for="intro-text">Introductory Text:</label>
				<textarea class="editable-area" rows="5" cols="35" name="intro-text"></textarea>
				<br>
				<label for="content">Content:</label>
				<textarea class="editable-area" rows="10" cols="35" name="content"></textarea>
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>	
