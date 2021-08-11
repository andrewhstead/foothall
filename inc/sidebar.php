		</div>
		
		<div class="sidebar">
			
			<h2>Rating Leaders: Players</h2>
			
				<?php
					$player_leaders = "
					SELECT 
						people.id AS player_id,
						people.name AS player_name,
						people.file_code AS file_code,
						people.nationality AS nationality,
						people.votes AS votes,
						people.rating AS rating,
						countries.display_name AS country 
					FROM people 
					INNER JOIN countries ON people.nationality = countries.abbreviation
					WHERE active = true AND as_player = true  
					ORDER BY rating DESC, votes DESC, file_code
					LIMIT 10";
					$player_leader_query = $connectDB->query($player_leaders);
					
					$result_count = "SELECT COUNT(*) FROM people WHERE active = true AND as_player = true";
					$results = $connectDB->query($result_count);
					$total_results = $results->fetchColumn();
					
					$position = 0;
					
					if ($total_results == 0) {
						echo '<div class="centre-text">No players elected yet.</div>';
					} else {
						
						echo '<table class="sidebar-table">';
						while ($dataRows = $player_leader_query->fetch()) {
						
							$position++;

							$player_id = $dataRows["player_id"];
							$player_name = $dataRows["player_name"];
							$nationality = $dataRows["nationality"];
							$rating = $dataRows["rating"];
							$country = $dataRows["country"];
							
							echo '<tr>';
							echo '<td><strong>'.$position.'.</strong></td>';
							echo '<td><img class="table-icon" src="img/flags/'.strtolower($nationality).'.png" alt="'.strtolower($country).'"> ';
							echo '<a class="sidebar-link" href="person.php?id='.$player_id.'">'.$player_name.'</a></td>';
							echo '<td>'.$rating.'</td>';
							echo '</tr>';

						}
						echo '</table>';
						
					}

				?>
			
			<hr>
			
			<h2>Current Polls</h2>
			
			<?php
			
				$polls = "SELECT * FROM polls ORDER BY expiry desc LIMIT 1";
				$poll_content = $connectDB->query($polls);

				$current = array();
				$expired = array();

				while ($dataRows = $poll_content->fetch()) {
					
					echo '<h3>'.htmlentities($dataRows["title"]).'</h3>';
					
					echo '<p>'.html_entity_decode($dataRows["intro_text"]).'</p>';
					
					echo '<p class="sidebar-button"><a class="sidebar-poll button-link" href="poll.php?id=';
					echo $dataRows["id"];
					echo '">View Poll</a></p>';
					
				}
	
			?>
			
			<hr>
			
			<h2>Anniversaries</h2>
			
			<?php
			
				$month = date('m');
				$day = date('d');
			
				$anniversaries = "SELECT * FROM people WHERE ((MONTH(date_of_birth) = $month AND DAY(date_of_birth) = $day) OR (MONTH(date_of_death) = $month AND DAY(date_of_death) = $day) AND active = true)";
				$anniversary_content = $connectDB->query($anniversaries);

				$births_list = array();
				$deaths_list = array();

				while ($dataRows = $anniversary_content->fetch()) {
					
					$date_of_birth = new DateTime($dataRows["date_of_birth"]);
					$birth_year = $date_of_birth->format('Y');
					$birth_month = $date_of_birth->format('m');
					$birth_day = $date_of_birth->format('d');
					
					$date_of_death = new DateTime($dataRows["date_of_death"]);
					$death_year = $date_of_death->format('Y');
					$death_month = $date_of_death->format('m');
					$death_day = $date_of_death->format('d');
					
					if ($birth_month == $month AND $birth_day == $day) {
						$births_list[] = $dataRows;
					} else if ($death_month == $month AND $death_day == $day) {
						$deaths_list[] = $dataRows;
					}
									
				}
				
				if (empty($births_list) AND empty($deaths_list)) {
					
					echo '<div class="anniversaries">';
					echo '<div class="centre-text"><p>None on this date.</p></div>';
					echo '</div>';
					
				} else {
					
					if (!empty($births_list)) {
						echo '<div class="anniversaries">';
						echo '<h3>Born on This Day</h3><p>';
						foreach ($births_list as $birth_person) {
							echo '<td><img class="table-icon" src="img/flags/'.strtolower($birth_person["nationality"]).'.png" alt="'.strtolower($birth_person["nationality"]).'"> ';
							echo '<a class="sidebar-link" href="person.php?id='.$birth_person["id"].'">'.$birth_person["name"].'</a>';
							$display_year = (int)$birth_person["date_of_birth"];
							echo ' ('.$display_year.')';	
						}
						echo '</p></div>';
					}
						
					if (!empty($deaths_list)) {
						echo '<div class="anniversaries">';
						echo '<h3>Died on This Day</h3><p>';
						foreach ($deaths_list as $death_person) {
							echo '<td><img class="table-icon" src="img/flags/'.strtolower($death_person["nationality"]).'.png" alt="'.strtolower($death_person["nationality"]).'"> ';
							echo '<a class="sidebar-link" href="person.php?id='.$death_person["id"].'">'.$death_person["name"].'</a>';
							$display_year = (int)$death_person["date_of_death"];
							echo ' ('.$display_year.')';	
						}
						echo '</p></div>';
					}
					
				}	
				
			
			?>
			
			<hr>
			
		</div>
