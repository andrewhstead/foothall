<?php
	$thispage = "View Table Entries";
	
	require_once '../inc/db.php';

	include 'inc/header.html';
					
	if (isset($_GET["id"])) {
		$table_id = $_GET["id"];
	} else {
		$table_id = 8;
	}
					
	if (isset($_GET["status"])) {
		$status = $_GET["status"];
	} else {
		$status = 'active';
	}
						
	$connectDB;
	
	$table = "SELECT * FROM tables WHERE id = $table_id";
	$table_query = $connectDB->query($table);
	
	while ($dataRows = $table_query->fetch()) {

		$id = $dataRows["id"];
		$table_name = $dataRows["table_name"];
		$table_type = $dataRows["table_type"];
				
	}
	
?>

	<div class="page-template">
		
		<h1>
			<?php echo ucfirst($table_name); ?>
		</h1>
		
		<?php
		
			if ($status == 'active') {
				$table_data = "SELECT * FROM $table_name WHERE active = true";
			} else {
				$table_data = "SELECT * FROM $table_name WHERE active = false";
			}
					
			$data_query = $connectDB->query($table_data);
					
			$records = $data_query->rowCount();
			
			if($records == 0) {
						
				echo '<h2>No Records Available</h2>';
						
			} else {
						
				echo '<table class="data-table">';
				echo '<thead><tr><th>Name</th><th></th><th></th>';
				if ($status == 'active') {
					echo '<th></th>';
				}
				echo '</tr></thead>';
				echo '<tbody>';
						
				$table_details = array();
				
				while ($dataRows = $data_query->fetch()) {

					echo '<tr>';
					echo '<td>'.htmlentities($dataRows["name"]).'</td>';
					
					if ($status == 'active') {
						echo '<td class="button-cell"><span class="admin-button">';
						echo '<a class="button-link" href="../person.php?id='.$dataRows["id"].'">';
						echo 'View</a></span></td>';
					}
					
					echo '<td class="button-cell"><span class="admin-button">';
					echo '<a class="button-link" href="edit_person.php?id='.$dataRows["id"].'">';
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

	include 'inc/footer.html';
	
?>
