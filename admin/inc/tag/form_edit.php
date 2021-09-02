			<form class="edit-form" method="post" action="edit_record.php?type=tag_list&code=<?php echo $record_id; ?>">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="table-name">Table Name:</label>
						<input type="text" name="table-name" placeholder="Table Name" id="table-name" value="<?php echo $table_name; ?>">
						<br>
						<label for="page-type">Page Type:</label>
						<input type="text" name="page-type" placeholder="Page Type" id="page-type" value="<?php echo $page_type; ?>">
						
					</div>
						
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
		</form>
