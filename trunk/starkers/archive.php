<?php get_header(); ?>

		
		<div id="featured_section">
			<div id="cat-title">
			<?php if (have_posts()) : ?>

			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			<?php /* If this is a category archive */ if (is_category()) { ?>
			<h2><?php single_cat_title(); ?></h2>
			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			<h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h2>Archive for <?php the_time('F jS, Y'); ?></h2>
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h2>Archive for <?php the_time('F, Y'); ?></h2>
			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h2>Archive for <?php the_time('Y'); ?></h2>
			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h2>Author Archive</h2>
			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h2>Blog Archives</h2>
			<?php } ?>
			</div>


			<div class="container body_content">
		<div id="content_wrap">		
		<?php while (have_posts()) : the_post(); ?>
			
			<div class="single_post">
				
				
				
				
				<div class="the_video single_archive_video">
				<?php echo get_post_meta($post->ID, 'video', true)?>
				</div>
				
				<div class="the_text">
				<h3 class="post_title"><?php the_title(); ?></h3>
				<img  class="border" src="<?php echo bloginfo('template_directory'); ?>/style/images/content_brdr.png" alt="" />
				<?php the_content() ?>
				
				
				</div>
			</div>	
			
		
				
				

		<?php endwhile; ?>

		

	<?php else : ?>

		<h2>Not Found</h2>
		

	<?php endif; ?>
	</div>
		<ul>
			<li><?php next_posts_link('&laquo; Older Entries') ?></li>
			<li><?php previous_posts_link('Newer Entries &raquo;') ?></li>
		</ul>
	</div>
	
</div>
<div id="featured_base">&nbsp;</div>

<?php get_footer(); ?>
