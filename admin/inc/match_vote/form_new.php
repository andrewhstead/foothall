			<form class="edit-form" method="post" action="add_new.php?type=match_votes">
				
				<div class="flex-wrapper">
					
					<div class="flex-item form-section">
						
						<label for="poll">Poll:</label>
						<select id="poll" name="poll">
						<?php
							$poll = "SELECT * FROM polls ORDER BY id";
							$poll_query = $connectDB->query($poll);
							while ($dataRows = $poll_query->fetch()) {
								$poll_title = $dataRows["title"];
								echo '<option value="'.$dataRows["id"].'">'.$dataRows["title"].'</option>';
							}
						?>	
						</select>
						<br>
						<label for="option">Option:</label>
						<select id="option" name="option">
						<?php
							$matches = "SELECT * FROM matches ORDER BY file_code";
							$match_query = $connectDB->query($matches);
							while ($dataRows = $match_query->fetch()) {
								$match_title = $dataRows["title"];
								echo '<option value="'.$dataRows["title"].'">'.$dataRows["title"].'</option>';
							}
						?>	
						</select>
				
					</div>
						
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>	
