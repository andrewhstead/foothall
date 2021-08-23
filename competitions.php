<?php
	$thispage = "Competition Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.php';

	$connectDB;
	
	$competitions = "
		SELECT * FROM competitions 
		WHERE active = true
		ORDER BY type desc, continent, area desc, country, gender desc";
	$competition_query = $connectDB->query($competitions);
	
	$competition_list = array();
	$competition_type = array();
	$competition_name = array();
	
	while ($dataRows = $competition_query->fetch()) {

		$id = $dataRows["id"];
		$name = $dataRows["name"];
		$type = $dataRows["type"];
		$continent = $dataRows["continent"];
		$country = $dataRows["country"];
		$gender = $dataRows["gender"];
	
		$competition_list[] = $dataRows;
		
		if (!in_array($type, $competition_type)) {
			$competition_type[] = $type;
		}
		if (!in_array($name, $competition_name)) {
			$competition_name[] = $name;
		}
		
	}
	
?>

	<div class="page-template">
		
		<h1>
			Competitions
		</h1>
			
		<?php
		
			if (!$competition_list) {
				echo "<h2>Competitions will appear here when added to the site.</h2>";
			}
					
			foreach ($competition_type as $type_heading) {
				
				echo '<div class="sub-menu">';
				echo '<h2>';
				echo ucfirst($type_heading).' Competitions</h2>';
				
				echo '<div>';
			
				foreach ($competition_list as $list_competition) if ($list_competition["type"] == $type_heading) {
								
						echo '<div>';	
						echo '&#9654; <a class="standard-link" href="competition.php?id='.$list_competition["id"].'">'.$list_competition["name"].'</a>';
						echo '</div>';
							
					}
										
				echo '</div>';
		
				echo '</div>';
			
			}
			
		?>
		
	</div>

	
<?php

	include 'inc/footer.php';
	
?>
