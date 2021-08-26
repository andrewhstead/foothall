		<form class="edit-form" method="post" action="add_new.php?type=matches">
				
			<div class="flex-wrapper">
					
				<div class="flex-item form-section">

					<label for="type">Type of Poll:</label>
					<select id="type" name="type">
						<option value="person">Person</option>
						<option value="match">Match</option>
						<option value="team">Team</option>
					</select>
					<br>
					<label for="title">Title:</label>
					<input type="text" name="title" placeholder="Title" id="title">
					<br>
					<label for="category">Category:</label>
					<input type="text" name="category" placeholder="Category" id="category">
					<br>
					<label for="options">Options:</label>
					<input type="text" name="options" placeholder="0" id="options" size="1">
					<label for="places">Places:</label>
					<input type="text" name="places" placeholder="0" id="places" size="1">
					
					<br><br>
					<label for="active">Active On Site:</label>
					<input type="checkbox" name="active" id="active">
					<label for="locked">Expired:</label>
					<input type="checkbox" name="locked" id="locked">
					<br>
					<label for="expiry">Expiry:</label>
					<input type="datetime-local" name="expiry" id="expiry">
				
				</div>
				
			</div>	
				
			<br>
			<label for="intro-text">Introductory Text:</label>
			<textarea class="editable-area" rows="5" cols="35" name="intro-text"></textarea>
			<br>
			<label for="description">Description:</label>
			<textarea class="editable-area" rows="10" cols="35" name="description"></textarea>
			<br>
			<input class="submit-button" type="submit" name="submit" value="Save and Finish">
			<input class="submit-button" type="submit" name="submit" value="Save and Add Options">
			
		</form>
