		</div>
		
		<div class="sidebar">
			
			<h2>Rating Leaders: Players</h2>
			
				<?php
					$leaders = "
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
					$leader_query = $connectDB->query($leaders);
					
					$result_count = "SELECT COUNT(*) FROM people WHERE active = true AND as_player = true";
					$results = $connectDB->query($result_count);
					$total_results = $results->fetchColumn();
					
					$position = 0;
					
					if ($total_results == 0) {
						echo '<div class="centre-text">No players elected yet.</div>';
					} else {
						
						echo '<table class="sidebar-table">';
						while ($dataRows = $leader_query->fetch()) {
						
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
			
		</div>
