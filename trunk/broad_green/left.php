<div id="left">

<div id="left_content">

	<h2>Menu</h2>
	<ul class="latest dropmenu">
	<li><a href="<?php echo get_settings('home'); ?>/">Home</a></li>
	<?php wp_list_pages('title_li=&depth=1'); ?> 
	</ul>

	<?php
	$children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0&depth=1');
	if ($children) { ?>
	    <h2>Within this section</h2>
		<ul class="latest">
	        <?php echo $children; ?>
	    </ul>
	<?php } ?>
	




<?php if (function_exists('blc_latest_comments')) { ?>

<ul class='latestactivity'>
<?php blc_latest_comments('5','4','false','<li>','</li>','false','10','#666666','#666666'); ?>
</ul>

<?php } ?> 


</div>
</div>