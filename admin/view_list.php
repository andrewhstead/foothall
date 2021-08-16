<?php
	$thispage = "View Table Entries";

	session_start();
	
	require_once '../inc/db.php';
	require_once '../inc/functions.php';
	include 'inc/header.php';
	
	confirm_login();
	
	$connectDB;
					
	if (isset($_GET["type"])) {
		$table_id = $_GET["type"];
	} else {
		$table_id = "people";
	}
	
	include 'inc/switch.php';
					
	if (isset($_GET["status"])) {
		$status = $_GET["status"];
	} else {
		$status = 'active';
	}
	
	$table = "SELECT * FROM tables WHERE table_name = '$table_id'";
	$table_query = $connectDB->query($table);
	
	while ($dataRows = $table_query->fetch()) {

		$id = $dataRows["id"];
		$table_name = $dataRows["table_name"];
		$table_type = $dataRows["table_type"];
				
	}
	
?>

	<div class="page-template">
		
		<h1>
			<?php echo ucwords(str_replace('_', ' ', $table_id)); ?>
		</h1>
		
		<div class="centre-text">
			<?php
				if ($status == "active") {
					echo '<strong>Active</strong>';
				} else {
					echo '<a class="cms-link" href="view_list.php?type='.$table_name.'&status=active">Active</a>';
				}
			?>
			 | 
			<?php
				if ($status == "contenders") {
					echo '<strong>Contenders</strong>';
				} else {
					echo '<a class="cms-link" href="view_list.php?type='.$table_name.'&status=contenders">Contenders</a>';
				}
			?>
			 | 
			<?php
				if ($status == "inactive") {
					echo '<strong>Inactive</strong>';
				} else {
					echo '<a class="cms-link" href="view_list.php?type='.$table_name.'&status=inactive">Inactive</a>';
				}
			?>
			 | 
			<a class="cms-link" href="add_new.php?type=<?php echo $table_name; ?>">Add New</a>
		</div>
		
		<?php
		
			if ($status == 'active') {
				$table_data = "SELECT * FROM $table_name WHERE active = true ORDER BY file_code";
			} elseif ($status == 'contenders') {
				$table_data = "SELECT * FROM $table_name WHERE contender = true ORDER BY file_code";
			} else {
				$table_data = "SELECT * FROM $table_name WHERE active = false AND contender = false ORDER BY file_code";
			}
					
			$data_query = $connectDB->query($table_data);
					
			$records = $data_query->rowCount();
			
			if($records == 0) {
						
				echo '<h2 class="empty-list">No Records Available</h2>';
						
			} else {
						
				echo '<table class="data-table">';
				echo '<tbody>';
						
				$table_details = array();
				
				while ($dataRows = $data_query->fetch()) {

					echo '<tr><td>';
					if ($table_name == "people") {
						echo '<img class="text-icon" src="../img/flags/'.strtolower($dataRows["nationality"]).'.png" alt="'.htmlentities($dataRows["nationality"]).'"> ';
					}
					echo str_replace('_', ' ', $dataRows[$list_column]).'</td>';
					
					if ($status == 'active') {
						echo '<td class="button-cell"><span class="admin-button">';
						echo '<a class="button-link" href="../'.$identifier.'.php?id='.$dataRows["id"].'">';
						echo 'View</a></span></td>';
					}
					
					echo '<td class="button-cell"><span class="admin-button">';
					echo '<a class="button-link" href="edit_record.php?type='.$table_name.'&code='.$dataRows["file_code"].'">';
					echo 'Edit</a></span></td>';
					echo '<td class="button-cell"><span class="admin-button">';
					echo '<a class="button-link" href="delete.php?id='.$dataRows["id"].'">';
					echo 'Delete</a></span></td>';
					echo '</tr>';
							
				}
				
				echo '</tbody></table>';
						
			}
								
		?>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
