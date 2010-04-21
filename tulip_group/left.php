<div id="left">

<a href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('name'); ?>"><h1><img style="border:none;"src="<?php echo get_bloginfo('template_url'); ?>/images/logo.png" width="227" height="129" alt="<?php bloginfo('name'); ?>" /></h1></a>

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