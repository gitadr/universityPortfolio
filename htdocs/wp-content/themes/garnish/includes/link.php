
		
        <div class="published"><?php the_time( get_option('date_format') ); ?><span><a title="<?php _e('Permalink', 'framework'); ?>" href="<?php the_permalink(); ?>">#</a></span></div>
        
        <!--BEGIN .hentry -->
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        
        	<?php $url =  get_post_meta(get_the_ID(), 'tz_link_url', true); ?>
                
            <h2 class="entry-title">
                <a target="_blank" href="<?php echo $url; ?>" title="<?php _e('Permalink to:', 'framework');?> <?php echo $url; ?>"><span><?php the_title(); ?></span></a>
            </h2>
        
            <!--BEGIN .entry-content -->
            <div class="entry-content">
                <?php the_content(''); ?>
            <!--END .entry-content -->
            </div>
            
            <?php get_template_part('includes/post-meta'); ?>
        
        <!--END .hentry-->  
        </div>