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
						<?php
						$side_vid = new VimeoObject();
						$side_vid->width = 304;
						$side_vid->height = 171;
						
						$single_video = get_post_meta(ID_ouside_loop(), 'mf_vimeo', true);
						
						if ($single_video) $vimeo_exists = $side_vid->id_is_video($single_video);
						if (!$vimeo_exists || !$single_video) $single_video = false;//prevents sidebar from displaying video if no video exists 
						
						
						?>
						<?php if(is_page('videos')==true):?>
							<li>
							<div class="video">
							<?php 
							
							$first_video = $side_vid->title_thumb_desc();
							
							
							$player = $side_vid->get_requested_video($first_video['first_film_id']);
							echo '<h4>'.$player['title'].'</h4>';
							
							echo $player['prev'];
							echo $player['next'];
							
							echo $player['video'];
							echo '<p>'.$player['desc'].'</p>';?>
							</div>
							</li>
						<?php elseif($single_video==true):?>
							
							<li>
							<div class="video">
							
							<?php 
														
							$player = $side_vid->get_requested_video($single_video);
							
							
							
							
							
							echo $player['video'];
							echo '<p>'.$player['desc'].'</p>';?>
							</div>
							</li>
								
						<?php else: ?>
							
							<li><?php get_attached_images(ID_ouside_loop(), 'large_side_image');?></li>
						<?php endif;?><!--end if videos test-->
						
					<?php endif;?><!--end if page/single test-->
					
			
			<?php endif; ?><!--end dynamic sidebar-->
		</ul>