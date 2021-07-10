<?php
	$thispage = "Dream Team Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
				
	$connectDB;

	$dream = "SELECT * FROM dream_teams WHERE on_site = true ORDER BY type, name";
	$dream_query = $connectDB->query($dream);
	
	$dream_list = array();
	$type_list = array();
	
	while ($dataRows = $dream_query->fetch()) {

		$id = $dataRows["id"];
		$name = $dataRows["name"];
		$type = $dataRows["type"];
		$profile = $dataRows["profile"];
		
		$dream_list[] = $dataRows;
		
		if (!in_array($type, $type_list)) {
			$type_list[] = $type;
		}
		
	}
	
?>

	<div class="page-template">
		
		<h1>
			Dream Teams
		</h1>
		
		<?php
		
			if (!$dream_list) {
				echo "<h2>Dream Teams will appear here when added to the site.</h2>";
			}
					
			foreach ($type_list as $type_head) {
					
				echo '<div class="sub-menu">';
					
				echo '<h2>'.ucfirst($type_head).' Teams</h2>';
					
				echo '<div class="flex-wrapper">';
			
				foreach ($dream_list as $dream_menu) if ($dream_menu["type"] == $type_head) {
						
					echo '<div class="flex-item">';
					echo '&#9654; <a class="standard-link" href="dream.php?id='.$dream_menu["id"].'">'.$dream_menu["name"].'</a>';
					echo '</div>';
						
				}
					
				echo '</div>';
				echo '</div>';
					
			}
			
		?>
	
	</div>	
	
<?php

	include 'inc/footer.html';
	
?>
