<?php
	$thispage = "Country Menu";
	
	require_once 'inc/db.php';

	include 'inc/header.html';
					
	if (isset($_GET["id"])) {
		$country_id = $_GET["id"];
	} else {
		$country_id = 1;
	}
						
	$connectDB;

	$continents = "SELECT * FROM continents";
	$page_content = $connectDB->query($continents);
	
	$continent_list = array();
	
	while ($dataRows = $page_content->fetch()) {

		$continent_id = $dataRows["id"];
		$continent_name = $dataRows["name"];
		
		$continent_list[] = $continent_name;
	
	}
?>

	<div class="page-template">
		
		<h1>
			Countries
		</h1>
		
		<?php
		
			foreach ($continent_list as &$continent_menu) {
				echo '<h2>'.$continent_menu.'</h2>';
			}
		
		?>
		
	</div>

	
<?php

	include 'inc/footer.html';
	
?>
