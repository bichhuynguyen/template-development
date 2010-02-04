	<div id="video-frame">
	
		<div class="video-right">
		
		<h2><?php _e('RECENT VIDEOS',woothemes); ?></h2>
		<p><?php _e('Click below to view videos...',woothemes); ?></p>
		
		<?php $videocat = get_option('woo_video_category'); // ID of the Video Category ?>
		
		<?php query_posts('showposts=6&category_name=' . $videocat); ?>
	
		<?php if (have_posts()) : ?>
		
			<ul class="idTabs">
	
			<?php while (have_posts()) : the_post(); ?>	
		
				<li><a href="#video-<?php the_ID(); ?>"><?php the_title(); ?></a></li>
			
			<?php endwhile; ?>
			
			</ul>	
		
		<?php endif; ?>
	
		</div><!--/video-right -->

	<?php if (have_posts()) : ?>
	
		<div class="video-left">

		<?php while (have_posts()) : the_post(); ?>	
	
			<div id="video-<?php the_ID(); ?>">
				<?php echo woo_get_embed('embed','350','280'); ?> 
			</div>
		
		<?php endwhile; ?>
		
		</div><!--/video-left -->
	
	<?php endif; ?>
	
	</div><!--/video-frame -->