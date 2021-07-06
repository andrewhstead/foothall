<?php
	$thispage = "Add New Record";
	
	require_once '../inc/db.php';

	include 'inc/header.html';
						
	$connectDB;
	
	if (isset($_GET["id"])) {
		$table_id = $_GET["id"];
	} else {
		$table_id = 8;
	}
		
	switch ($table_id) {
		case 8:
			include 'inc/add_person.php';
			break;
		default:
			include 'inc/add_person.php';
	}

	include 'inc/footer.html';
	
?>
