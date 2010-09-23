<?php
ob_start();

/*
Template Name: Partners Page
*/
?>
<?php get_header(); ?>

		
	<div class="post partners">		
		<h2><img class="text" src="<?php echo bloginfo('template_url'); ?>/style/images/partners-blurb.png" alt="the list of partners continues to grow" ></img></h2>
		
		
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('partners-image');
			} 
			?>
		<?php the_content(); ?>
		<?php endwhile; endif; ?>
		
	</div>
		
		
		
<?php get_footer(); ?>