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
			
			<ul class="menu-items toggle-items">
				<li><a class="menu-link" href="index.php">Home Page</a></li>
				<li class="nest-heading" onmouseover="showMenu()" onmouseleave="removeMenu()">
					<span class="nest-head">
						<span class="open-nest" onclick="menuToggle('hall')">
							<span id="hall-icon">+</span> The Hall of Fame
						</span>
					</span>
					<ul class="nest-menu">
						<li class="hall-nested hall-item">Voting</li>
						<li class="hall-nested hall-item">Players</li>
						<li class="hall-nested hall-item">Coaches</li>
						<li class="hall-nested hall-item">Matches</li>
						<li class="hall-nested hall-item">Teams</li>
					</ul>
				</li>
				<li class="nest-heading" onmouseover="showMenu()" onmouseleave="removeMenu()">
					<span class="nest-head">
						<span class="open-nest" onclick="menuToggle('history')">
							<span id="history-icon">+</span> The History of Football
						</span>
					</span>
					<ul class="nest-menu">
						<li class="history-nested history-item">Tournaments</li>
						<li class="history-nested history-item">Countries</li>
						<li class="history-nested history-item">Clubs</li>
						<li class="history-nested history-item">Stories</li>
					</ul>
				</li>
			</ul>
		
		</nav>
		
		<main>