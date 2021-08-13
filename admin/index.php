<?php
	
	$thispage = "Home Page";

	session_start();
	
	require_once '../inc/db.php';
	require_once '../inc/functions.php';
	include 'inc/header.php';
	
	confirm_login();
	
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
				
				echo '<div class="admin-flex">';
			
			foreach ($table_list as $table_menu) if ($table_menu["table_type"] == $type_menu) {
				
					echo '<div class="admin-wrapper">';
						
						echo '<div class="right-section">';
						
							if ($table_menu["table_type"] == "hall") {
								
								echo '<a class="admin-link" href="view_list.php?type='.$table_menu["table_name"].'&status=active">';
								echo '<div class="admin-link-box">';
								echo 'View Active';
								echo '</div>';
								echo '</a>';
							
								echo '<a class="admin-link" href="view_list.php?type='.$table_menu["table_name"].'&status=contenders">';
								echo '<div class="admin-link-box">';
								echo 'View Contenders';
								echo '</div>';
								echo '</a>';
							
								if ($table_menu["table_name"] != "hall-teams") {
									
									echo '<a class="admin-link" href="view_list.php?type='.$table_menu["table_name"].'&status=inactive">';
									echo '<div class="admin-link-box">';
									echo 'View Inactive';
									echo '</div>';
									echo '</a>';
									
								}
							
							} else {
								
								echo '<a class="admin-link" href="view_list.php?type='.$table_menu["table_name"].'">';
								echo '<div class="admin-link-box">';
								echo 'View List';
								echo '</div>';
								echo '</a>';
								
							}
											
							echo '<a class="admin-link" href="add_new.php?type='.$table_menu["table_name"].'">';
							echo '<div class="admin-link-box">';
							echo 'Add New';
							echo '</div>';
							echo '</a>';
					
						echo '</div>';
						
						echo '<div class="left-section">';
						echo '<h3 class="admin-head">'.ucwords(str_replace('_', ' ', $table_menu["table_name"])).'</h3>';
						echo '</div>';
						
					
					echo '</div>';
					
			}
			
				echo '</div>';
							
		}
	
	?>
		
	</div>

<?php
	
	include 'inc/footer.php';
	
?>
