<?php

	if(isset($_POST["submit"])) {
		
		$new_table_name = $_POST["table-name"];
		$new_table_type = $_POST["table-type"];
		$new_importance = $_POST["importance"];
		
		$sql = "INSERT INTO tables (table_name, table_type, importance)";
		$sql .= "VALUES (:NewTableName, :NewTableType, :NewImportance)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewTableName', $new_table_name);
		$stmt->bindValue(':NewTableType', $new_table_type);
		$stmt->bindValue(':NewImportance', $new_importance);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your record has been saved successfully.";
			
			redirect_to("view_list.php?type=$table_id&status=active");
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
