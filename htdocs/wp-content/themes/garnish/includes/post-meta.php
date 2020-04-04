    <!--BEGIN .entry-meta .entry-header-->
    <ul class="entry-meta entry-header clearfix">
		
        <?php if(!is_singular()) :?>
        <li class="comment-count"><?php comments_popup_link(__('No Comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?><span> / </span></li>
        <?php endif; ?>
        
        <li class="entry-categories"><?php the_category(', ') ?></li>
        
        <?php edit_post_link( __('Edit', 'framework'), '<li class="edit-post"><span> / </span>', '</li>' ); ?>
    
    <!--END .entry-meta entry-header -->
    </ul>
