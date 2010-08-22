<?php 

get_header(); ?>

	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="post" id="post-<?php the_ID(); ?>">
			
			
			<?php mf_post_thumbnail('large-cropped');?>
			<h2><?php the_title(); ?></h2>
			
			<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
			
			
			<ul class='meta-list'>
				<h4>Events With This Artist</h4>
					<?php echo mf_get_posts_connected_to_meta(get_the_ID(),false,true);?>
			</ul>
			
			
			
		
				
				
				
				
				
		</div>
		

		
	
	
	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

<?php get_footer(); ?>
