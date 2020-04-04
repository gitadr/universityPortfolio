<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

    <div class="container clear">
        <div class="content">
            <div id="show">
                <?php
                    $args = array(
                        'post_type' => 'attachment',
                        'numberposts' => -1,
                        'post_status' => null,
                        'post_parent' => $post->ID,
                        'exclude' => get_post_thumbnail_id()
                    );
                    $attachments = get_posts($args);
                    if ( $attachments ):
                        foreach ( $attachments as $attachment ):
                            echo wp_get_attachment_image($attachment->ID, 'full');
                        endforeach;
                    endif;
                ?>
            </div>
        </div>
        <div class="l_col">
            <div class="post_portfolio">
                <h2><?php the_title(); ?></h2>
                <p class="post_date"><?php the_time(__('F jS, Y')) ?></p>
                <br/>
                
                <p class="post_divider">&mdash;</p>
                <div class="post_text"><?php the_content(); ?>&mdash;</div>
                
                <div class="post_share"<br /><a href="javascript: void(0);" class="sharethis">Share</a>
                <ul class="sharelist">
                    <li><a href="http://facebook.com/share.php?u=<?php the_permalink() ?>&amp;t=<?php echo urlencode(the_title('','', false)) ?>" target="_blank">Facebook</a>
    </li>
                    <li><a href="http://twitter.com/home?status=<?php the_title(); ?> <?php echo getTinyUrl(get_permalink($post->ID)); ?>" target="_blank">Twitter</a></li>
                    <li><a href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>" target="_blank">Digg</a>
    </li>
                    <li><a href="http://stumbleupon.com/submit?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('','', false)) ?>" target="_blank">StumbleUpon</a>
    </li>
                    <li><a href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('','', false)) ?>" target="_blank">Del.icio.us</a>
    </li>
                </ul>
            </div>

            </div>
        </div>
    </div>

    <?php endwhile;?>
<?php endif; ?>

<div class="recent clear">
    <h3>Recent works</h3>
    <?php
        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        query_posts(
            array(
                'post_type' => 'portfolio',
                'works' => $term->slug,
                'posts_per_page' => 12,
                'post__not_in' => array($post->ID)
            )
        );
    ?>
    <?php get_template_part('loop-portfolio');  // Loop template for portfolio (loop-portfolio.php) ?>
    <?php  wp_reset_query(); ?>
</div>

<?php get_footer(); ?>
