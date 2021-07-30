
<div class="pagination">

	<table>

		<tr>
		
			<?php
			
				$total_pages = ceil($total_items / $page_items);
				$max_pages = 5;
				
				if ($page_id > 1) {
					echo '<td><a class="pagination-link" href="'.$pagination_page.'.php?id=1">&lt;&lt;</a></td>';
				}
				
				if ($page_id > 2) {
					echo '<td><a class="pagination-link" href="'.$pagination_page.'.php?id='.$page_id - 1 .'">&lt;</a></td>';
				}
				
				if ($total_pages <= $max_pages) {
					
					for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
					
						if ($page_number == $page_id) {
							echo '<td class="current-page">'.$page_number.'</td>';			
						} else {
							echo '<td><a class="pagination-link" href="'.$pagination_page.'.php?id='.$page_number.'">'.$page_number.'</a></td>';
						}
							
					}
					
				} else {
					
					$iteration = 1;
					
					if ($page_id < 3) {
						
						$page_number = 1;
					
					} elseif ($page_id > $total_pages - 2) {
						
						$page_number = $total_pages - 4;
					
					} else {
						
						$page_number = $page_id - 2;
					
					}
						
					while ($iteration <= $max_pages) {
							
						if ($page_number == $page_id) {
							echo '<td class="current-page">'.$page_number.'</td>';			
						} else {
							echo '<td><a class="pagination-link" href="'.$pagination_page.'.php?id='.$page_number.'">'.$page_number.'</a></td>';
						}
							
						$iteration++;
						$page_number++;
							
					}
					
				}			
				
				if ($page_id < $total_pages - 1) {
					echo '<td><a class="pagination-link" href="'.$pagination_page.'.php?id='.$page_id + 1 .'">&gt;</a></td>';			
				}			
				
				if ($page_id < $total_pages) {
					echo '<td><a class="pagination-link" href="'.$pagination_page.'.php?id='.$total_pages.'">&gt;&gt;</a></td>';				
				}
				
			?>
			
		</tr>

	</table>

</div>
