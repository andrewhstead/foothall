			<form class="edit-form" method="post" action="edit_record.php?type=alternative_names&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="name">Name:</label>
						<input type="text" name="name" placeholder="Name" id="name" value="<?php echo $name; ?>">
					
					</div>
					
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>
