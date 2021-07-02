<?php
	$thispage = "Home Page";
	
	require_once '../inc/db.php';
	
	include 'inc/header.html';
	
	$connectDB;
	
	$tables = "SELECT *	FROM tables ORDER BY table_type, importance, table_name";
	$table_query = $connectDB->query($tables);
	
	$table_list = array();
	$type_list = array();
	
	while ($dataRows = $table_query->fetch()) {

		$table_id = $dataRows["id"];
		$table_name = $dataRows["table_name"];
		$table_type = $dataRows["table_type"];
		
		$table_list[] = $dataRows;
		
		if (!in_array($table_type, $type_list)) {
			$type_list[] = $table_type;
		}

	}
	
?>

	<div class="page-template">
		
		<h1>
			Administration Area
		</h1>
		
	<?php
	
		foreach ($type_list as $type_menu) {
							
			echo '<h2 class="info-page">'.ucfirst($type_menu).'</h2>';
			
			foreach ($table_list as $table_menu) if ($table_menu["table_type"] == $type_menu) {
				
				echo '<h3 class="info-page">'.ucfirst($table_menu["table_name"]).'</h3>';
				
			}
							
		}
	
	?>
		
	</div>

<?php
	
	include 'inc/footer.html';
	
?>
