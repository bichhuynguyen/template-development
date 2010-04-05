<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */
?>
<div class="push"></div><!--Used for keeping footer stuck to base-->
</div><!--End container-->
</div><!--End wrapper-->

<div id="footer">
<?php get_pagination(); ?>

		<!-- If you'd like to support WordPress, having the "powered by" link somewhere on your blog is the best way; it's our only promotion or advertising. -->
		<p><?php bloginfo('name'); ?> is was build by <a href="http://mildfuzz.com/">Mild Fuzz</a> </p>
		
		<?php wp_footer(); ?>
</div>
	</body>

</html>