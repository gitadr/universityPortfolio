		
        <?php if(get_post_type() != 'portfolio') : ?>
		
        <div class="published"><?php the_time( get_option('date_format') ); ?><span><a title="<?php _e('Permalink', 'framework'); ?>" href="<?php the_permalink(); ?>">#</a></span></div>
        
        <?php endif; ?>
        
        <!--BEGIN .hentry -->
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            
            <?php if(!is_singular()) : ?>
            
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'framework');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
            
            <?php else :?>
            
            <h2 class="entry-title"><?php the_title(); ?></h2>
            
            <?php endif; ?>
            
            <?php if (has_post_thumbnail() ): ?>
			
			<div class="post-thumb clearfix">
				
                <?php if(!is_singular()) : ?>
                <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('image-thumb'); ?>
                </a>
				<?php else: ?>
                	<?php the_post_thumbnail('image-thumb'); ?>
                <?php endif; ?>
                
			</div>
            
            <?php endif; ?>
        
            <!--BEGIN .entry-content -->
            <div class="entry-content">
                <?php the_content('<span>Continue Reading</span>'); ?>
            <!--END .entry-content -->
            </div>
            
            <?php get_template_part('includes/post-meta'); ?>
        
        <!--END .hentry-->  
        </div>