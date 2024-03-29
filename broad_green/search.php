<?php get_header(); ?>


	<?php if (have_posts()) :?>
		<?php $postCount=0; ?>
		<?php while (have_posts()) : the_post();?>
			<?php $postCount++;?>
	<div class="entry entry-<?php echo $postCount ;?>">
		<div class="entrytitle">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2> 
			<h3><?php the_time('F jS, Y') ?></h3>
		</div>
		<div class="entrybody">
			<?php the_content('Read the rest of this entry &raquo;'); ?>
		</div>
		
		<div class="entrymeta">Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
		</div>
		
	</div>
	<div class="commentsblock">
		<div class="speech">&nbsp;</div>
	</div>
		<?php endwhile; ?>
		<div class="navigation">
			<div><?php next_posts_link('&laquo; Previous Entries') ?></div>
			<div><?php previous_posts_link('Next Entries &raquo;') ?></div>
		</div>
		
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


