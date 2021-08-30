			<form class="edit-form" method="post" action="add_new.php?type=dream_teams">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="name">Name:</label>
						<input type="text" name="name" placeholder="Name" id="name">
						<br>
						<label for="scope">Scope:</label>
						<select id="scope" name="scope">
							<option value="global">Global</option>
							<option value="regional">Regional</option>
							<option value="national">National</option>
						</select>
						<br>
						<label for="published">Published:</label>
						<input type="datetime-local" name="published" placeholder="Published" id="published">
						
						<br><br>
						Formation:
						<label for="df">DF:</label>
						<input type="text" name="df" id="df" size="1">
						<label for="mf">MF:</label>
						<input type="text" name="mf" id="mf" size="1">
						<label for="fw">FW:</label>
						<input type="text" name="fw" id="fw" size="1">
						<label for="sub">Subs:</label>
						<input type="text" name="sub" id="sub" size="1">
						
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
				<label for="profile">Profile:</label>
				<textarea class="editable-area" rows="10" cols="35" name="profile"></textarea>
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>	
