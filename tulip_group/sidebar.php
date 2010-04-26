<div id="sidebar">

<h2>Latest Posts</h2>
<ul>	
<?php wp_get_archives('type=postbypost&limit=9'); ?>
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