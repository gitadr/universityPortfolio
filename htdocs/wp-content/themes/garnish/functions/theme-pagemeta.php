<?php

/*-----------------------------------------------------------------------------------

	Add "Heading" custom fields to pages + posts

-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Define Metabox Fields
/*-----------------------------------------------------------------------------------*/

$prefix = 'tz_';

$tz_heading_meta_boxes = array(
	'id' => 'tz-meta-box-page',
	'title' =>  __('Caption Settings', 'framework'),
	'fields' => array(
		array( "name" => __('Optional Caption','framework'),
				"desc" => __('Write an option page caption','framework'),
				"id" => $prefix."page_caption",
				"type" => "textarea",
				"std" => ''
			),
	),
);


/*-----------------------------------------------------------------------------------*/
/*	Show fields in meta box
/*-----------------------------------------------------------------------------------*/

function tz_heading_meta_boxes() {
	global $tz_heading_meta_boxes, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="tz_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($tz_heading_meta_boxes['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			//If textarea		
			case 'textarea':
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			
			break;

		}

	}
 
	echo '</table>';
}


/*-----------------------------------------------------------------------------------*/
/*	Add metabox to pages
/*-----------------------------------------------------------------------------------*/

function create_meta_box() {
global $tz_heading_meta_boxes;
	if (function_exists('add_meta_box') ) {
	add_meta_box( 'new-meta-boxes', __('Page Caption Settings', 'framework'), 'tz_heading_meta_boxes', 'page', 'normal', 'high' );
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/

function tz_save_page_data($post_id) {
	global $tz_heading_meta_boxes;
 
	// verify nonce
	if (!wp_verify_nonce($_POST['tz_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	foreach ($tz_heading_meta_boxes['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'tz_save_page_data');



?>