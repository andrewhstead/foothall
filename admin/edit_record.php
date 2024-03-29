<?php
	ob_start();
	session_start();
	require_once '../inc/functions.php';
	confirm_login();	
	require_once '../inc/db.php';
	include 'inc/header.php';
	$connectDB;
	
	$thispage = "Edit Record";
					
	if (isset($_GET["type"])) {
		$table_id = $_GET["type"];
	} else {
		$table_id = person;
	}
	
	include 'inc/switch.php';
					
	if (isset($_GET["code"])) {
		$record_id = $_GET["code"];
	}
		
	include 'inc/'.$identifier.'/process_edit.php';
?>

	<div class="page-template">
		
		<?php include 'inc/messages.php'; ?>
	
		<h1>
			Edit <?php echo ucwords(str_replace('_', ' ', $identifier)); ?>
		</h1>		
	
		<h2>
			<?php 
				echo htmlentities(str_replace('_', ' ', $$list_column)).'<br>id: '.htmlentities($database_id) ;
			?>
		</h2>		
		
		<?php
			
			include 'inc/'.$identifier.'/form_edit.php';
			
		?>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
