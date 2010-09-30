<div class="new-entry">
						<a href="<?php the_permalink();?>" title="Read More..."><h2><?php echo get_the_title(); ?></h2></a><div class="post-details"><?php the_time('l, F jS, Y') ?><?php comments_number('',' - 1 comment',' - % comments'); ?></div>
						<?php mf_post_thumbnail();?>
						<?php 
						global $more;    // Declare global $more (before the loop).
						$more = 0;       // Set (inside the loop) to display content above the more tag.
						the_content(" Read More...");
						mf_socialise_post();?>
</div>