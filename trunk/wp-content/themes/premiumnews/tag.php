<?php get_header(); ?>

		<div class="col1">

		<?php if (have_posts()) : ?>
		
		<div id="archivebox">
        	
            	<h2><em><?php _e('Tag Archive',woothemes); ?> |</em> "<?php single_tag_title("", true); ?>"</h2>        
		
		</div><!--/archivebox-->
	
			<?php while (have_posts()) : the_post(); ?>		

				<div class="post-alt blog" id="post-<?php the_ID(); ?>">
		
					<?php if ( get_post_meta($post->ID, 'image', true) ) { ?> <!-- DISPLAYS THE IMAGE URL SPECIFIED IN THE CUSTOM FIELD -->
						
						<img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;h=57&amp;w=100&amp;zc=1&amp;q=90" alt="" class="th" />			
						
					<?php } else { ?> <!-- DISPLAY THE DEFAULT IMAGE, IF CUSTOM FIELD HAS NOT BEEN COMPLETED -->
						
						<img src="<?php bloginfo('template_directory'); ?>/images/no-img-thumb.jpg" alt="" class="th" />
						
					<?php } ?> 		
					
					<?php if (function_exists('the_tags')) { ?><h2><?php the_tags('Tags: ', ', ', ''); ?></h2><?php } ?>
					<h3><a title="<?php _e('Permanent Link to',woothemes); ?> <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
					<p class="posted"><?php _e('Posted on',woothemes); ?> <?php the_time('d F Y'); ?> <?php _e('by',woothemes); ?> <?php the_author(); ?></p>
		
					<div class="entry">
						<?php the_content('<span class="continue">'.__('Continue Reading',woothemes).'</span>'); ?> 
					</div>
		
					<p class="comments"><?php comments_popup_link(__('Comments (0)',woothemes), __('Comments (1)',woothemes), __('Comments (%)',woothemes)); ?></p>
				
				</div><!--/post-->

		<?php endwhile; ?>
		
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries',woothemes)); ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;',woothemes)); ?></div>
		</div>		
	
	<?php endif; ?>							

		</div><!--/col1-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>