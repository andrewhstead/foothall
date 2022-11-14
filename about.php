<?php
	ob_start();
	$thispage = "Cookie Policy";
	
	require_once 'inc/db.php';

	include 'inc/header.php';
						
	$connectDB;
	
?>

	<div class="page-template">
		
		<h1>
			About The FootHall
		</h1>
	
		<p>
			The FootHall is an international football hall of fame selected by the public - choose players, coaches, matches and teams to be included by voting in our regular polls. When a poll expires, those elected will be added to the site and will have a full biography added.
		</p>
		
		<p>
			If your favourite is not yet included on the site, it will be for one of three reasons:
			<ul class="default-list">
				<li>
					We haven't thought to include them as an option yet - in which case get in touch via social media to make a suggestion for a future poll.
				</li>
				<li>
					We have thought about including them but haven't got around to it yet - there isn't room for every deserving candidate to be included right away. Feel free to suggest them anyway, in case we have overlooked someone!
				</li>
				<li>
					They are not yet eligible to be included - currently active players will not be available for selection, and a player must have been retired for two years before they will be included as an option. Matches likewise must have been played at least two years ago. Coaches do not have to be retired but if they are not, they must have started their coaching career at least 25 years ago.
				</li>
			</ul>
		</p>
	
		<p>
			All photos on the site are believed to be in the public domain or free for use with attribution. If this is not the case and you are a copyright holder please let us know. All text on the site is copyright &copy; The FootHall.
		</p>
	
	</div>

	
<?php

	include 'inc/footer.php';
	
?>
