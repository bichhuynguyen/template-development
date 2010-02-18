<?php get_header(); ?>

<?php include (TEMPLATEPATH . "/left.php"); ?>

<div id="content">

<?php query_posts('showposts=1'); ?>

	<?php if (have_posts()) :?>

		<?php $postCount=0; ?>

		<?php while (have_posts()) : the_post();?>

			<?php $postCount++;?>

	<div class="entry entry-<?php echo $postCount ;?>">
		<div class="entrytitle">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2> 
			<br /><h4><?php the_time('F jS, Y') ?> | <?php the_category(', ') ?> | <?php comments_popup_link('Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></h4>
		</div>

		<div class="entrybody">
			<?php the_content('Read the rest of this entry &raquo;'); ?>
		</div>


		<div class="entrymeta">

		</div>

	</div>

	<div class="commentsblock">

		<?php comments_template(); ?>
	



<br>	<br>	
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








