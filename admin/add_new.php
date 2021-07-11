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
			$identifier = "person";
			break;
	}
		
	include 'inc/'.$identifier.'/process_new.php';
	
?>

	<div class="page-template">
	
		<h1>
			Add New <?php echo ucfirst($identifier); ?>
		</h1>		
		
		<?php
			
			include 'inc/'.$identifier.'/form_new.php';
			
		?>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
