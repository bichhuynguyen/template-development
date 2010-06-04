<?php get_header(); ?>

	<?php if (have_posts()) :?>
		<?php $postCount=0; ?>
		<?php while (have_posts()) : the_post();?>
			<?php $postCount++;?>
	<div class="entry entry-<?php echo $postCount ;?>">
		<div class="entrytitle">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		</div>
		<div class="entrybody">
			<?php the_content('Read the rest of this entry &raquo;'); ?>
		</div>
		
		<div class="entrymeta"><?php edit_post_link('Edit', '', ''); ?></div>
		
	</div>
	<div class="commentsblock">
		<div style="height: 100%; width: 100%; background: none repeat scroll 0% 0% white; -moz-border-radius-topleft: 100px;-webkit-border-top-left-radius: 100px;">&nbsp;</div>
	</div>
		<?php endwhile; ?>
		
	<?php else : ?>

		<h2>Not Found</h2>
		<div class="entrybody">Sorry, but you are looking for something that isn't here.</div>

	<?php endif; ?>
	<?php get_footer(); ?>
	</div>


<?php get_sidebar(); ?>

</div>
</body>
</html>


