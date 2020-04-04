				
		
        <div class="published"><?php the_time( get_option('date_format') ); ?><span><a title="<?php _e('Permalink', 'framework'); ?>" href="<?php the_permalink(); ?>">#</a></span></div>
        
        <!--BEGIN .hentry -->
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        
        	<?php 
			
			if (has_post_thumbnail() ):
			
			$lightbox = get_post_meta(get_the_ID(), 'tz_image_lightbox', TRUE); 
			
			if($lightbox == 'yes') {
				$lightbox = TRUE;
			} else {
				$lightbox = FALSE;
			}
				 
			$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( '9999','9999' ), false, '' ); 
			
			 ?>
			
			<div class="post-thumb clearfix">
			
				<?php if($lightbox) : ?>
					<a class="lightbox" title="<?php the_title(); ?>" href="<?php echo $src[0]; ?>">
                    
						<span class="overlay">
							<span class="arrow"></span>
						</span>
						
						<?php the_post_thumbnail('image-thumb'); ?>
                        
					</a>
				<?php else: ?>
					
                    <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('image-thumb'); ?>
                    </a>
					
				<?php endif; ?>
				
			</div>
            
            <?php endif; ?>
            
            <!--BEGIN .entry-content -->
            <div class="entry-content">
                <?php the_content(''); ?>
            <!--END .entry-content -->
            </div>
            
            <?php get_template_part('includes/post-meta'); ?>
        
        <!--END .hentry-->  
        </div>