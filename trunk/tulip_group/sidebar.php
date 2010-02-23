<div id="sidebar">

<h2>Pages</h2>
<ul>
<li><a href="<?php echo get_settings('home'); ?>/">Home</a></li>
<?php wp_list_pages('title_li='); ?> 
</ul>

<h2>Categories</h2>
<ul>
<?php wp_list_cats('arguments'); ?>
</ul>
<h2>Archives</h2>
<ul>
<?php wp_get_archives('type=monthly&limit=12'); ?>
</ul>

<!--><h2>Blogroll</h2>
<ul>
<?php get_links(); ?>
</ul>-->

</div>