
<?php get_header(); ?>


<div id="featured_section">
<div id="container">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="body_content">
			
			<div class="the_video single_archive_video">
			<?php echo get_post_meta($post->ID, 'video', true)?>
			</div>
			
			<div class="the_text">
			<h3 class="post_title"><?php the_title(); ?></h3>
			<img src="<?php echo bloginfo('template_directory'); ?>/style/images/content_brdr.png" alt="" />
			<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
				<img src="<?php echo bloginfo('template_directory'); ?>/style/images/content_brdr.png" alt="" />
			
			</div>
			
			
		
		</div>


		
		

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>
	</div>
<div id="featured_base">&nbsp;</div>	
</div>
<?php get_footer(); ?>
