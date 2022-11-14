		<?php include 'inc/sidebar.php' ; ?>
					
		</main>
		
		<script src="js/lightbox.js"></script>
		<script src="js/default.js"></script>
		
		<?php 
			if (isset($_COOKIE['general'])) {
				echo '<div class="cookie-bar hidden">';
			} else if (isset($_SESSION['choice'])) {
				echo '<div class="cookie-bar hidden">';
			} else {
				echo '<div class="cookie-bar">';
			}
			echo '<span class="cookie-header">USE OF COOKIES</span><br>';
			echo 'This site uses cookies to tailor your experience. You may opt out of them if you wish but doing so will cause some site functionality to be limited.';
			echo '<br><br>';
			echo '<span class="cookie-button"><a class="cookie-link" href="cookies.php">View Cookie Policy</a></span>';
			echo '<form class="cookie-form" method="post" action="">';
			echo '<input class="cookie-accept cookie-link" type="submit" name="choice" value="Accept Cookies">';
			echo '<input class="cookie-reject cookie-link" type="submit" name="choice" value="Reject Cookies">';
			echo '</form>';
			echo '</div>';
		?>
			
		<footer>
		
			<div class="template-width">
				&copy; <?php echo date("Y"); ?> The FootHall
				<span class="footer-link">
					 <a href="about.php">About the Site</a>
					 | <a href="cookies.php">Cookie Policy</a>
					 | <a href="admin">Admin Area</a>
				</span>
			</div>
		
		</footer>
		
	</body>

</html>
