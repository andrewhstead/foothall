		<form class="edit-form" method="post" action="add_new.php?type=tournaments">
				
			<div class="flex-wrapper">
					
				<div class="flex-item form-section">

					<label for="competition">Competition:</label>
					<select id="competition" name="competition">
					<?php
						echo'<option label=" "></option>';
						$competitions_sql = "SELECT * FROM competitions ORDER BY type desc, area, gender desc, name";
						$competitions_query = $connectDB->query($competitions_sql);
						while ($dataRows = $competitions_query->fetch()) {
							$competition_name = $dataRows["name"];
							echo '<option value="'.$dataRows["id"].'">'.$dataRows["name"].'</option>';
						}
					?>	
					</select>
					<br>
					<label for="year">Year:</label>
					<input type="text" name="year" placeholder="YYYY" id="year">
					<br>
					<label for="name">Name:</label>
					<input type="text" name="name" placeholder="Unique Tournament Name" id="name">
					
					<br><br>
					<label for="active">Active On Site:</label>
					<input type="checkbox" name="active" id="active">
					<label for="completed">Completed:</label>
					<input type="checkbox" name="completed" id="completed">
						
					<br><br>
					Hosts (select up to four):
					<br>
					<label for="host">H1</label>
					<select id="host" name="host">
					<?php
						echo'<option label=" "></option>';
						$countries = "SELECT * FROM countries WHERE affiliated = true OR defunct = true ORDER BY display_name";
						$country_query = $connectDB->query($countries);
						while ($dataRows = $country_query->fetch()) {
							$country_name = $dataRows["display_name"];
							$country_abbreviation = $dataRows["abbreviation"];
							echo '<option value="'.$dataRows["abbreviation"].'">'.$dataRows["display_name"].'</option>';
						}
					?>	
					</select>
					<br>
					<label for="host-2">H2</label>
					<select id="host-2" name="host-2">
					<?php
						echo'<option label=" "></option>';
						$countries = "SELECT * FROM countries WHERE affiliated = true OR defunct = true ORDER BY display_name";
						$country_query = $connectDB->query($countries);
						while ($dataRows = $country_query->fetch()) {
							$country_name = $dataRows["display_name"];
							$country_abbreviation = $dataRows["abbreviation"];
							echo '<option value="'.$dataRows["abbreviation"].'">'.$dataRows["display_name"].'</option>';
						}
					?>	
					</select>
					<br>
					<label for="host-3">H3</label>
					<select id="host-3" name="host-3">
					<?php
						echo'<option label=" "></option>';
						$countries = "SELECT * FROM countries WHERE affiliated = true OR defunct = true ORDER BY display_name";
						$country_query = $connectDB->query($countries);
						while ($dataRows = $country_query->fetch()) {
							$country_name = $dataRows["display_name"];
							$country_abbreviation = $dataRows["abbreviation"];
							echo '<option value="'.$dataRows["abbreviation"].'">'.$dataRows["display_name"].'</option>';
						}
					?>	
					</select>
					<br>
					<label for="host-4">H4</label>
					<select id="host-4" name="host-4">
					<?php
						echo'<option label=" "></option>';
						$countries = "SELECT * FROM countries WHERE affiliated = true OR defunct = true ORDER BY display_name";
						$country_query = $connectDB->query($countries);
						while ($dataRows = $country_query->fetch()) {
							$country_name = $dataRows["display_name"];
							$country_abbreviation = $dataRows["abbreviation"];
							echo '<option value="'.$dataRows["abbreviation"].'">'.$dataRows["display_name"].'</option>';
						}
					?>	
					</select>
				
				</div>	
					
				<div class="flex-item form-section">
					
					<label for="teams">Teams:</label>
					<input type="text" name="teams" placeholder="Teams Competing" id="teams">
					<br>
					<label for="games">Games:</label>
					<input type="text" name="games" placeholder="Games Played" id="games">
					<br>
					<label for="goals">Goals:</label>
					<input type="text" name="goals" placeholder="Goals Scored" id="goals">
					<br><br>
					<label for="winner">Winner:</label>
					<select id="winner" name="winner">
					<?php
						echo'<option label=" "></option>';
						$teams = "SELECT * FROM teams ORDER BY name";
						$team_query = $connectDB->query($teams);
						while ($dataRows = $team_query->fetch()) {
							echo '<option value="'.$dataRows["name"].'">'.$dataRows["name"].'</option>';
						}
					?>	
					</select>
					<br>
					<label for="runner-up">Runner-Up:</label>
					<select id="runner-up" name="runner-up">
					<?php
						echo'<option label=" "></option>';
						$teams = "SELECT * FROM teams ORDER BY name";
						$team_query = $connectDB->query($teams);
						while ($dataRows = $team_query->fetch()) {
							echo '<option value="'.$dataRows["name"].'">'.$dataRows["name"].'</option>';
						}
					?>	
					</select>
					<br><br>
					<label for="top-scorer">Top Scorer:</label>
					<select id="top-scorer" name="top-scorer">
					<?php
						echo'<option label=" "></option>';
						$people = "SELECT * FROM people WHERE as_player = true ORDER BY file_code";
						$people_query = $connectDB->query($people);
						while ($dataRows = $people_query->fetch()) {
							$person_name = $dataRows["name"];
							echo '<option value="'.$dataRows["name"].'">'.$dataRows["name"].'</option>';
						}
					?>	
					</select>
					<br>
					<strong>NB: If player is not listed, go to <a class="standard-link" href="add_new.php?type=people">Add New Person</a> before creating tournament.</strong>
					<br>
					<label for="goals-top">Goals:</label>
					<input type="text" name="goals-top" placeholder="Goals Scored" id="goals-top">
					
				</div>
				
			</div>	
				
			<br>
			<label for="intro-text">Introductory Text:</label>
			<textarea class="editable-area" rows="5" cols="35" name="intro-text"></textarea>
			<br>
			<label for="review">Tournament Review:</label>
			<textarea class="editable-area" rows="10" cols="35" name="review"></textarea>
			<br>
			<input class="submit-button" type="submit" name="submit" value="Save and Finish">
			<!--<input class="submit-button" type="submit" name="submit" value="Save and Add Teams">-->
			
		</form>
