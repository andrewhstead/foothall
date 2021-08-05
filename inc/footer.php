		</div>
		
		<div class="sidebar">
			
			<h2>FootHall Leaders</h2>
			
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
						echo '<td><img class="table-icon" src="img/flags/'.strtolower($nationality).'.png" alt="'.strtolower($country).'"> '.$player_name.'</td>';
						echo '<td>'.$rating.'</td>';
						echo '</tr>';

					}
					
				?>
				
			</table>
			
		</div>
			
		</main>
		
		<script src="js/lightbox.js"></script>
		<script src="js/default.js"></script>
		
		<footer>
		
			&copy; <?php echo date("Y"); ?> The FootHall
		
		</footer>
		
	</body>

</html>
