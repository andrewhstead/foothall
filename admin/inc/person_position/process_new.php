<?php

	if(isset($_POST["submit"])) {
		
		$new_person = $_POST["person"];
		$new_position = $_POST["position"];

		$sql = "INSERT INTO people_positions (person, position)";
		$sql .= "VALUES (:NewPerson, :NewPosition)";
					
		$stmt = $connectDB->prepare($sql);
		
		$stmt->bindValue(':NewPerson', $new_person);
		$stmt->bindValue(':NewPosition', $new_position);

		$execute = $stmt->execute();
		
		if($execute) {

			$_SESSION["success_message"] = "Your record has been saved successfully.";
			
			if ($_POST['submit'] == 'Save and Add Another') {
				redirect_to("add_new.php?type=$table_id");
			} else if ($_POST['submit'] == 'Save and Close') {
				if ($new_active == 1) {
				redirect_to("view_list.php?type=$table_id&status=active");
				} else if ($new_active == 0) {
					redirect_to("view_list.php?type=$table_id&status=inactive");
				}
			}
			
		} else {

			$_SESSION["error_message"] = "Something went wrong. Please try again.";
			redirect_to("add_new.php?type=$table_id");
			
		}

	}
	
?>
