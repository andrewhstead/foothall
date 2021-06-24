<?php
	$thispage = "Competition Profile";
	
	require_once 'inc/db.php';

	include 'inc/header.html';
					
	if (isset($_GET["id"])) {
		$competition_id = $_GET["id"];
	} else {
		$competition_id = 1;
	}
						
	$connectDB;

	$competition = "SELECT * FROM competitions WHERE id = '$competition_id'";
	$competition_query = $connectDB->query($competition);
	
	while ($dataRows = $competition_query->fetch()) {

		$name = $dataRows["name"];
		$profile = $dataRows["profile"];
		
	}
	
	$tournaments = "SELECT * FROM tournaments WHERE competition = $competition_id AND completed = true";
	$tournament_query = $connectDB->query($tournaments);
	
	$tournament_list = array();
	
	while ($dataRows = $tournament_query->fetch()) {

		$id = $dataRows["id"];
		$year = $dataRows["year"];
		$host = $dataRows["host"];
		$host_2 = $dataRows["host_2"];
		$host_3 = $dataRows["host_3"];
		$winner = $dataRows["winner"];
		$runner_up = $dataRows["runner_up"];
		$on_site = $dataRows["on_site"];
		
		$tournament_list[] = $dataRows;
		
	}
	
?>

	<div class="page-template">
		
		<h1 class="info-page">
			<?php echo htmlentities($name); ?>
		</h1>
		
		<?php
		
			echo htmlentities($profile);
		
			if (!$tournament_list) {
				echo "<h2>Editions of this competition will appear here when added to the site.</h2>";
			} else {
				echo '<div class="sub-menu"><h2>Competition History</h2><div>';
			}
		
		?>	
		
		<table class="tournament-list">
			<tr>
				<td>Year</td>
				<td>Host</td>
				<td>Winner</td>
				<td>Runner-Up</td>
			</tr>
			
			<?php
					
				foreach ($tournament_list as $tournament_menu) {
									
					echo '<tr>';
					echo '<td>';
					if ($tournament_menu["on_site"] == true) {
						echo '<a class="standard-link" href="tournament.php?id='.$tournament_menu["id"].'">'.$tournament_menu["year"].'</a>';
					} else {
						echo $tournament_menu["year"];
					}
					echo '</td>';
					echo '<td>';
					echo '<img class="poll-icon" src="img/flags/'.strtolower($tournament_menu["host"]).'.png" alt="'.strtolower($tournament_menu["host"]).'">  '.$tournament_menu["host"];
					if ($tournament_menu["host_2"]) {
						echo '<br><img class="poll-icon" src="img/flags/'.strtolower($tournament_menu["host_2"]).'.png" alt="'.strtolower($tournament_menu["host_2"]).'">  '.$tournament_menu["host_2"];
					}
					if ($tournament_menu["host_3"]) {
						echo '<br><img class="poll-icon" src="img/flags/'.strtolower($tournament_menu["host_3"]).'.png" alt="'.strtolower($tournament_menu["host_3"]).'">  '.$tournament_menu["host_3"];
					}
					echo '</td>';
					echo '<td><img class="poll-icon" src="img/flags/'.strtolower($tournament_menu["winner"]).'.png" alt="'.strtolower($tournament_menu["winner"]).'">  '.$tournament_menu["winner"].'</td>';
					echo '<td><img class="poll-icon" src="img/flags/'.strtolower($tournament_menu["runner_up"]).'.png" alt="'.strtolower($tournament_menu["runner_up"]).'">  '.$tournament_menu["runner_up"].'</td>';
					echo '</tr>';
								
				}
				
			?>
			
		</table>
		
	</div>
	
<?php

	include 'inc/footer.html';
	
?>
