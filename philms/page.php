<?php get_header(); ?>
<div id="featured_section">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<div id="cat-title">
			<h2><?php the_title(); ?></h2>
			</div>
			<div id="clear-title"></div>
			<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
			
		</div>
		<?php endwhile; endif; ?>



</div>
<div id="featured_base">&nbsp;</div>

<?php get_footer(); ?>