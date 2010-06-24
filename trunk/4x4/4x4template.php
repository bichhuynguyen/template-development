<?php
/*
Template Name: 4x4 Tour Homepage Template
*/
?>
<?php
get_header(); ?>
<div id="map-wrapper">
	<div id="map" style="margin-top:-330px;">
			<iframe width="300" height="300" frameborder="0" scrolling="no" 				marginheight="0" marginwidth="0" 			src="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=en&amp;msa=0&amp;msid=116672839499654081499.0004898bdeae87b14e74a&amp;ll=51.559357,-1.781588&amp;spn=0.008004,0.012875&amp;z=15&amp;output=embed"></iframe>
<br /><p>View <a href="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=en&amp;msa=0&amp;msid=116672839499654081499.0004898bdeae87b14e74a&amp;ll=51.55917,-1.781201&amp;spn=0.008004,0.012875&amp;z=15&amp;source=embed" target="_blank">View a larger map</a> </p>
	</div>
</div>
<div id="body-wrapper">
<img src="<?php echo get_bloginfo('template_url'); ?>/style/images/banner.jpg" width="1016" height="356" alt="Banner" />
<img src="<?php echo get_bloginfo('template_url'); ?>/style/images/making-movies.png" width="519" height="102" alt="Making Movies" />
<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		
			<?php the_content('Read the rest of this entry &raquo;'); ?>
		</div>

	<?php endwhile; ?>
	<?php endif; ?>

<img src="<?php echo get_bloginfo('template_url'); ?>/style/images/create-mobile.jpg" width="1016" height="468" alt="Create Mobile" />
<img class="banner" src="<?php echo get_bloginfo('template_url'); ?>/style/images/partner-blurb.png" width="691" height="48" alt="Partner Blurb" />


<div id="logos" style="
	display: block;
	clear: both
	">
<img class="logos sbc" src="<?php echo get_bloginfo('template_url'); ?>/style/images/sbc-logo.png" width="244" height="79" alt="Sbc Logo" />
<img class="logos sws" src="<?php echo get_bloginfo('template_url'); ?>/style/images/sws-logo.png" width="89" height="96" alt="Sws Logo" />
<img class="logos ace" src="<?php echo get_bloginfo('template_url'); ?>/style/images/ace-logo.png" width="176" height="93" alt="Ace Logo" />
<img class="logos create" src="<?php echo get_bloginfo('template_url'); ?>/style/images/create-logo.png" width="172" height="70" alt="Create Logo" />
</div>

<?php //get_sidebar();
$project_query = new WP_Query('post_type=project&orderby=menu_order');

	if ($project_query->have_posts()) : while ($project_query->have_posts()) : $project_query->the_post(); ?>



		<div class="post project" id="project-<?php the_ID(); ?>">
			
			<h2><?php the_title(); ?></h2>
			
			<div class="entry">
				
				<?php the_content();
				 echo f4x4_vimeo_callback(get_the_ID()); ?>
				



			</div>

		</div>




	<?php endwhile; else: ?>

		<p>Currently, no project profiles have been uploaded.</p>

<?php endif; ?>
<?php get_footer(); ?>