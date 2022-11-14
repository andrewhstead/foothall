<?php
	ob_start();
	$thispage = "Cookie Policy";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
						
	$connectDB;
	
	if(isset($_POST["amend"])) {
		if ($_POST["amend"] == 'Delete Cookies') {
			$past = time() - 3600;
			foreach ($_COOKIE as $key => $value) {
				setcookie($key, $value, $past, '/');
				unset($_COOKIE["$key"]);
			}
			$_SESSION['choice'] = 'Reject Cookies';
		} else if ($_POST["amend"] == 'Accept Cookies') {
			setcookie('general', 'accepted', time() + (86400 * 30), "/");
			$_COOKIE['general'] = 'accepted';
			unset($_SESSION['choice']);
		}
	}
	
?>

	<div class="page-template">
		
		<h1>
			Cookie Policy
		</h1>
	
		<p>
			This site uses cookies in order to limit multiple voting and rating. These are small files stored in your internet browser which remember what you have done on the website in the past. 
		</p>
		
		<p>
			The cookies that we use collect no personal information about our users, they are only used to remember whether you have already voted on a particular poll or rated a particular person. You may choose to reject these cookies, however doing so means that the voting and rating elements of the site will be disabled in your browser. You may still browse the site fully with no limitations on viewing content.
		</p>
		
		<p>
			If you choose to accept, any cookie which is set will remain for a period of one month. If you choose to reject, you will not be prompted to choose again for the duration of your visit to the site. You may change your preference at any time by visiting this page, using the link in the site footer.
		</p>
		
		<h3>Current Setting:</h3>
		
		<?php 
			echo '<form class="cookie-form" method="post" action="">';
			if (isset($_COOKIE['general'])) {
				echo '<div class="cookie-setting">';
				echo '<span class="accepted-mark">&#10003</span>'; 
				echo '<span class="accepted-text">Accepted</span>';
				echo '</div>';
				echo '<br><input class="cookie-reject cookie-link" type="submit" name="amend" value="Delete Cookies">';
			} else {
				echo '<div class="cookie-setting">';
				echo '<span class="rejected-mark">&#10007</span>'; 
				echo '<span class="rejected-text">Not accepted</span>';
				echo '</div>';
				echo '<br><input class="cookie-accept cookie-link" type="submit" name="amend" value="Accept Cookies">';
			}
			echo '</form>';
		?>
	
	</div>

	
<?php

	include 'inc/footer.php';
	
?>
