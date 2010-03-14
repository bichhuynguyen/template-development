<div id="featured_section">
	<div id="buttons">
	<span class='featured_button'>
	<a href='#' class='previous'  title='previous'><img src="<?php echo bloginfo('template_directory'); ?>/style/images/prev_btn.png" alt="" /></a>
	<a href='#' class='next'  title='next'><img src="<?php echo bloginfo('template_directory'); ?>/style/images/next_btn.png" alt="" /></a>
	</span>
	</div>
	<div id="container">
		<div class="slides">
			<?php
			    $recentPosts = new WP_Query();
			    $recentPosts->query('showposts=5');
			?>
			
			<?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
			<div>
			
			
		
			<div class="the_copy">
				<a class="post_title"href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
				
					<img class="border" src="<?php echo bloginfo('template_directory'); ?>/style/images/content_brdr.png" alt="" />
					<p class="body_copy">
				
						<?php the_excerpt(); ?>
					</p>
					<img class="border" src="<?php echo bloginfo('template_directory'); ?>/style/images/content_brdr.png" alt="" />
			</div>
				
				<div class="the_video">
				<?php echo get_post_meta($post->ID, 'video', true)?>
				</div>	
				
				</div>
				<?php endwhile; ?>	
		</div>
	
		
		
		</div>
		
	</div>
		

<div id="featured_base">&nbsp;</div>