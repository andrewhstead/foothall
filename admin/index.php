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
				
				echo '<div class="admin-wrapper">';
					
					echo '<div class="right-section">';
					
						echo '<div class="admin-link-box">';
						echo '<a class="admin-link" href="view_list.php?id='.$table_menu["id"].'">';
						echo 'View List';
						echo '</a>';
						echo '</div>';
						
						echo '<div class="admin-link-box">';
						echo '<a class="admin-link" href="add_new.php?id='.$table_menu["id"].'">';
						echo 'Add New';
						echo '</a>';
						echo '</div>';
				
					echo '</div>';
					
					echo '<div class="left-section">';
					echo '<h3 class="admin-head">'.ucwords(str_replace('_', ' ', $table_menu["table_name"])).'</h3>';
					echo '</div>';
					
				
				echo '</div>';
				
			}
							
		}
	
	?>
		
	</div>

<?php
	
	include 'inc/footer.html';
	
?>
