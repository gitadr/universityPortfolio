<!DOCTYPE html>

<!-- BEGIN html -->
<html <?php language_attributes(); ?>>
<!-- An Orman Clark design (http://www.premiumpixels.com) - Proudly powered by WordPress (http://wordpress.org) -->

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<!-- Title -->
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/<?php echo get_option('tz_alt_stylesheet'); ?>" type="text/css" media="screen" />
	
	<!-- RSS & Pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if (get_option('tz_feedburner')) { echo get_option('tz_feedburner'); } else { bloginfo( 'rss2_url' ); } ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>

	<!-- BEGIN #container -->
	<div id="container">
    
    	<div id="loader" data-loader="<?php echo get_template_directory_uri(); ?>/images/<?php if(get_option('tz_alt_stylesheet') == 'dark.css'):?>dark<?php else: ?>light<?php endif; ?>/ajax-loader.gif" class="hidden"></div>
	
		<!-- BEGIN #header -->
		<div id="header" class="clearfix">
        	
            <!-- BEGIN #header-top -->
        	<div id="header-top" class="clearfix">
			
                <!-- BEGIN #logo -->
                <div id="logo">
                    <?php /*
                    If "plain text logo" is set in theme options then use text
                    if a logo url has been set in theme options then use that
                    if none of the above then use the default logo.png */
                    if (get_option('tz_plain_logo') == 'true') { ?>
                    <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
                    <p id="tagline"><?php bloginfo( 'description' ); ?></p>
                    <?php } elseif (get_option('tz_logo')) { ?>
                    <a href="<?php echo home_url(); ?>"><img src="<?php echo get_option('tz_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
                    <?php } else { ?>
                        <?php if(get_option('tz_alt_stylesheet') == 'dark.css' || get_option('tz_alt_stylesheet') == '') : ?>
                            <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/dark/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
                        <?php else: ?>
                            <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/light/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
                        <?php endif; ?>
                    <?php } ?>
                <!-- END #logo -->
                </div>
                
                <!-- BEGIN #primary-nav -->
                <div id="primary-nav">
                    <?php 
                    wp_nav_menu( array( 
                        'theme_location' => 'primary-menu', 
                        'container' => '', 
                        'before' => '<span>/</span>',
                        'fallback_cb' => '' 
                    ) ); 
                    ?>
                <!-- END #primary-nav -->
                </div>
            
            <!-- END #header-top -->
            </div>
            
            <?php 
			
			$curauth = get_userdata(get_query_var('author'));
			
			if(get_query_var('author_name'))
				$curauth = get_userdatabylogin(get_query_var('author_name'));
			
			$tagline = get_option('tz_tagline');
			$blog_page = get_option('tz_blog_page');
			
			global $wp_query;
			
			// Took me ages to work this badger out! (Gets the posts page ID)
			$page_id = $wp_query->get_queried_object_id();
		
			if($page_id == $blog_page)
				$page_id = $blog_page;
			
			$caption = get_post_meta($page_id, 'tz_page_caption', TRUE); 
			$single = get_post_meta($blog_page, 'tz_page_caption', TRUE); 
			
			if($caption == '')
				$caption = $tagline;			

			?>

            <!-- BEGIN #tagline -->
            <div id="tagline">
                
			<?php /* If this is a page */ if (is_page() || $page_id == $blog_page) { ?>
            	<h1 class="page-title"><?php echo stripslashes(nl2br(htmlspecialchars_decode($caption))); ?></h1>
            <?php /* If this is a post */ } elseif (is_single()) { ?>
            	<h1 class="page-title"><?php echo stripslashes(nl2br(htmlspecialchars_decode($single))); ?></h1>
            <?php /* If this is a category archive */ }  elseif (is_search()) { ?>  
            	<h1 class="page-title"><?php printf(__('Searching for %s', 'framework'), '<span>'.$_GET['s'].'<span>'); ?></h1>
			<?php /* If this is a category archive */ } elseif (is_category()) { ?>
            	<h1 class="page-title"><?php printf(__('All posts in %s', 'framework'), single_cat_title('',false)); ?></h1>
            <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
            	<h1 class="page-title"><?php printf(__('All posts tagged %s', 'framework'), single_tag_title('',false)); ?></h1>
	 	  	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h1 class="page-title"><?php _e('Archive for', 'framework') ?> <?php the_time('F jS, Y'); ?></h1>
	 	 	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h1 class="page-title"><?php _e('Archive for', 'framework') ?> <?php the_time('F, Y'); ?></h1>
	 		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h1 class="page-title"><?php _e('Archive for', 'framework') ?> <?php the_time('Y'); ?></h1>
		  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h1 class="page-title"><?php _e('All posts by', 'framework') ?> <?php echo $curauth->display_name; ?></h1>
	 	  	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1 class="page-title"><?php _e('Blog Archives', 'framework') ?></h1>
	 	  	<?php } ?>
	
                
                <div class="seperator clearfix">
                	<span class="line"></span>
                </div>
            
            <!-- END #tagline -->
            </div>
			
		<!--END #header-->
		</div>
        
        <?php 
		
		$magic_door = get_option('tz_magic_door');
        $post_id = get_option('tz_magic_door_state');
		
		?>
        
        <div id="loading">Loading...</div>
        <div id="door-frame" <?php if($post_id != '') : ?>class="open" data-id="<?php echo $post_id; ?>" <?php endif; ?>> 
			<div id="magic-door" data-url="<?php echo get_template_directory_uri(); ?>/includes/home-magicdoor.php">
            	
            </div>
        </div>
        

		<!--BEGIN #content -->
		<div id="content" class="clearfix">
		