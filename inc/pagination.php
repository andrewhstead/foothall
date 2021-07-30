
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
			
				for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
					
					if ($page_number == $page_id) {
						
						echo '<td class="current-page">'.$page_number.'</td>';
					
					} else {
						
						echo '<td><a class="pagination-link" href="'.$pagination_page.'.php?id='.$page_number.'">'.$page_number.'</a></td>';
					
					}
					
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
