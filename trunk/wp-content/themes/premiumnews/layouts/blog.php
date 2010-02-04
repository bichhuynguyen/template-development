<div class="box">

	<?php	
		
		$the_query = new WP_Query('cat=-'. $GLOBALS[ex_feat] . ',-' . $GLOBALS[ex_vid] . '&showposts=' . get_option('woo_other_entries') . '&orderby=post_date&order=desc');
		
		$counter = 0;
				
		while ($the_query->have_posts()) : $the_query->the_post(); $do_not_duplicate = $post->ID;
	?>
	
		<?php $counter++; ?>

		<div class="post-alt blog" <?php if ( ($counter == 4) ) { echo 'style="background:none !important;margin-bottom:0 !important;"'; ?><?php } ?>>

			<?php if ( get_post_meta($post->ID, 'image', true) ) { ?> <!-- DISPLAYS THE IMAGE URL SPECIFIED IN THE CUSTOM FIELD -->
				
				<img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;h=57&amp;w=100&amp;zc=1&amp;q=90" alt="" class="th" />			
				
			<?php } else { ?> <!-- DISPLAY THE DEFAULT IMAGE, IF CUSTOM FIELD HAS NOT BEEN COMPLETED -->
				
				<img src="<?php bloginfo('template_directory'); ?>/images/no-img-thumb.jpg" alt="" class="th" />
				
			<?php } ?> 		
			
			<h2><?php the_category(', ') ?></h2>
			<h3><a title="<?php _e('Permanent Link to',woothemes); ?> <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<p class="posted"><?php _e('Posted on',woothemes); ?> <?php the_time('d F Y'); ?></p>

			<div class="entry">
				<?php the_content('<span class="continue">'.__('Continue Reading',woothemes).'</span>'); ?> 
			</div>

			<p class="comments"><?php comments_popup_link(__('Comments (0)',woothemes), __('Comments (1)',woothemes), __('Comments (%)',woothemes)); ?></p>
		
		</div><!--/post-->		

	<?php endwhile; ?>	
	
	<div class="fix"></div>
	
	<?php $archives_page = get_option('woo_archives_page') . '/'; ?>
	
	<p class="ar hl3"><a href="<?php echo get_option('woo_archives'); ?>" class="more"><?php _e('SEE MORE ARTICLES IN THE ARCHIVE',woothemes); ?></a></p>

</div>