		<?php
			if(isset($_SESSION["success_message"] )) {
				echo '<div class="success-message message">'.$_SESSION["success_message"].'</div>';
				unset($_SESSION["success_message"]);
			} elseif(isset($_SESSION["error_message"] )) {
				echo '<div class="error-message message">'.$_SESSION["error_message"].'</div>';
				unset($_SESSION["error_message"]);
			}
		?>
