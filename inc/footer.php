		</div>
		
		<div class="sidebar">
			
			<h2>FootHall Leaders</h2>
			
			<?php
				$leaders = "
				SELECT 
					people.id AS player_id,
					people.name AS player_name,
					people.nationality AS nationality,
					countries.display_name AS country 
				FROM people 
				INNER JOIN countries ON people.nationality = countries.abbreviation
				WHERE active = true AND as_player = true  
				ORDER BY nationality, file_code
				LIMIT 5";
			$leader_query = $connectDB->query($leaders);
			
			$position = 0;
			
			while ($dataRows = $leader_query->fetch()) {
				
				$position++;

				$player_id = $dataRows["player_id"];
				$player_name = $dataRows["player_name"];
				$nationality = $dataRows["nationality"];
				$abbreviation = $dataRows["country"];
				
				echo '<strong>'.$position.'.</strong> '.$player_name.'<br>';

			}
			
		?>
				
		</div>
			
		</main>
		
		<script src="js/lightbox.js"></script>
		<script src="js/default.js"></script>
		
		<footer>
		
			&copy; <?php echo date("Y"); ?> The FootHall
		
		</footer>
		
	</body>

</html>
