<?php
	
	require_once 'inc/db.php';
					
	if (isset($_GET["id"])) {
		$page_id = $_GET["id"];
	} else {
		$page_id = 1;
	}
						
	$connectDB;

	$page = "SELECT * FROM pages WHERE id = '$page_id'";
	$page_content = $connectDB->query($page);

	while ($dataRows = $page_content->fetch()) {

		$page_id = $dataRows["id"];
		$title = $dataRows["title"];
		$heading = $dataRows["heading"];
		$content = $dataRows["content"];
					
	}

?>

<!DOCTYPE html>

<html>
	
	<head>
		
		<title><?php echo $title; ?> | The Historical Association Plymouth Branch</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/default.css">
		<link rel="icon" href="favicon.ico">
		
		<script src="https://cdn.tiny.cloud/1/ieqk4j4wlawj4pytvzxzoriw0craruuiqvpwgior1svdk9cm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	
	</head>
	
	<body>
		
		<header>
			
			<div class="container">
				<a href="index.php">
					<img class="banner" alt="The Historical Association Plymouth Branch" src="img/banner.png">
				</a>
			</div>
			
			<nav class="main-menu">
				<ul>
					
					<?php
									
						$connectDB;

						$menu = "SELECT * FROM pages";
						$all_pages = $connectDB->query($menu);

						while ($dataRows = $all_pages->fetch()) {

							$link_id = $dataRows["id"];
							$link_text = $dataRows["title"];

					?>
					
					<li>
						<a href="index.php?id=<?php echo htmlentities($link_id); ?>">
							<?php echo htmlentities($link_text); ?>
						</a>
					</li>

					<?php } ?>
					
				</ul>
			</nav>		
			
		</header>
		
		<main>
			
			<h1><?php echo htmlentities($heading); ?></h1>
			
			<?php
			
				if ($title == "Programme") {
					echo "<p><strong>Upcoming Lectures</strong></p>";
					
					$connectDB;

					$lectures = "SELECT * FROM lectures WHERE date >= CURDATE() ORDER BY date";
					$programme = $connectDB->query($lectures);

					while ($dataRows = $programme->fetch()) {

					$date = $dataRows["date"];
					$time = $dataRows["time"];
					$title = $dataRows["title"];
					$lecturer = $dataRows["lecturer"];
					$institution = $dataRows["institution"];
					$link = $dataRows["link"];
					$virtual = $dataRows["virtual"];
					
					$phpdate = strtotime($date);
					$phptime = strtotime($time);
					$displaydate = date('l j F', $phpdate);
					$displaytime = date('g:ia', $phptime);			
			?>
			
			<p>
				<?php echo htmlentities($displaydate) . 
					", " . htmlentities($displaytime); 
					if ($virtual) {
						echo " <em>(Online Lecture)</em>";
					}
				?>
				<br>
				<strong>
					<?php echo htmlentities($title); ?>
				</strong>
				<br>
				<i>
					<?php
						if ($link) {
							echo "<a class='link' href='";
							echo htmlentities($link);
							echo "'>";	
							echo htmlentities($lecturer);
							echo "</a>";						
						} else {
							echo htmlentities($lecturer);
						}
					?>
					(<?php echo htmlentities($institution); ?>)
				</i>
			</p>
								
			<?php
			
					}
			
				}
				
				echo htmlspecialchars_decode($content); 
				
				/*if ($title == "Contact Us") {

					include 'inc/contactform.php';
					
				}*/
				
			?>
	
<?php

	include 'inc/footer.php';
	
?>
