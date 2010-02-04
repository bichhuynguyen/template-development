<div class="box">

	<?php
		
		$the_query = new WP_Query('cat=-'. $GLOBALS[ex_feat] . ',-' . $GLOBALS[ex_vid] . '&showposts=' . get_option('woo_other_entries') . '&orderby=post_date&order=desc');
		
		$counter = 0; $counter2 = 0;
				
		while ($the_query->have_posts()) : $the_query->the_post(); $do_not_duplicate = $post->ID;
	?>
	
		<?php $counter++; $counter2++; ?>
				
		<div class="post <?php if ($counter == 1) { echo 'fl'; } else { echo 'fr'; $counter = 0; } ?>">
		
			<?php if ( get_post_meta($post->ID, 'image', true) ) { ?> <!-- DISPLAYS THE IMAGE URL SPECIFIED IN THE CUSTOM FIELD -->
				
				<img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;h=57&amp;w=100&amp;zc=1&amp;q=90" alt="" class="th" />			
				
			<?php } else { ?> <!-- DISPLAY THE DEFAULT IMAGE, IF CUSTOM FIELD HAS NOT BEEN COMPLETED -->
				
				<img src="<?php bloginfo('template_directory'); ?>/images/no-img-thumb.jpg" alt="" class="th" />
				
			<?php } ?> 
		
			<h2><?php the_category(', ') ?></h2>
			<h3><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<p class="posted"><?php _e('Posted on',woothemes); ?> <?php the_time('d F Y'); ?></p>
			<p><?php echo strip_tags(get_the_excerpt(), '<a><strong>'); ?> <span class="continue"><a title="<?php _e('Permanent Link to',woothemes); ?> <?php the_title(); ?>" href="<?php the_permalink() ?>"><?php _e('Continue Reading',woothemes); ?></a></span></p>
			<p class="comments"><?php comments_popup_link(__('Comments (0)',woothemes), __('Comments (1)',woothemes), __('Comments (%)',woothemes)); ?></p>
			
		</div><!--/post-->
		
		<?php if ( !($counter2 == get_option('woo_other_entries')) && ($counter == 0) ) { echo '<div class="hl-full"></div>'; ?> <div style="clear:both;"></div> <?php } ?>
	
	<?php endwhile; ?>
	
	<div class="fix" style="height:20px"></div>
		
	<p class="ar hl3"><a href="<?php echo get_option('woo_archives'); ?>" class="more"><?php _e('SEE MORE ARTICLES IN THE ARCHIVE',woothemes); ?></a></p>
	
</div><!--/box-->