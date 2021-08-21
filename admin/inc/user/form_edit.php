			<form class="edit-form" method="post" action="edit_record.php?type=users&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="username">User Name:</label>
						<input type="text" name="username" placeholder="User Name" id="username" value="<?php echo $username; ?>">
						<br>
						<label for="current-password">Current Password:</label>
						<input type="password" name="current-password" placeholder="Current Password" id="current-password">
						<br>
						<label for="new-password">New Password:</label>
						<input type="password" name="new-password" placeholder="New Password" id="new-password">
						<br>
						<label for="confirm-password">Confirm Password:</label>
						<input type="password" name="confirm-password" placeholder="Confirm Password" id="confirm-password">
						
					</div>
					
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>
