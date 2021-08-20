			<form class="edit-form" method="post" action="edit_record.php?type=positions&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="name">Name:</label>
						<input type="text" name="name" placeholder="Name" id="name" value="<?php echo $name; ?>">
						<br>
						<label for="type">Type:</label>
						<input type="text" name="type" placeholder="Type" id="type" value="<?php echo $type; ?>">
						<br>
						<label for="description">Description:</label>
						<input type="text" name="description" placeholder="Description" id="description" value="<?php echo $description; ?>">
						
					</div>
					
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>
