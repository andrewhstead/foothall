<?php
	$thispage = "Add New Record";

	session_start();
	
	require_once '../inc/db.php';
	require_once '../inc/functions.php';
	include 'inc/header.html';
	
	confirm_login();
	
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
