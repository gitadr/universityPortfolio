<?php
/*
	Plugin Name:	ImageLink
	Plugin URI:		http://www.sterling-adventures.co.uk/blog/2007/06/22/theme-plugin/
	Description:	A plugin which looks for &lt;IMG&gt; tags in the excerpt and, if found, wraps them with a link to the post permalink.
	Author:			Peter Sterling
	Version:		0.2
	Author URI:		http://www.sterling-adventures.co.uk/
*/

add_filter('the_excerpt', 'the_excerpt_imagelink');

function the_excerpt_imagelink($content)
{
	global $post;
	$content = eregi_replace('(<img [^>]*>)', '<a href="' . get_permalink() . '" rel="bookmark" class="imagelink" title="Permanent Link to ' . $post->post_title . '">' . '\1</a>', $content);
	return $content;
}
?>
