<?php
/*
Template Name: 4x4 Tour Homepage Template
*/
?>
<?php
get_header(); ?>
<div id="map" style="display:none;">
<iframe width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?ie=UTF8&amp;msa=0&amp;msid=116672839499654081499.0004898bdeae87b14e74a&amp;ll=51.55917,-1.781094&amp;spn=0.004002,0.006437&amp;z=16&amp;output=embed"></iframe><br /><small>View <a href="http://maps.google.com/maps/ms?ie=UTF8&amp;msa=0&amp;msid=116672839499654081499.0004898bdeae87b14e74a&amp;ll=51.55917,-1.781094&amp;spn=0.004002,0.006437&amp;z=16&amp;source=embed" style="color:#0000FF;text-align:left">Wyvern Theatre</a> in a larger map</small>
</div>
<div id="body-wrapper">
<img src="<?php echo get_bloginfo('template_url'); ?>/style/images/banner.jpg" width="1016" height="356" alt="Banner">
<img src="<?php echo get_bloginfo('template_url'); ?>/style/images/making-movies.png" width="519" height="102" alt="Making Movies">
<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		
			<?php the_content('Read the rest of this entry &raquo;'); ?></p>
		</div>

	<?php endwhile; ?>
	<?php endif; ?>




</div>
<?php get_footer(); ?>