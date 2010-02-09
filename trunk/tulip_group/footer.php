<div class="search"><form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<input type="text"  name="s" id="s" class="form" value="<?php echo wp_specialchars($s, 1); ?>"/><input type="image" src="<?php bloginfo('stylesheet_directory'); ?>/images/search.gif" value="submit" style="border:0; margin:0; vertical-align:top"/></form>

</div><div id="footer"><br><?php bloginfo('name'); ?> runs on <a href="http://www.wordpress.org">WordPress</a> and <a href="http://www.writerspace.net">Digital Pop</a> theme - a <a href="http://www.hellowiki.com">NewFeel</a> mod.

<?php wp_footer(); ?>

</div>