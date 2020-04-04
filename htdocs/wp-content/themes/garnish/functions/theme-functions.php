<?php

/* These are functions specific to the included option settings and this theme */


/*-----------------------------------------------------------------------------------*/
/* Output Custom CSS from theme options
/*-----------------------------------------------------------------------------------*/

function tz_head_css() {

		$shortname =  get_option('tz_shortname'); 
		$output = '';
		
		$custom_css = get_option('tz_custom_css');
		
		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}
		
		// Output styles
		if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo stripslashes($output);
		}
	
}

add_action('wp_head', 'tz_head_css');


/*-----------------------------------------------------------------------------------*/
/* Add Body Classes for Layout
/*-----------------------------------------------------------------------------------*/

add_filter('body_class','tz_body_class');
 
function tz_body_class($classes) {
	$shortname = get_option('tz_shortname');
	$layout = get_option($shortname .'_layout');
	if ($layout == '') {
		$layout = 'layout-2cr';
	}
	$classes[] = $layout;
	return $classes;
}


/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

function tz_favicon() {
	$shortname = get_option('tz_shortname');
	if (get_option($shortname . '_custom_favicon') != '') {
	echo '<link rel="shortcut icon" href="'. get_option('tz_custom_favicon') .'"/>'."\n";
	}
	else { ?>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/admin/images/favicon.ico" />
	<?php }
}

add_action('wp_head', 'tz_favicon');


/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function tz_analytics(){
	$shortname =  get_option('tz_shortname');
	$output = get_option($shortname . '_google_analytics');
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','tz_analytics');


/*-----------------------------------------------------------------------------------*/
/*	Helpful function to see if a number is a multiple of another number
/*-----------------------------------------------------------------------------------*/

function is_multiple($number, $multiple) 
{ 
    return ($number % $multiple) == 0; 
}


/*-----------------------------------------------------------------------------------*/
/*	Apply JS code for contact page
/*-----------------------------------------------------------------------------------*/

function tz_contact_validate() {
	if (is_page_template('template-contact.php')) { ?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("#contactForm").validate();
			});
		</script>
	<?php }
}
add_action('wp_head', 'tz_contact_validate');

/*-----------------------------------------------------------------------------------*/
/*	List categories for the portfolio
/*-----------------------------------------------------------------------------------*/

class Portfolio_Walker extends Walker_Category {
   function start_el(&$output, $category, $depth, $args) {
      extract($args);
      $cat_name = esc_attr( $category->name);
      $cat_name = apply_filters( 'list_cats', $cat_name, $category );
      $link = '<a href="" data-value="term-'.$category->term_id.'" ';
      if ( $use_desc_for_title == 0 || empty($category->description) )
         $link .= 'title="' . sprintf(__( 'View all items filed under %s' ), $cat_name) . '"';
      else
         $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
      $link .= '>';
      // $link .= $cat_name . '</a>';
      $link .= $cat_name;
      if(!empty($category->description)) {
         $link .= ' <span>'.$category->description.'</span>';
      }
      $link .= '</a>';
      if ( (! empty($feed_image)) || (! empty($feed)) ) {
         $link .= ' ';
         if ( empty($feed_image) )
            $link .= '(';
         $link .= '<a href="' . get_category_feed_link($category->term_id, $feed_type) . '"';
         if ( empty($feed) )
            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
         else {
            $title = ' title="' . $feed . '"';
            $alt = ' alt="' . $feed . '"';
            $name = $feed;
            $link .= $title;
         }
         $link .= '>';
         if ( empty($feed_image) )
            $link .= $name;
         else
            $link .= "<img src='$feed_image'$alt$title" . ' />';
         $link .= '</a>';
         if ( empty($feed_image) )
            $link .= ')';
      }
      if ( isset($show_count) && $show_count )
         $link .= ' (' . intval($category->count) . ')';
      if ( isset($show_date) && $show_date ) {
         $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
      }
      if ( isset($current_category) && $current_category )
         $_current_category = get_category( $current_category );
      if ( 'list' == $args['style'] ) {
          $output .= '<li ';
          $class = 'cat-item cat-item-'.$category->term_id;
          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
             $class .=  ' current-cat';
          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
             $class .=  ' current-cat-parent';
          $output .=  '';
          $output .= ">$link <span>/</span>\n";
       } else {
          $output .= "\t$link<br />\n";
       }
   }
}

