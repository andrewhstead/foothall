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
		<link rel="stylesheet" href="../css/main.css">
		
		<script src="https://cdn.tiny.cloud/1/ieqk4j4wlawj4pytvzxzoriw0craruuiqvpwgior1svdk9cm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		
		<script>
			tinymce.init({
				selector: '.editable-area',
				plugins: 'image link',
			});
		</script>
		
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
				<li><a class="menu-link" href="index.php">Admin Home</a></li>
				<li><a class="menu-link" href="../index.php">Website Home</a></li>
			
			<?php
				if(isset($_SESSION["user_id"])) {
					echo '<li><a class="menu-link" href="logout.php">Log Out</a></li>';
				}
			?>
			
			</ul>	
					
		</nav>
		
		<main>
			
			<div class="main-page admin-page">
