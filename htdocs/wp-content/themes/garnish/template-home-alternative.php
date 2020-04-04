<?php
/*
Template Name: Home Alternative
*/
?>

<?php get_header(); ?>

			<!--BEGIN #portfolio-terms--> 
            <div id="portfolio-terms">
            
                <ul>
                    <li><a href="#" class="all current"><?php _e('All', 'framework'); ?></a><span>/</span></li>
                    <?php 
					wp_list_categories(array(
							'title_li' => '', 
							'taxonomy' => 
							'skill-type', 
							'walker' => new Portfolio_Walker(),
							'show_option_none' => ''
						)
					); ?>
                </ul>
            
            <!--END #portfolio-terms-->
            </div>

			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
                
                <?php
                
				//Grab magic door option
				$magic_door = get_option('tz_magic_door');
				
				$post_id = get_option('tz_magic_door_state');
				
				if($magic_door != 'true')
					$magic_door = FALSE;
					
				if($post_id == '')
					$post_id = FALSE;
					
				if ( get_query_var('paged') ) {
					$paged = get_query_var('paged');
				} else if ( get_query_var('page') ) {
					$paged = get_query_var('page');
				} else {
					$paged = 1;
				}
				
				query_posts('post_type=portfolio&paged='.$paged);

                ?>
            
                <ul id="portfolio-items" class="<?php if($magic_door) : ?>enabled<?php endif; ?> clearfix">
                        
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                
                	<?php
					
					//Get the terms
					$terms = get_the_terms( get_the_ID(), 'skill-type' );
				
					$output = '';
					
					//If there are any terms then store them
					if($terms) {
						foreach ($terms as $term) { 
							$output .= 'term-'.$term->term_id.' '; 
						} 
					}
					
					?>
                    
                    <li id="portfolio-<?php the_ID(); ?>" class="<?php echo $output; ?>visible">
                    
                        <!--BEGIN .hentry -->
                        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                            
                            <a class="entry-link" href="<?php the_permalink(); ?>"></a>
                            
                            <?php tz_featured_image(get_the_ID(), TRUE); ?>
                            
                            <!--BEGIN .overlay -->
                            <div class="overlay">
                            
                                <h3 class="entry-title"><?php the_title(); ?></h3>
                                
                                <div class="seperator clearfix">
                                    <span class="line"></span>
                                </div>
                                
                                <!--BEGIN .entry-content -->
                                <div class="entry-content">
                                    <?php the_excerpt(); ?>
                                <!--END .entry-content -->
                                </div>
                                
                                <div class="arrow"></div>
                            
                            <!--END .overlay -->
                            </div>
            
                        <!--END .hentry-->  
                        </div>
                    
                    </li>
                    
                    <?php endwhile; endif; ?>
                    
                    
                </ul>
                
                <?php if(function_exists('wp_pagenavi')) : ?>
                <!--BEGIN .page-navigation -->
                <div class="page-navigation">
                    <?php wp_pagenavi(); ?>
                <!--END .navigation .page-navigation -->
                </div>
                <?php endif; ?>
            
			<!--END #primary .hfeed-->
			</div>

<?php get_footer(); ?>