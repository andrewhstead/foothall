<?php
	$thispage = "Home Page";
?>

<!DOCTYPE html>

<html lang="en-GB">

	<!-- Header information for the page. -->
	<head>
		<title>The FootHall - an International Football Hall of Fame Voted by the Public</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Gabriela&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Economica&display=swap" rel="stylesheet">
		
		<link rel="icon" href="/favicon.ico">
		<link rel="stylesheet" href="css/main.css">
	</head>
	
	<!-- The visible content of the page. -->
	<body>
		
		<header>
			The FootHall
		</header>
		
		<nav class="main-menu">
			
			<!-- Menu icon to toggle menu using JavaScript. -->
			<div class="menu-toggle" onclick="menuToggle('menu')">MENU &#9776;</div>
			
			<ul class="navigation">
				<li class="menu-link">Home</li>
				<li>+ The Hall of Fame
					<ul class="navigation">
						<li class="menu-link">Voting</li>
						<li class="menu-link">Players</li>
						<li class="menu-link">Coaches</li>
						<li class="menu-link">Matches</li>
						<li class="menu-link">Teams</li>
					</ul>
				</li>
				<li>+ The History of Football
					<ul class="navigation">
						<li class="menu-link">Tournaments</li>
						<li class="menu-link">Countries</li>
						<li class="menu-link">Clubs</li>
						<li class="menu-link">Stories</li>
					</ul>
				</li>
			</ul>
		
		</nav>
		
	</body>

</html>
