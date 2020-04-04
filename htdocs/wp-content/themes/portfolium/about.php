<?php
/*
Template Name: About
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

    <div <?php post_class('clear'); ?> id="post-<?php the_ID(); ?>">
        <div class="about_meta">
         <p class="about_meta_q">Name</p>
         <p class="about_meta_a">Aaron Root</p>
         <br>
         <p class="about_meta_q">Location </p>
         <p class="about_meta_a">Essex, UK.</p>
         <br>
         <p class="about_meta_q">Studying </p>
         <p class="about_meta_a">Graphic Media</p>
         <br>
         <p class="about_meta_q">Twitter </p>
         <p class="about_meta_a"><a href="http://www.twitter.com/tweetadr" class="bodylink">@tweetadr</p></a>
           
        </div>
        <div class="post_content">
            <?php the_content(); ?>
        </div>
    </div>


    <?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>

</div>

<?php get_footer(); ?>