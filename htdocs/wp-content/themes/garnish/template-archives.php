<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

		

			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
                <!--BEGIN .hentry -->
                <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                    
                    
                    <h2 class="entry-title"><?php the_title(); ?></h2>
                
                    <!--BEGIN .entry-content -->
                    <div class="entry-content">
                        <?php the_content('<span>Continue Reading</span>'); ?>
                        <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                        
                        <!--BEGIN .archive-lists -->
                        <div class="archive-lists">
                            
                            <h4><?php _e('Last 30 Posts', 'framework') ?></h4>
                            
                            <ul>
                            <?php $archive_30 = get_posts('numberposts=30&posttype=post,portfolio');
                            foreach($archive_30 as $post) : ?>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
                            <?php endforeach; ?>
                            </ul>
                            
                            <h4><?php _e('Archives by Month:', 'framework') ?></h4>
                            
                            <ul>
                                <?php wp_get_archives('type=monthly'); ?>
                            </ul>
                
                            <h4><?php _e('Archives by Subject:', 'framework') ?></h4>
                            
                            <ul>
                                <?php wp_list_categories( 'title_li=' ); ?>
                            </ul>
                        
                        <!--END .archive-lists -->
                        </div>
                    
                    <!--END .entry-content -->
                    </div>

                <!--END .hentry-->  
                </div>

				<?php endwhile; endif; ?>
			
			<!--END #primary .hfeed-->
			</div>
			
<?php get_sidebar(); ?>

<?php get_footer(); ?>