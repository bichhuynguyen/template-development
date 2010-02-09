<div id="left">

<ul class="latest">
<?php wp_get_archives('type=postbypost&limit=9'); ?>
</ul>

<a href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.jpg" alt="<?php bloginfo('name'); ?>" border="0" /></a>


<?php if (function_exists('blc_latest_comments')) { ?>

<ul class='latestactivity'>
<?php blc_latest_comments('5','4','false','<li>','</li>','false','10','#666666','#666666'); ?>
</ul>

<?php } ?> 

<a href="http://getfirefox.com" title="Get Firefox"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/firefox.gif" alt="Get Firefox" border="0" /></a>
<a href="<?php bloginfo('rss2_url'); ?>" title="Subscribe to my Feed" rel="alternate" type="application/rss+xml"><img alt="Subscribe to my feed" style="border:0" src="<?php bloginfo('stylesheet_directory'); ?>/images/feed.gif"/></a>
<br>
<a href="http://twitter.com/YOUR_TWITTER_FEED" title="Subscribe to my Twitter Feed" rel="alternate" type="application/rss+xml"><img alt="Subscribe to my Twitter feed" style="border:0" src="<?php bloginfo('stylesheet_directory'); ?>/images/twitterfeed.gif"/></a>
</div>