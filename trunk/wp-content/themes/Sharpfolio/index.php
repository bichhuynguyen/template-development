<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : ?>

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
