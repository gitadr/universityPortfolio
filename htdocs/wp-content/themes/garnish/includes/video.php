<div class="published">
    <?php the_time( get_option('date_format') ); ?><span><a title="<?php _e('Permalink', 'framework'); ?>" href="<?php the_permalink(); ?>">#</a></span>
</div>

<!--BEGIN .hentry -->
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php 
	    // load our self hosted video if provided
    	$embed = get_post_meta($post->ID, 'tz_video_embed', TRUE);
    	if( empty($embed) ) { 
    		tz_video( $post->ID, '500px' );
        } else {
            echo stripslashes(htmlspecialchars_decode($embed));
        } 
    ?>

    <!--BEGIN .entry-content -->
    <div class="entry-content">
        <?php the_content(''); ?>
    <!--END .entry-content -->
    </div>
    
    <?php get_template_part('includes/post-meta'); ?>

<!--END .hentry-->  
</div>