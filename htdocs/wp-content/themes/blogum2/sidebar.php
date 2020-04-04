<div class="sidebar">
    <?php if ( !dynamic_sidebar('Sidebar') ) : ?>
    
     <div class="widget">
            <h3>Contact Eleanor</h3>
            <div class="contact_body">
                <p>	Email: <a href="mailto:mail@eleanormayne.co.uk">mail(at)eleanormayne.co.uk</a><br />
                	Telephone: +44 7872051598
                
                
                </p>
            </div>
        </div>
        
            
        <div class="widget">
            <h3>About Eleanor</h3>
            <div class="widget_body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam venenatis sem tincidunt lectus tincidunt eu interdum tortor pulvinar. Donec sit amet nunc id nisi lacinia rhoncus. In sapien ante, mattis sed viverra ac, interdum a sem. Fusce laoreet ultricies risus, nec consequat odio faucibus at. Suspendisse potenti. Aliquam facilisis eros.
               <br><br/>
                <a href="www.adroot.co.uk/eleanor/about">Read More</a></p>
            </div>
        </div>


<div class="widget">
            <h3>Eleanor's Shop</h3>
            <div class="contact_body">
                <p>Photo prints from <a href="http://www.etsy.com/shop/AmeliaKayPhotography?section_id=6990082">Etsy</a></p>
            </div>
        </div>

        <div class="widget">
            <h3>Recent work</h3>
            <div class="widget_body">
                <ul>
                <?php
                    query_posts(array('posts_per_page' => 5));
                    if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                    <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a><span class="date"><?php the_time(__('d-m-Y')) ?></span></li>

                    <?php endwhile; endif; wp_reset_query();
                ?>
                </ul>
            </div>
        </div>
        
        <div class="widget">
            <h3>Categories</h3>
            <div class="widget_body">
                <ul>
                    <?php wp_list_categories('title_li='); ?>
                </ul>
            </div>
        </div>

        <div class="widget">
            <h3>Recent comments</h3>
            <div class="widget_body">
                <ul>
                <?php
                    $comms = get_comments('number=5');
                    foreach($comms as $comm) :
                        $post = get_post($comm->comment_post_ID); ?>
                        <li class="recentcomments"><a href="<?php echo $comm->comment_author_url; ?>" class="url"><?php echo $comm->comment_author; ?></a> on <a href="<?php echo $post->guid; ?>"><?php echo $post->post_title; ?></a><span class="date"><?php get_comment_date_formatted($comm->comment_date); ?></span></li>
                    <?php endforeach;
                    //print_r($comms);
                    wp_reset_query();
                ?>
                </ul>
            </div>
        </div>

    <?php endif; ?>
</div>
