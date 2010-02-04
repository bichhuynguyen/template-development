			<div class="post clear" id="post-<?php the_ID(); ?>">
				<div class="thumbnail">
					<?php the_content(); ?>
				</div>
				<div class="entry">
					<?php if(get_post_meta($post->ID, 'url', true)) { ?>
					<h2><a href="<?php echo get_post_meta($post->ID, 'url', true); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<?php } else { ?>
					<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<?php } ?>
					<p class="comment-link"><?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
					<?php echo get_post_meta($post->ID, 'description', true); ?>
				</div>
			</div>