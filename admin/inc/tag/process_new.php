<?php

	if(isset($_POST["submit"])) {
		
		$new_table_name = $_POST["table-name"];
		$new_page_type = $_POST["page_type"];

		$sql = "INSERT INTO tag_list (table_name, page_type)";
		$sql .= "VALUES (:NewTableName, :NewPageType)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewTableName', $new_table_name);
		$stmt->bindValue(':NewPageType', $new_page_type);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your record has been saved successfully.";
			
			if ($new_active == true) {
				redirect_to("view_list.php?type=$table_id&status=active");
			} else if ($new_active == false) {
				redirect_to("view_list.php?type=$table_id&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
