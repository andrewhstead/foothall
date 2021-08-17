		<form class="edit-form" method="post" action="add_new.php?type=matches">
				
			<div class="flex-wrapper">
					
				<div class="flex-item form-section">

					<label for="file-code">File Code:</label>
					<input type="text" name="file-code" placeholder="File Code" id="file-code"">
					<br>
					<label for="teams-type">Club/National:</label>
					<input type="text" name="teams-type" placeholder="Club or National?" id="teams-type"">
					<br><br>
					<label for="admitted">Admitted:</label>
					<input type="radio" name="status" id="admitted" value="admitted">
					<label for="contender">Contender:</label>
					<input type="radio" name="status" id="contender" value="contender">
					<label for="admitted">Inactive:</label>
					<input type="radio" name="status" id="inactive" value="inactive">
					<br>
					<label for="admission-date">Admission Date:</label>
					<input type="date" name="admission-date" placeholder="DD-MM-YYYY" id="admission-date"">
					<br>
					<label for="admission-poll">Admission Poll:</label>
					<input type="text" name="admission-poll" placeholder="Admitted in Poll..." id="admission-poll"">
					<br><br>
					<label for="score">Total Rating Score:</label>
					<input type="text" name="score" placeholder="Total Rating Score..." id="score">
					<br>
					<label for="votes">Rating Votes:</label>
					<input type="text" name="votes" placeholder="Rating Votes..." id="votes"">
					<br>
					<label for="rating">Average Rating:</label>
					<input type="text" name="rating" placeholder="Average Rating..." id="rating"">
				
				</div>	
					
				<div class="flex-item form-section">
					
					<label for="match-date">Date:</label>
					<input type="date" name="match-date" placeholder="DD-MM-YYYY" id="match-date"">
					<br>
					<label for="competition">Competition:</label>
					<select id="competition" name="competition">
					<?php
						$competitions = "SELECT * FROM competitions ORDER BY type desc, area, continent, name";
						$competition_query = $connectDB->query($competitions);
						while ($dataRows = $competition_query->fetch()) {
							$competition_name = $dataRows["name"];
							echo '<option value="'.$dataRows["name"].'">'.$dataRows["name"].'</option>';
						}
					?>	
					</select>
					<br>
					<label for="stage">Stage:</label>
					<input type="text" name="stage" placeholder="Stage" id="stage">
					<br><br>
					<label for="team-1">Team 1:</label>
					<input type="text" name="team-1" placeholder="Team Name" id="team-1">
					<br>
					<label for="score-1">Score:</label>
					<input type="text" name="score-1" placeholder="0" id="score-1" size="1">
					<br>
					<label for="team-2">Team 2:</label>
					<input type="text" name="team-2" placeholder="Team Name" id="team-2">
					<br>
					<label for="score-2">Score:</label>
					<input type="text" name="score-2" placeholder="0" id="score-2" size="1">
				
				</div>
				
			</div>	
				
			<br>
			<label for="intro-text">Introductory Text:</label>
			<textarea class="editable-area" rows="5" cols="35" name="intro-text"></textarea>
			<br>
			<label for="match-report">Match Report:</label>
			<textarea class="editable-area" rows="10" cols="35" name="match-report"></textarea>
			<br>
			<input class="submit-button" type="submit" name="submit" value="Save Changes">
			
		</form>
