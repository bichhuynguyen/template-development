<div id="left">

<!--><a href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" border="0" /></a> -->
<ul class="latest">
<?php wp_get_archives('type=postbypost&limit=5'); ?>
</ul>




<?php if (function_exists('blc_latest_comments')) { ?>

<ul class='latestactivity'>
<?php blc_latest_comments('5','4','false','<li>','</li>','false','10','#666666','#666666'); ?>
</ul>

<?php } ?> 



</div>