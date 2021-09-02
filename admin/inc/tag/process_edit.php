<?php

	if(isset($_POST["submit"])) {
		
		$new_table_name = $_POST["table-name"];
		$new_page_type = $_POST["page-type"];
		$new_active == true;

		$sql = "UPDATE tag_list SET table_name=:NewTableName, page_type=:NewPageType WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewTableName', $new_table_name);
		$stmt->bindValue(':NewPageType', $new_page_type);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your edits have been saved successfully.";
			
			if ($new_active == true) {
				redirect_to("view_list.php?type=$table_id&status=active");
			} else if ($new_active == false) {
				redirect_to("view_list.php?type=$table_id&status=inactive");
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("edit_record.php?type=$table_id&code=$database_id");
			
		}

	}
		
	$news = "SELECT * FROM tag_list WHERE id = '$record_id'";
	$news_query = $connectDB->query($news);
		
	while ($dataRows = $news_query->fetch()) {

		$database_id = $dataRows["id"];
		$table_name = $dataRows["table_name"];
		$page_type = $dataRows["page_type"];
		
	}
	
?>
