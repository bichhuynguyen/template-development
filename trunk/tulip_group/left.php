<div id="left">

<a href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.jpg" alt="<?php bloginfo('name'); ?>" border="0" /></a>

<div id="left_content">
<h2>Latest Posts</h2>
<ul class="latest">
<?php wp_get_archives('type=postbypost&limit=9'); ?>
</ul>





<?php if (function_exists('blc_latest_comments')) { ?>

<ul class='latestactivity'>
<?php blc_latest_comments('5','4','false','<li>','</li>','false','10','#666666','#666666'); ?>
</ul>

<?php } ?> 


</div>
</div>