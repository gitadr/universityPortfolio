		<!--BEGIN #sidebar .aside-->
		<div id="sidebar" class="aside">
			
			<?php 
			if(!is_page() && get_post_type() != 'portfolio') {
				
				dynamic_sidebar();
				
			} elseif(get_post_type() == 'portfolio') {
				
				dynamic_sidebar('Portfolio Sidebar'); 
				
			} else {

				dynamic_sidebar('Page Sidebar'); 
			}
			
			?>
		<!--END #sidebar .aside-->
		</div>