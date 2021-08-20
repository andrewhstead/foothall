<?php

	if(isset($_POST["submit"])) {
		
		$new_name = $_POST["name"];

		$sql = "UPDATE continents SET name=:NewName WHERE id = '$record_id'";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewName', $new_name);

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
		
	$continent = "SELECT * FROM continents WHERE id = '$record_id'";
	$continent_query = $connectDB->query($continent);
		
	while ($dataRows = $continent_query->fetch()) {

		$database_id = $dataRows["id"];
		$name = $dataRows["name"];
		$active = $dataRows["active"];
		
	}
	
?>
