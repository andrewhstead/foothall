<?php
	
	session_start();
	require_once '../inc/functions.php';
	confirm_login();	
	require_once '../inc/db.php';
	$connectDB;

	include 'inc/header.php';
	
	$thispage = "View Table Entries";
	
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

	if(isset($_POST["delete"])) {
		
		$to_delete = $_POST["to_delete"];

		$sql = "DELETE FROM $table_name WHERE id='$to_delete'";

		$execute = $connectDB->query($sql);

		if($execute) {
			
			$_SESSION["success_message"] = "Lecture deleted successfully.";
			redirect_to("view_list.php?type=$table_name");

		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("view_list.php?type=$table_name");

		}

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
				if ($table_type == 'hall') {
					if ($status == "contenders") {
						echo '<strong>Contenders</strong>';
					} else {
						echo '<a class="cms-link" href="view_list.php?type='.$table_name.'&status=contenders">Contenders</a>';
					}
					echo ' | ';				}
			?>
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
				$table_data = "SELECT * FROM $table_name WHERE active = true ORDER BY $sort_column";
			} elseif ($table_type == 'hall') {
				if ($status == 'contenders') {
					$table_data = "SELECT * FROM $table_name WHERE contender = true ORDER BY $sort_column";
				} else {
					$table_data = "SELECT * FROM $table_name WHERE active = false AND contender = false ORDER BY $list_column";
				}
			} else {
				$table_data = "SELECT * FROM $table_name WHERE active = false ORDER BY $sort_column";
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
					
					$record_id = $dataRows["id"];

					echo '<tr><td>';
					if ($table_name == "people") {
						echo '<img class="text-icon" src="../img/flags/'.strtolower($dataRows["nationality"]).'.png" alt="'.htmlentities($dataRows["nationality"]).'"> ';
					}
					if (isset($disambiguation)) {
						echo str_replace('_', ' ', $dataRows[$disambiguation]).': ';
					}
					echo str_replace('_', ' ', $dataRows[$list_column]).'</td>';
					
					if (($table_type == 'hall' OR $table_type == 'history' OR $table_name == 'polls') AND ($status == 'active')) {
						echo '<td class="button-cell"><span class="admin-button">';
						echo '<a class="button-link" href="../'.$identifier.'.php?id='.$dataRows["id"].'">';
						echo 'View</a></span></td>';
					}
					
					echo '<td class="button-cell"><span class="admin-button">';
					echo '<a class="button-link" href="edit_record.php?type='.$table_name.'&code='.$dataRows["$url_column"].'">';
					echo 'Edit</a></span></td>';
					echo '<td class="button-cell">';
					echo '<button class="admin-button" onclick="confirmToggle('.$record_id.')">Delete</button></td>';
					echo '</tr>';
					echo '<div class="blackout hide record_'.$record_id.'">';
					echo '<div class="confirm hide record_'.$record_id.'">';
					
					echo 'Are you sure you want to delete this record?';
					echo '<br>';
							
					echo '<form class="confirmation" method="post" action="view_list.php?type='.$table_name.'">';
					echo '<input type="hidden" name="to_delete" value="'.$dataRows["id"].'">';
					echo '<input type="submit" name="delete" value="OK">';
					echo '</form>';
					echo '<button onclick="confirmToggle('.$record_id.')">Cancel</button>';
								
					echo '</div>';
					echo '</div>';
							
				}
				
				echo '</tbody></table>';
						
			}
								
		?>
		
	</div>
	
<?php

	include 'inc/footer.php';
	
?>
