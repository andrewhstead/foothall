<?php
		
	if(isset($_POST["choice"])) {
		if ($_POST["choice"] == 'Accept Cookies') {
			setcookie('general', 'accepted', time() + (86400 * 30), "/");
			$_COOKIE['general'] = 'accepted';
		} else if ($_POST["choice"] == 'Reject Cookies') {
			$_SESSION['choice'] = $_POST["choice"];
		}
	}
	
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
		
		<link rel="icon" href="img/icons/favicon.ico">
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
				<li class="header-link-text"><a class="menu-link" href="index.php">Home Page</a></li>
				<li class="nest-heading header-link-text" onmouseover="showMenu('hall')" onmouseleave="removeMenu('hall')">
					<span class="nest-head">
						<span class="open-nest" onclick="menuToggle('hall')">
							<span id="hall-icon">+</span> The Hall of Fame
						</span>
					</span>
					<ul class="nest-menu">
						<li class="hall-nested hall-item"><a class="menu-link" href="polls.php">Voting</a></li>
						<li class="hall-nested hall-item"><a class="menu-link" href="players.php">Players</a></li>
						<li class="hall-nested hall-item"><a class="menu-link" href="coaches.php">Coaches</a></li>
						<li class="hall-nested hall-item"><a class="menu-link" href="matches.php">Matches</a></li>
						<li class="hall-nested hall-item"><a class="menu-link" href="teams.php">Teams</a></li>
					</ul>
				</li>
				<!--
				<li class="nest-heading header-link-text" onmouseover="showMenu('history')" onmouseleave="removeMenu('history')">
					<span class="nest-head">
						<span class="open-nest" onclick="menuToggle('history')">
							<span id="history-icon">+</span> The History of Football
						</span>
					</span>
					<ul class="nest-menu">
						<li class="history-nested history-item"><a class="menu-link" href="competitions.php">Competitions</a></li>
						<li class="history-nested history-item"><a class="menu-link" href="countries.php">Countries</a></li>
						<li class="history-nested history-item"><a class="menu-link" href="clubs.php">Clubs</a></li>
						<li class="history-nested history-item"><a class="menu-link" href="stories.php">Stories</a></li>
						<li class="history-nested history-item"><a class="menu-link" href="dream.php">Dream Teams</a></li>
					</ul>
				</li>
				-->
				<?php				
					if(isset($_SESSION["user_id"])) {
						echo '<li class="header-link-text"><a class="menu-link" href="admin/index.php">Admin Home</a></li>';
					}
				?>
			</ul>
		
		</nav>
		
		<main>
			
			<div class="main-page">
