<?php

	if(isset($_POST["submit"])) {
		
		$new_name = $_POST["name"];
		
		$sql = "INSERT INTO continents (name)";
		$sql .= "VALUES (:NewName)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewName', $new_name);

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
