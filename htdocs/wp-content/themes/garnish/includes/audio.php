<div class="published">
    <?php the_time( get_option('date_format') ); ?><span><a title="<?php _e('Permalink', 'framework'); ?>" href="<?php the_permalink(); ?>">#</a></span>
</div>

<!--BEGIN .hentry -->
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php tz_audio( $post->ID ); ?>

    <!--BEGIN .entry-content -->
    <div class="entry-content">
        <?php the_content(''); ?>
    <!--END .entry-content -->
    </div>
    
    <?php get_template_part('includes/post-meta'); ?>

<!--END .hentry-->  
</div>