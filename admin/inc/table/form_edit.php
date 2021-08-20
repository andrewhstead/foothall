			<form class="edit-form" method="post" action="edit_record.php?type=tables&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="table-name">Table Name:</label>
						<input type="text" name="table-name" placeholder="Table Name" id="table-name" value="<?php echo $table_name; ?>">
						<br>
						<label for="table-type">Table Type:</label>
						<input type="text" name="table-type" placeholder="Table Type" id="table-type" value="<?php echo $table_type; ?>">
						<br>
						<label for="importance">Importance:</label>
						<input type="text" name="importance" placeholder="Importance" id="importance" value="<?php echo $importance; ?>">
						
					</div>
					
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>
