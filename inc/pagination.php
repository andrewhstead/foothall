
<div class="pagination">

	<table>

		<tr>
			
			<td>
				<a class="pagination-link" href="<?php echo $pagination_page; ?>.php?id=1">
					&lt;&lt;
				</a>
			</td>
		
			<?php
			
				$total_pages = ceil($total_items / $page_items);
				
				if ($total_pages > 5 && $page_id > 1) {
					echo '<td><a class="pagination-link" href="'.$pagination_page.'.php?id='.$page_id - 1 .'">&lt;</a></td>';
				}
								
				for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
					
					if ($page_number == $page_id) {
						echo '<td class="current-page">'.$page_number.'</td>';			
					} else {
						echo '<td><a class="pagination-link" href="'.$pagination_page.'.php?id='.$page_number.'">'.$page_number.'</a></td>';
					}
						
				}
				
				if ($total_pages > 5 && $page_id < $total_pages) {
					echo '<td><a class="pagination-link" href="'.$pagination_page.'.php?id='.$page_id + 1 .'">&gt;</a></td>';				
				}
				
			?>
			
			<td>
				<a class="pagination-link" href="<?php echo $pagination_page; ?>.php?id=<?php echo $total_pages; ?>">
					&gt;&gt;
				</a>
			</td>
			
		</tr>

	</table>

</div>
