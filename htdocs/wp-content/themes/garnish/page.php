<?php get_header(); ?>

			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
            	<!--BEGIN .clearfix-->
                <div class="clearfix">
                
                    <!--BEGIN .hentry -->
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                        
                        <h2 class="entry-title"><?php the_title(); ?></h2>
                    
                        <!--BEGIN .entry-content -->
                        <div class="entry-content">
                            <?php the_content('<span>Continue Reading</span>'); ?>
                            <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                        <!--END .entry-content -->
                        </div>
                    
                    <!--END .hentry-->  
                    </div>
                
                <!--END .clearfix-->  
                </div>
				
				<?php comments_template('', true); ?>

				<?php endwhile; endif; ?>
			
			<!--END #primary .hfeed-->
			</div>
			
<?php get_sidebar(); ?>

<?php get_footer(); ?>