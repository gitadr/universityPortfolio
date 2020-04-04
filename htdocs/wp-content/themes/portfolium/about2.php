<?php
/*
Template Name: About 2
*/
?>

<?php get_header(); ?>


<div id="aboutwrapper">
<div id="aboutme">

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

    <div <?php post_class('clear'); ?> id="post-<?php the_ID(); ?>">
    
        <div class="post_content">
        <?php echo get_the_title(ID) ?>

            <?php the_content(); ?>
        </div>
    </div>


    <?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>

</div>



<div id="aboutsocial">

<div id="aboutleft"></div>
<div id="aboutright"></div>

</div>




</div>

<?php get_sidebar( $Sidebar ); ?>






<?php get_footer(); ?>