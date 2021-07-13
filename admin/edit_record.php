<?php
	$thispage = "Edit Record";

	session_start();
	
	require_once '../inc/db.php';
	require_once '../inc/functions.php';
	include 'inc/header.html';
	
	confirm_login();
	
	$connectDB;
					
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
	
		<h1>
			Edit <?php echo ucfirst($identifier); ?>
		</h1>		
	
		<h2>
			<img class="text-icon" src="../img/flags/<?php echo strtolower($nationality); ?>
				.png" alt="<?php echo htmlentities($nationality); ?>">
			<?php echo htmlentities($name).'<br>id: '.htmlentities($database_id); ?>
		</h2>		
		
		<?php
			
			include 'inc/'.$identifier.'/form_edit.php';
			
		?>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
