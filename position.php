<?php
	$thispage = "Position Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
					
	if (isset($_GET["id"])) {
		$position_id = $_GET["id"];
	} else {
		$position_id = 1;
	}
						
	$connectDB;

?>

	<div class="page-template">
		
		<h1>Position Menu</h1>
		
		<?php 
			$position = "SELECT * FROM positions WHERE id = $position_id";
			$page_category = $connectDB->query($position);

			while ($dataRows = $page_category->fetch()) {

				$position_name = $dataRows["name"];
				echo '<h2>'.htmlentities($position_name).'</h2>';
				
			}

			$people = "
			SELECT 
				people.name AS person_name,
				people.id AS person_id,
				people.nationality AS nationality,
				people.active AS active
			FROM people
			INNER JOIN people_positions
				ON people_positions.person = people.name
			INNER JOIN positions
				ON positions.name = people_positions.position
			WHERE positions.id = $position_id 
				AND active = true";
			$page_content = $connectDB->query($people);

			while ($dataRows = $page_content->fetch()) {

				$person_id = $dataRows["person_id"];
				$person_name = $dataRows["person_name"];
				$nationality = $dataRows["nationality"];
				
				echo '<div class="flex-item">';	
				echo '<img class="table-icon" src="img/flags/'.strtolower($nationality).'.png" alt="'.strtolower($nationality).'"> ';
				echo '<a class="standard-link" href="person.php?id='.$person_id.'">'.$person_name.'</a>';
				echo '</div>';
				
			}
	
		?>
		
	</div>

	
<?php

	include 'inc/footer.php';
	
?>
