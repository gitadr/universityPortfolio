<?php

add_theme_support('automatic-feed-links'); // Add default posts and comments RSS feed links to head

/*** Top navigation ***/

function register_menu() {
    register_nav_menu('Header', __('Header'));
}
add_action( 'init', 'register_menu' );

if ( !is_nav_menu('Header')) {
    $menu_id = wp_create_nav_menu('Header');
    wp_update_nav_menu_item($menu_id, 1);
}

/*** Comment list ***/

function commentlist($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li id="li-comment-<?php comment_ID() ?>">
        <div class="comment_meta"><?php printf( __('%1$s'), get_comment_author_link()); ?> says: <span><?php printf( __('%1$s'), get_comment_date()); ?><em><?php printf( __('%1$s'), get_comment_time()); ?></em></span></div>
        <div class="comment_text"><?php comment_text() ?></div>
        <div class="clear"></div>
<?php
}

/*** Sidebar ***/

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'Sidebar',
        'before_widget' => '<div id="%1$s" class="%2$s widget">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><div class="widget_body">',
    ));

/*** Misc ***/

function commentdata_fix($commentdata) {
    if ( $commentdata['comment_author_url'] == 'Website') {
        $commentdata['comment_author_url'] = '';
    }
    if ($commentdata['comment_content'] == 'Comment') {
        $commentdata['comment_content'] = '';
    }
    return $commentdata;
}
add_filter('preprocess_comment','commentdata_fix');

function getTinyUrl($url) {
    $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);
    return $tinyurl;
}

function n_posts_link_attributes(){
	return 'class="nextpostslink"';
}
function p_posts_link_attributes(){
	return 'class="previouspostslink"';
}
add_filter('next_posts_link_attributes', 'n_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'p_posts_link_attributes');

function get_comment_date_formatted($commentdate) {
    $commentdate =  explode(' ', $commentdate);
    $commentdate = explode('-', $commentdate[0]);
    echo $commentdate[2].'-'.$commentdate[1].'-'.$commentdate[0];
}



/*** Slideshow ***/

$prefix = 'sgt_';

$meta_box = array(
    'id' => 'slide',
    'title' => 'Slideshow Options',
    'page' => 'post',
    'context' => 'side',
    'priority' => 'low',
    'fields' => array(
        array(
            'name' => 'Show in slideshow',
            'id' => $prefix . 'slide',
            'type' => 'checkbox'
        )
    )
);
add_action('admin_menu', 'sight_add_box');

// Add meta box
function sight_add_box() {
    global $meta_box;

    add_meta_box($meta_box['id'], $meta_box['title'], 'sight_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function sight_show_box() {
    global $meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="sight_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
                '<th style="width:50%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
        echo     '<td>',
            '</tr>';
    }

    echo '</table>';
}

add_action('save_post', 'sight_save_data');

// Save data from meta box
function sight_save_data($post_id) {
    global $meta_box;

    // verify nonce
    if (!wp_verify_nonce($_POST['sight_meta_box_nonce'], basename(__FILE__))) {
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

    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
?>