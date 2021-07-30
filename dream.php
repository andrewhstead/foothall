<?php
	$thispage = "Dream Team Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
				
	$connectDB;

	$dream = "SELECT * FROM dream_teams WHERE active = true ORDER BY type, name";
	$dream_query = $connectDB->query($dream);
	
	$dream_list = array();
	$scope_list = array();
	
	while ($dataRows = $dream_query->fetch()) {

		$id = $dataRows["id"];
		$name = $dataRows["name"];
		$scope = $dataRows["scope"];
		$profile = $dataRows["profile"];
		
		$dream_list[] = $dataRows;
		
		if (!in_array($scope, $scope_list)) {
			$scope_list[] = $scope;
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
					
			foreach ($scope_list as $scope_head) {
					
				echo '<div class="sub-menu">';
					
				echo '<h2>'.ucfirst($scope_head).' Teams</h2>';
					
				echo '<div class="flex-wrapper">';
			
				foreach ($dream_list as $dream_menu) if ($dream_menu["scope"] == $scope_head) {
						
					echo '<div class="flex-item">';
					echo '&#9654; <a class="standard-link" href="dream_team.php?id='.$dream_menu["id"].'">'.$dream_menu["name"].'</a>';
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
