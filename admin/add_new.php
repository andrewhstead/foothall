<?php
	$thispage = "Add New Record";

	session_start();
	
	require_once '../inc/db.php';
	require_once '../inc/functions.php';
	include 'inc/header.php';
	
	confirm_login();
	
	$connectDB;
					
	if (isset($_GET["type"])) {
		$table_id = $_GET["type"];
	} else {
		$table_id = person;
	}
	
	include 'inc/switch.php';
		
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
