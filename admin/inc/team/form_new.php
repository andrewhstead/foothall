		<form class="edit-form" method="post" action="add_new.php?type=hall_teams">
				
			<div class="flex-wrapper">
					
				<div class="flex-item form-section">

					<label for="team-type">Team Type:</label>
					<select id="team-type" name="team-type">
						<option value="club">Club</option>
						<option value="national">National</option>
					</select>
					<br>
					<label for="title">Title:</label>
					<input type="text" name="title" placeholder="Title" id="title">
					<br>
					<label for="display-name">Display Name:</label>
					<input type="text" name="display-name" placeholder="Display Name" id="display-name">
					<br>
					<label for="team-name">Team Name:</label>
					<select id="team-name" name="team-name">
					<?php
						$teams_sql = "SELECT * FROM teams ORDER BY type, gender desc, display_name";
						$teams_query = $connectDB->query($teams_sql);
						while ($dataRows = $teams_query->fetch()) {
							$team_name = $dataRows["name"];
							echo '<option value="'.$dataRows["name"].'">'.$dataRows["name"].'</option>';
						}
					?>	
					</select>
					<br>
					<label for="era">Era:</label>
					<input type="text" name="era" placeholder="Era" id="era">
					<br>
					<label for="file-code">File Code:</label>
					<input type="text" name="file-code" placeholder="File Code" id="file-code">
					<br><br>
					<label for="picture-credit">Picture Credit:</label>
					<input type="text" name="picture-credit" placeholder="Picture Credit" id="picture-credit">
					<br>
					<label for="license-link">License Link:</label>
					<input type="text" name="license-link" placeholder="License Link" id="license-link">
					
				</div>	
					
				<div class="flex-item form-section">
					
					<label for="active">Admitted:</label>
					<input type="radio" name="status" id="active" value="active">
					<label for="contender">Contender:</label>
					<input type="radio" name="status" id="contender" value="contender">
					<label for="admitted">Inactive:</label>
					<input type="radio" name="status" id="inactive" value="inactive">
					<br>
					<label for="admission-date">Admission Date:</label>
					<input type="date" name="admission-date" placeholder="DD-MM-YYYY" id="admission-date">
					<br>
					<label for="admission-poll">Admission Poll:</label>
					<input type="text" name="admission-poll" placeholder="Admitted in Poll..." id="admission-poll">
					
					<br><br>
				
					<label for="score">Total Rating Score:</label>
					<input type="text" name="score" placeholder="Total Rating Score..." id="score" value="0">
					<br>
					<label for="votes">Rating Votes:</label>
					<input type="text" name="votes" placeholder="Rating Votes..." id="votes" value="0">
					<br>
					<label for="rating">Average Rating:</label>
					<input type="text" name="rating" placeholder="Average Rating..." id="rating" value="0.00">
					
				</div>
				
			</div>
			
			<br>		
			<label for="intro-text">Introductory Text:</label>
			<textarea class="editable-area" rows="5" cols="35" name="intro-text"></textarea>
			<br>
			<label for="biography">Biography:</label>
			<textarea class="editable-area" rows="10" cols="35" name="biography"></textarea>
			<br>
			<input class="submit-button" type="submit" name="submit" value="Add Record">
			
		</form>
