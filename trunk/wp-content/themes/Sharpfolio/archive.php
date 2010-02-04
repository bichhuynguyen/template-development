<?php get_header(); ?>

	<div id="content2">

	<?php if (have_posts()) : ?>
	
		<div style="font-family:Arial, Helvetica, sans-serif; font-size: 38px; font-weight:bold; color:#666;"><?php single_cat_title(); ?></div>
		
		<div style="height:45px;"></div>

		<?php while (have_posts()) : the_post(); ?>

			<?php include('folio-format.php'); ?>

		<?php endwhile; ?>

		<div class="navigation clear">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous Page') ?></div>
			<div class="alignright"><?php previous_posts_link('Next Page &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>

	<?php endif; ?>

	</div>

<?php get_footer(); ?>
