<?php
	$thispage = "View Table Entries";
	
	require_once '../inc/db.php';

	include 'inc/header.html';
					
	if (isset($_GET["id"])) {
		$table_id = $_GET["id"];
	} else {
		$table_id = 8;
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
		
		<table class="data-table">
			
			<thead>
				<tr>
					<th>Name</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			
			<tbody>
				
				<?php
					
					$table_data = "SELECT * FROM $table_name";
					$data_query = $connectDB->query($table_data);
					
					$table_details = array();
			
					while ($dataRows = $data_query->fetch()) {

						echo '<tr>';
						echo '<td>'.htmlentities($dataRows["name"]).'</td>';
						echo '<td class="button-cell"><span class="admin-button">View</span></td>';
						echo '<td class="button-cell"><span class="admin-button">Edit</span></td>';
						echo '<td class="button-cell"><span class="admin-button">Delete</span></td>';
						echo '</tr>';
						
					}
								
				?>
		
			</tbody>
		
		</table>
		
	</div>
	
<?php

	include 'inc/footer.html';
	
?>
