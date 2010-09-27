<?php
/*
Template Name: Freinds Page
*/
?>
<?php get_header(); ?>

		
		
		<div class="post" id="post-<?php the_ID(); ?>">
			<div id="friends-head"><img style="float: left; margin-bottom: 12px" src="<?php bloginfo('template_url');?>/style/images/friends_title.png"  alt="Browse" />
			<!--><h2><?php the_title(); ?></h2>-->
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php mf_post_thumbnail('large-cropped');?>
				<h2><?php the_title(); ?></h2>
				<div class='the_content clear'>
					<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
				</div>
			<?//php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
		<?php endwhile; endif; ?>
	<?php// edit_post_link('Edit this entry.', '<p>', '</p>');?>



<?php get_footer(); ?>