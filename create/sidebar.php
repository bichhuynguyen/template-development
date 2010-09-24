<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */
?>
		<ul id="sidebar">
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) :?>
					
					<?php if(is_page()||is_single()):?>
						<?php if(is_page('videos')):?>
							<li>
							<div class="video">
							<?php 
							$side_vid = new VimeoObject();
							$first_video = $side_vid->title_thumb_desc();
							$side_vid->width = 304;
							$side_vid->height = 171;
							
							$player = $side_vid->get_requested_video($first_video['first_film_id']);
							echo '<h4>'.$player['title'].'</h4>';
							
							echo $player['prev'];
							echo $player['next'];
							
							echo $player['video'];
							echo '<p>'.$player['desc'].'</p>';?>
							</div>
							</li>
							
						<?php else: ?>
							<li><?php get_attached_images($wp_query->post->ID, 'large_side_image');?></li>
						<?php endif;?><!--end if videos test-->
					<?php endif;?><!--end if page/single test-->
					
			
			<?php endif; ?><!--end dynamic sidebar-->
		</ul>