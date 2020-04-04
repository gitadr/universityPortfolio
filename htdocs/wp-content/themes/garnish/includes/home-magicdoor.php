<?php
	if(!function_exists('wp_head')) {
		
		if(file_exists('../../../../wp-load.php')) {
			include '../../../../wp-load.php';
		} else {
			include '../../../../../wp-load.php';
		}
		
		$postId = $_POST['id'];
		$next = $_POST['next'];
		$prev = $_POST['prev'];
		
		//Query the database
		query_posts( array (
			'post_type' => 'portfolio',
			'p' => $postId,
			)
		);
	
	}


    if (have_posts()) : while (have_posts()) : the_post(); 
	
	$image1 = get_post_meta($post->ID, 'tz_portfolio_image', TRUE); 
	$image2 = get_post_meta($post->ID, 'tz_portfolio_image2', TRUE); 
	$image3 = get_post_meta($post->ID, 'tz_portfolio_image3', TRUE); 
	$image4 = get_post_meta($post->ID, 'tz_portfolio_image4', TRUE); 
	$image5 = get_post_meta($post->ID, 'tz_portfolio_image5', TRUE);
	$image6 = get_post_meta($post->ID, 'tz_portfolio_image6', TRUE);
	$image7 = get_post_meta($post->ID, 'tz_portfolio_image7', TRUE);
	$image8 = get_post_meta($post->ID, 'tz_portfolio_image8', TRUE);
	$image9 = get_post_meta($post->ID, 'tz_portfolio_image9', TRUE);
	$image10 = get_post_meta($post->ID, 'tz_portfolio_image10', TRUE);
	$image_height = get_post_meta($post->ID, 'tz_portfolio_image_height', TRUE);
	$embed = get_post_meta($post->ID, 'tz_portfolio_embed_code', TRUE);
	$audio1 = get_post_meta($post->ID, 'tz_audio_mp3', TRUE);
	$audio2 = get_post_meta($post->ID, 'tz_audio_ogg', TRUE);
	$video_height = get_post_meta($post->ID, 'tz_video_height', TRUE);
	
    ?>
    
    <!--BEGIN #magic-door-wrap--> 
    <div id="magic-door-wrap">
    
        <!--BEGIN .inner--> 
        <div class="inner clearfix">
        
            
        	<!--BEGIN #slider-->
            <div id="slider">
        
            <?php if( !empty($image1) ) { ?>
            
                <!--BEGIN .slides_container-->
                <div class="slides_container clearfix">
            
                <?php if( !empty($image1) ) { ?>
                    <div><img height="<?php echo $image_height; ?>" src="<?php echo $image1; ?>" alt="<?php the_title(); ?>" /></div>
                <?php } ?>
            
                <?php if( !empty($image2) ) { ?>
                    <div><img src="<?php echo $image2; ?>" alt="<?php the_title(); ?>" /></div>
                <?php } ?>
            
                <?php if( !empty($image3) ) { ?>
                    <div><img src="<?php echo $image3; ?>" alt="<?php the_title(); ?>" /></div>
                <?php } ?>
            
                <?php if( !empty($image4) ) { ?>
                    <div><img src="<?php echo $image4; ?>" alt="<?php the_title(); ?>" /></div>
                <?php } ?>
            
                <?php if( !empty($image5) ) { ?>
                    <div><img src="<?php echo $image5; ?>" alt="<?php the_title(); ?>" /></div>
                <?php } ?>
            
                <?php if( !empty($image6) ) { ?>
                    <div><img src="<?php echo $image6; ?>" alt="<?php the_title(); ?>" /></div>
                <?php } ?>
            
                <?php if( !empty($image7) ) { ?>
                    <div><img src="<?php echo $image7; ?>" alt="<?php the_title(); ?>" /></div>
                <?php } ?>
            
                <?php if( !empty($image8) ) { ?>
                    <div><img src="<?php echo $image8; ?>" alt="<?php the_title(); ?>" /></div>
                <?php } ?>
            
                <?php if( !empty($image9) ) { ?>
                    <div><img src="<?php echo $image9; ?>" alt="<?php the_title(); ?>" /></div>
                <?php } ?>
            
                <?php if( !empty($image10) ) { ?>
                    <div><img src="<?php echo $image10; ?>" alt="<?php the_title(); ?>" /></div>
                <?php } ?>
            
                <!--END .slides_container .clearfix-->
                </div>

            <?php 
            } elseif( !empty($audio1) || !empty($audio2) ) {
                // audio portfolio
                tz_audio( $post->ID );
            } elseif( !empty($video_height) ) { 
                // self hosted video
                tz_video($post->ID, "680px");
            } else {
                // last option; video embed
                echo stripslashes(htmlspecialchars_decode($embed)); 
            }
            ?>

            <!--END #slider-->
            </div>
            
            <!--BEGIN .hentry -->
            <div <?php post_class() ?> id="door-<?php the_ID(); ?>">
            
            	<!-- BEGIN #portfolio-nav -->
                <div id="portfolio-nav" class="clearfix">
                    <ul>
                        <li class="portfolio-prev">
                        	<a id="prev-post" data-id="<?php echo $prev; ?>" href="#">Previous</a>
                        </li>
                        
                        <li class="portfolio-next">
                        	<a id="next-post" data-id="<?php echo $next; ?>" href="#">Next</a>
                        </li>
                        
                        <li class="portfolio-close">
                        	<a href="#">Close</a>
                        </li>
                    </ul>
                <!-- END #portfolio-nav -->
                </div>
            
                <h1 class="entry-title"><?php the_title(); ?></h1>
                
                <div class="seperator clearfix">
                    <span class="line"></span>
                </div>
                
                <!--BEGIN .entry-content -->
                <div class="entry-content">
                    <?php global $more; $more = 0; ?>
                    <?php the_content( __('Read more...', 'framework') ); ?>
                    
                <!--END .entry-content -->
                </div>
            
            <!--END .hentry-->  
            </div>
        
        <!--END .inner--> 
        </div>
        
        <img class="hidden" src="<?php echo get_template_directory_uri(); ?>/images/seperator.png" alt="" />
        
    <!--END #magic-door-wrap-->     
    </div>
    
    <?php endwhile; endif; ?>