
<div class="pagination">

	<table>

		<tr>
		
			<?php
			
				for ($page_number = 1; $page_number <= ceil($total_items / $page_items); $page_number++) {
					
					if ($page_number == $page_id) {
						
						echo '<td class="current-page">'.$page_number.'</td>';
					
					} else {
						
						echo '<td><a class="pagination-link" href="'.$pagination_page.'.php?id='.$page_number.'">'.$page_number.'</a></td>';
					
					}
					
				}
			
			?>
			
		</tr>

	</table>

</div>
