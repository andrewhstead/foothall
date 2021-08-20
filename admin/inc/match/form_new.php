		<form class="edit-form" method="post" action="add_new.php?type=matches">
				
			<div class="flex-wrapper">
					
				<div class="flex-item form-section">
					
					<?php
					
					?>

					<strong>NB: If either team is not listed, go to <a class="standard-link" href="add_new.php?type=teams">Add New Teams</a> before continuing.</strong>
					<br>
					<label for="team-1">Team 1:</label>
					<select id="team-1" name="team-1">
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
					<label for="team-2">Team 2:</label>
					<select id="team-2" name="team-2">
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
					<label for="teams-type">Club/National:</label>
					<input type="text" name="teams-type" placeholder="club/national" id="teams-type">
					
					<br><br>
					Score: 
					<label for="score-1">T1</label>
					<input type="text" name="score-1" placeholder="0" id="score-1" size="1">
					<label for="score-2">T2</label>
					<input type="text" name="score-2" placeholder="0" id="score-2" size="1">
					<br>
					<label for="extra-time">Extra Time?</label>
					<input type="checkbox" name="extra-time" id="extra-time">
					<label for="penalties">Penalties?</label>
					<input type="checkbox" name="penalties" id="penalties">
					<br>
					Penalties Score (if applicable): 
					<label for="score-1">T1</label>
					<input type="text" name="penalties-1" placeholder="0" id="penalties-1" size="1">
					<label for="score-2">T2</label>
					<input type="text" name="penalties-2" placeholder="0" id="penalties-2" size="1">
					
					<br><br>					
					<label for="match-date">Date:</label>
					<input type="date" name="match-date" placeholder="DD-MM-YYYY" id="match-date">
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
					<label for="tournament">Tournament:</label>
					<select id="tournament" name="tournament">
					<?php
						$tournaments = "SELECT * FROM tournaments ORDER BY competition, year";
						$tournament_query = $connectDB->query($tournaments);
						while ($dataRows = $tournament_query->fetch()) {
							$tournament_name = $dataRows["name"];
							echo '<option value="'.$dataRows["name"].'">'.$dataRows["name"].'</option>';
						}
					?>
					</select>
					<br>
					<label for="stage">Stage:</label>
					<input type="text" name="stage" placeholder="Stage" id="stage">
					<br>
					<label for="section">Section:</label>
					<input type="text" name="section" placeholder="Section" id="section">
					
					<br><br>
					<label for="file-code">File Code:</label>
					<input type="text" name="file-code" placeholder="File Code" id="file-code">
					<br>
					<label for="title">Title:</label>
					<input type="text" name="title" placeholder="Title" id="title">
				
				</div>	
					
				<div class="flex-item form-section">
					
					<label for="attendance">Attendance:</label>
					<input type="text" name="attendance" placeholder="Attendance" id="attendance">
					<br>
					<label for="stadium">Stadium:</label>
					<input type="text" name="stadium" placeholder="Stadium" id="stadium">
					<br>
					<label for="city">City:</label>
					<input type="text" name="city" placeholder="City" id="city">
					<br>
					<label for="country">Country:</label>
					<select id="country" name="country">
					<?php
						$countries = "SELECT * FROM countries WHERE affiliated = true OR defunct = true ORDER BY display_name";
						$country_query = $connectDB->query($countries);
						while ($dataRows = $country_query->fetch()) {
							$country_name = $dataRows["display_name"];
							$country_abbreviation = $dataRows["abbreviation"];
							echo '<option value="'.$dataRows["abbreviation"].'">'.$dataRows["display_name"].'</option>';
						}
					?>	
					</select>
					
					<br><br>
					<label for="referee">Referee:</label>
					<input type="text" name="referee" placeholder="Referee" id="referee">
					<br>
					<label for="nationality">Nationality:</label>
					<select id="nationality" name="nationality">
					<?php
						$countries = "SELECT * FROM countries WHERE affiliated = true OR defunct = true ORDER BY display_name";
						$country_query = $connectDB->query($countries);
						while ($dataRows = $country_query->fetch()) {
							$country_name = $dataRows["display_name"];
							$country_abbreviation = $dataRows["abbreviation"];
							echo '<option value="'.$dataRows["abbreviation"].'">'.$dataRows["display_name"].'</option>';
						}
					?>	
					</select>
					
					<br><br>
					<label for="admitted">Admitted:</label>
					<input type="radio" name="status" id="admitted" value="admitted">
					<label for="contender">Contender:</label>
					<input type="radio" name="status" id="contender" value="contender">
					<label for="admitted">Inactive:</label>
					<input type="radio" name="status" id="inactive" value="inactive" checked>
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
			<label for="match-report">Match Report:</label>
			<textarea class="editable-area" rows="10" cols="35" name="match-report"></textarea>
			<br>
			<input class="submit-button" type="submit" name="submit" value="Save and Finish">
			<input class="submit-button" type="submit" name="submit" value="Save and Add Lineups">
			<input class="submit-button" type="submit" name="submit" value="Save and Add Goals">
			
		</form>
