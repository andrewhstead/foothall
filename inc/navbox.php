
		<div class="navbox">
			
			<div class="navbox-head">
				<a class="header-link" href="<?php echo $navhead_page; ?>.php?id=<?php echo $navhead_parameter; ?>">
					<?php echo $navhead_text; ?>
				</a>
			</div>
			
			<div class="navbox-body">
				
				<?php
				
					$navbox_query = $connectDB->query($navbox_sql);
					
					$results = $connectDB->query($result_count);
					$total_results = $results->fetchColumn();
					
					$iteration = 0;
						
					while ($dataRows = $navbox_query->fetch()) {
						
						$count = $navbox_query->rowCount();
						$navigation_text = $dataRows[$navbox_column];
						
						if ($dataRows[$navlink_parameter] == $navbox_current) {
							echo '<span class="this-page">';
						} elseif ($dataRows["active"]) {
							echo '<a class="standard-link" href="'.$navbox_page.'.php?id='.$dataRows[$navlink_parameter].'">';
						}
						echo $navigation_text;
						if ($dataRows[$navlink_parameter] == $navbox_current) {
							echo '</span>';
						} elseif ($dataRows["active"]) {
							echo '</a>';
						}
						
						$iteration++;
						
						if ($iteration < $total_results) {
							echo ' | ';
						}
						
					}
					
				?>
			
			</div>
				
		</div>
