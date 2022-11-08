<?php
	ob_start();	
	session_start();
	require_once '../inc/functions.php';
	confirm_login();	
	require_once '../inc/db.php';
	include 'inc/header.php';
	$connectDB;
	
	$thispage = "Add New Record";
					
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
			Add New <?php echo ucwords(str_replace('_', ' ', $identifier)); ?>
		</h1>		
		
		<?php
			
			include 'inc/'.$identifier.'/form_new.php';
			
		?>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