function tz_featured_image($postid, $echo = FALSE) {
	
	$featured = get_the_post_thumbnail( $postid, 'thumbnail-portfolio' );
	$custom = get_post_meta($postid, 'tz_portfolio_thumb', TRUE); 
	
	if($featured == '' && $custom == '')
		$featured = '';
		
	$output = $featured;
	
	if($custom != '')
		$output = '<img src="'.$custom.'" alt="'.get_the_title().'" />';
	
	if($echo) {
		echo $output;
	} else {
		return $output;
	}
	
}

/*-----------------------------------------------------------------------------------*/
/*	Audio JS
/*-----------------------------------------------------------------------------------*/

function tz_audio($postid) {
	
	$mp3 = get_post_meta($postid, 'tz_audio_mp3', TRUE);
	$ogg = get_post_meta($postid, 'tz_audio_ogg', TRUE);
	
	 ?>
		<script type="text/javascript">
		
			jQuery(document).ready(function(){
	
				if(jQuery().jPlayer) {
					jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
						ready: function () {
							jQuery(this).jPlayer("setMedia", {
								<?php if($mp3 != '') : ?>
								mp3: "<?php echo $mp3; ?>",
								<?php endif; ?>
								<?php if($ogg != '') : ?>
								oga: "<?php echo $ogg; ?>",
								<?php endif; ?>
								end: ""
							});
						},
						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
						cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
						supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
					});
					
				}
			});
		</script>
		
	    <div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer"></div>

        <div class="jp-audio-container">
            <div class="jp-audio">
                <div class="jp-type-single">
                    <div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
                        <ul class="jp-controls">
                            <li><div class="seperator-first"></div></li>
                            <li><div class="seperator-second"></div></li>
                            <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                            <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                            <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                            <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                        </ul>
                        <div class="jp-progress-container">
                            <div class="jp-progress">
                                <div class="jp-seek-bar">
                                    <div class="jp-play-bar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="jp-volume-bar-container">
                            <div class="jp-volume-bar">
                                <div class="jp-volume-bar-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php 
}


/*-----------------------------------------------------------------------------------*/
/*	Video JS
/*-----------------------------------------------------------------------------------*/

function tz_video($postid, $width) {
	
	$m4v = get_post_meta($postid, 'tz_video_m4v', TRUE);
	$ogv = get_post_meta($postid, 'tz_video_ogv', TRUE);
	$poster = get_post_meta($postid, 'tz_video_poster', TRUE);
	$height = get_post_meta($postid, 'tz_video_height', TRUE); 
	
?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			
			if(jQuery().jPlayer) {
				jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
					ready: function () {
						jQuery(this).jPlayer("setMedia", {
							<?php if( !empty($m4v) ) { ?>
							m4v: "<?php echo $m4v; ?>",
							<?php } ?>
							<?php if( !empty($ogv) ) { ?>
							ogv: "<?php echo $ogv; ?>",
							<?php } ?>
							<?php if( !empty($poster) ) { ?>
							poster: "<?php echo $poster; ?>"
							<?php } ?>
						});
					},
					size: {
					    width: "<?php echo $width; ?>",
					    height: "<?php echo $height . 'px'; ?>"
					},
					swfPath: "<?php echo get_template_directory_uri(); ?>/js",
					cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
					supplied: "<?php if( !empty($m4v) ) { ?>m4v, <?php } ?><?php if( !empty($ogv) ) { ?>ogv, <?php } ?> all"
				});
				
			}
		});
	</script>
	
    <div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-video"></div>
    
    <div class="jp-video-container">
        <div class="jp-video">
            <div class="jp-type-single">
                <div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
                    <ul class="jp-controls">
                        <li><div class="seperator-first"></div></li>
                        <li><div class="seperator-second"></div></li>
                        <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                        <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                        <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                        <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                    </ul>
                    <div class="jp-progress-container">
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                    </div>
                    <div class="jp-volume-bar-container">
                        <div class="jp-volume-bar">
                            <div class="jp-volume-bar-value"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php 
}