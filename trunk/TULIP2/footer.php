<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */
?>
</div>

<div id="footer">
	<div id="pagination">
	<?php if (next_posts_link() || previous_posts_link()): ?>
		
		<?php next_posts_link('&laquo; Older Entries') ?> | <?php previous_posts_link('Newer Entries &raquo;') ?>
		
	<?php endif ?>
	</div>

		<!-- If you'd like to support WordPress, having the "powered by" link somewhere on your blog is the best way; it's our only promotion or advertising. -->
		<p><?php bloginfo('name'); ?> is proudly powered by <a href="http://wordpress.org/">WordPress <?php bloginfo('version'); ?></a> <a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a> <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a>. <!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. --></p>
		
		<?php wp_footer(); ?>
</div>
	</body>

</html>