<?php

	if(isset($_POST["submit"])) {
		
		$new_name = $_POST["name"];
		$new_type = $_POST["type"];
		$new_description = $_POST["description"];
		
		$sql = "INSERT INTO tables (name, type, intro_text)";
		$sql .= "VALUES (:NewName, :NewType, :NewDescription)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewName', $new_name);
		$stmt->bindValue(':NewType', $new_type);
		$stmt->bindValue(':NewDescription', $new_description);

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
