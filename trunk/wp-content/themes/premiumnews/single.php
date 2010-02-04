<?php get_header(); ?>

		<div class="col1">

		<?php if (have_posts()) : ?>
	
			<?php while (have_posts()) : the_post(); ?>		

				<div id="archivebox">
					
						<h2><em><?php _e('Categorized',woothemes); ?> |</em> <?php the_category(', ') ?></h2>
						<?php if (function_exists('the_tags')) { ?><div class="singletags"><?php the_tags('Tags | ', ', ', ''); ?></div><?php } ?>        
				
				</div><!--/archivebox-->			

				<div class="post-alt blog" id="post-<?php the_ID(); ?>">
				
					<h3><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
					<p class="posted"><?php _e('Posted on',woothemes); ?> <?php the_time('d F Y'); ?> <?php _e('by',woothemes); ?> <?php the_author(); ?></p>
		
					<div class="entry">
						<?php the_content('<span class="continue">'.__('Continue Reading',woothemes).'</span>'); ?> 
					</div>
				
				</div><!--/post-->
				
				<div id="comment">
					<?php comments_template(); ?>
				</div>

		<?php endwhile; ?>
		
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries',woothemes)) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;',woothemes)) ?></div>
		</div>		
	
	<?php endif; ?>							

		</div><!--/col1-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>