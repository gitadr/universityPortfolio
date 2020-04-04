<?php get_header(); ?>
			
			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
            
				<?php 
                
                if (have_posts()) : while (have_posts()) : the_post(); 
                
                    // The following determines what the post format is and shows the correct file accordingly
                    $format = get_post_format();
                    get_template_part( 'includes/'.$format );
                    
                    if($format == '')
                    get_template_part( 'includes/standard' );
                    
                endwhile; else:
				 
				 	echo '<p>'.__('Sorry, no posts were found.', 'framework').'</p>';
					
				endif;
                 
                 ?>

                <!--BEGIN .navigation .page-navigation -->
                <div class="navigation page-navigation">
                    <div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'framework')) ?></div>
                    <div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?></div>
                <!--END .navigation .page-navigation -->
                </div>

			<!--END #primary .hfeed-->
			</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>