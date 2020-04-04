
		
        <div class="published"><?php the_time( get_option('date_format') ); ?><span><a title="<?php _e('Permalink', 'framework'); ?>" href="<?php the_permalink(); ?>">#</a></span></div>
        
        
        <!--BEGIN .hentry -->
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        
        	<!--BEGIN .slider -->
            <div class="slider">
            
            <?php 
                $args = array(
                    'orderby'		 => 'menu_order',
                    'post_type'      => 'attachment',
                    'post_parent'    => get_the_ID(),
                    'post_mime_type' => 'image',
                    'post_status'    => null,
                    'numberposts'    => -1,
                );
                $attachments = get_posts($args);
            ?>
                
                <?php if ($attachments) : ?>
                
                <!--BEGIN .slides_container -->
                <div class="slides_container">
                
                <?php foreach ($attachments as $attachment) : ?>
                    
                    <?php $src = wp_get_attachment_image_src( $attachment->ID, 'gallery-thumb'); ?>
                    
                    <div>
                    <img 
                    height="<?php echo $src[2]; ?>"
                    width="<?php echo $src[1]; ?>"
                    alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>" 
                    src="<?php echo $src[0]; ?>" 
                    />
                    </div>
                
                <?php endforeach; ?>
                
                <!--END .slides_container -->
                </div>
                <?php endif; ?>

            <!--END .slider -->
            </div>
        
            <!--BEGIN .entry-content -->
            <div class="entry-content">
                <?php the_content(''); ?>
            <!--END .entry-content -->
            </div>
            
            <?php get_template_part('includes/post-meta'); ?>
        
        <!--END .hentry-->  
        </div>