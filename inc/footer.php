		<?php include 'inc/sidebar.php' ; ?>
					
		</main>
		
		<script src="js/lightbox.js"></script>
		<script src="js/default.js"></script>
		
		<?php 
			if (!isset($_COOKIE['general'])) {
				echo '<div class="cookie-bar">';
			} else {
				echo '<div class="cookie-bar hidden">';
			}
			echo '<span class="cookie-header">USE OF COOKIES</span><br>';
			echo 'This site uses cookies to tailor your experience. You may opt out of them if you wish but doing so will cause some site functionality to be limited.';
			echo '<br><br>';
			echo '<span class="cookie-button">View Cookie Policy</span>';
			echo '<form class="cookie-form" method="post" action="">';
			echo '<input class="cookie-accept" type="submit" name="choice" value="Accept Cookies">';
			echo '</form>';
			echo '<input onclick="hideBar()" class="cookie-reject" type="submit" name="choice" value="Reject Cookies">';
			echo '</div>';
		?>
			
		<footer>
		
			<div class="template-width">&copy; <?php echo date("Y"); ?> The FootHall</div>
		
		</footer>
		
	</body>

</html>
