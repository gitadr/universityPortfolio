
		<!-- END #content -->
		</div>
			
		<!-- BEGIN #footer -->
		<div id="footer" class="clearfix">
			
			<p class="copyright">
            	<span class="seperator clearfix">
                	<span class="line"></span>
                </span>
                &copy; Copyright <?php echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a> <small>/</small> <?php _e('Powered by', 'framework') ?> <a href="http://wordpress.org/">WordPress</a> 
                <br />
                <a href="http://www.premiumpixels.com/garnish">Garnish Theme</a> by <a href="http://www.premiumpixels.com">Orman Clark</a>
            </p>
			
			<p class="credit">
            <span class="seperator clearfix">
                <span class="line"></span>
            </span>
            <?php echo stripslashes(nl2br(get_option('tz_footer_copy'))); ?></p>
            
		
		<!-- END #footer -->
		</div>
		
	<!-- END #container -->
	</div> 
		
	<!-- Theme Hook -->
	<?php wp_footer(); ?>
			
<!--END body-->
</body>
<!--END html-->
</html>