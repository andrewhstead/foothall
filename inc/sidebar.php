		</div>
		
		<div class="sidebar">
			
			<h2>Rating Leaders: Players</h2>
			
			<table>
			
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
					LIMIT 5";
					$leader_query = $connectDB->query($leaders);
					
					$position = 0;
					
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
					
				?>
				
			</table>
			
			<hr>
			
			<h2>Current Polls</h2>
			
			<?php
			
				$polls = "SELECT * FROM polls ORDER BY expiry desc";
				$poll_content = $connectDB->query($polls);

				$current = array();
				$expired = array();

				while ($dataRows = $poll_content->fetch()) {

					echo html_entity_decode($dataRows["intro_text"]);
					
					echo '<h3><a class="sidebar-link" href="poll.php?id=';
					echo $dataRows["id"];
					echo '">View Poll</a></h3>';
					
				}
	
			?>
			
			<hr>
			
		</div>
