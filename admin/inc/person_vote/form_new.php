			<form class="edit-form" method="post" action="add_new.php?type=people_votes">
				
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
							$people = "SELECT * FROM people WHERE as_player = true ORDER BY file_code";
							$people_query = $connectDB->query($people);
							while ($dataRows = $people_query->fetch()) {
								$person_name = $dataRows["name"];
								echo '<option value="'.$dataRows["name"].'">'.$dataRows["name"].'</option>';
							}
						?>	
						</select>
				
					</div>
						
				</div>
				
				<br>
				<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
			</form>	
