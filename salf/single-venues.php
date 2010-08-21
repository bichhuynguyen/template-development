<?php 
mf_get_posts_connected_to_meta(129);
get_header(); ?>

	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="post" id="post-<?php the_ID(); ?>">
			
			
			<?php mf_post_thumbnail('large-uncropped');?>
			<h2><?php the_title(); ?></h2>
			
			<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
			<a class="google-map" classhref=#>View Map</a>
			<div class="google-map">
			
			<?php echo mf_render_google_maps(get_the_ID(),300,300);?>
			
			</div>
			
			
			
		
				
				
				
				
				
		</div>
		

		
	
	
	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

<?php get_footer(); ?>
