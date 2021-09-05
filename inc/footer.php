		<?php include 'inc/sidebar.php' ; ?>
					
		</main>
		
		<script src="js/lightbox.js"></script>
		<script src="js/default.js"></script>
		
		<?php 
			if (!isset($_COOKIE['general'])) {
				echo '<div class="cookie-bar">';
				echo '<span class="cookie-header">USE OF COOKIES</span><br>';
				echo 'This site uses cookies to tailor the user experience. You may opt out of them if you wish but doing so will cause some site functionality to be limited.';
				echo '<p>';
				echo '<span class="cookie-button">View Cookie Policy</span>';
				echo '<span class="cookie-button">Accept Cookies</span>';
				echo '<span class="cookie-button">Reject Cookies</span>';
				echo '</p>';
				echo '</div>';
			}
		?>
			
		<footer>
		
			<div class="template-width">&copy; <?php echo date("Y"); ?> The FootHall</div>
		
		</footer>
		
	</body>

</html>
