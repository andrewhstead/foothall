<?php

	if(isset($_POST["submit"])) {
		
		$new_table_name = $_POST["table-name"];
		$new_table_type = $_POST["table-type"];
		$new_importance = $_POST["importance"];

		$sql = "UPDATE tables SET table_name=:NewTableName, table_type=:NewTableType, importance=:NewImportance WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewTableName', $new_table_name);
		$stmt->bindValue(':NewTableType', $new_table_type);
		$stmt->bindValue(':NewImportance', $new_importance);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your edits have been saved successfully.";
			
			redirect_to("view_list.php?type=$table_id&status=active");
			
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("edit_record.php?type=$table_id&code=$database_id");
			
		}

	}
		
	$table = "SELECT * FROM tables WHERE id = '$record_id'";
	$table_query = $connectDB->query($table);
		
	while ($dataRows = $table_query->fetch()) {

		$database_id = $dataRows["id"];
		$table_name = $dataRows["table_name"];
		$table_type = $dataRows["table_type"];
		$importance = $dataRows["importance"];
		
	}
	
?>
