<?php
	$thispage = "Country Index";
	
	require_once 'inc/db.php';

	include 'inc/header.html';
					
	if (isset($_GET["id"])) {
		$country_id = $_GET["id"];
	} else {
		$country_id = 1;
	}
						
	$connectDB;

	$country = "SELECT * FROM countries WHERE id = '$country_id'";
	$page_content = $connectDB->query($country);

	while ($dataRows = $page_content->fetch()) {

		$display_name = $dataRows["display_name"];
		$abbreviation = $dataRows["abbreviation"];
		$continent = $dataRows["continent"];
		
	}
?>

	<div class="page-template">
		
		<h1 class="info-page">
			<img class="header-icon" src="img/flags/<?php echo strtolower($abbreviation); ?>
				.png" alt="<?php echo htmlentities($display_name); ?>">
			<?php echo htmlentities($display_name); ?>
		</h1>
		<strong>Continent:</strong> <?php echo htmlentities($continent); ?>
		
	</div>

	
<?php

	include 'inc/footer.html';
	
?>
