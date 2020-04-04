<?php get_header(); ?>
			
			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
            
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                
                <!--BEGIN .the_format .clearfix-->
                <div class="the_format clearfix">
				
				<?php
                
                    // The following determines what the post format is and shows the correct file accordingly
                    $format = get_post_format();
                    get_template_part( 'includes/'.$format );
                    
                    if($format == '')
                    get_template_part( 'includes/standard' );
                    
                ?>
                
                <!--END .the_format .clearfix-->
                </div>
				
				<?php comments_template('', true); ?>

				<?php endwhile; endif; ?>

			<!--END #primary .hfeed-->
			</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>