<?php
/*
Template Name: Sorry
*/
?>

<?php get_header(); ?>

<div id="aboutwrapper">
<div id="aboutme">

<div class="hello">Hello World...<br /> </div>

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



<div id="aboutresult">
<br />
<br />
<br />
Sorry, Something seems to have gone wrong.<br /> Please try again later.<br />



</div>
</div>
<?php get_sidebar( $Sidebar ); ?>






<?php get_footer(); ?>