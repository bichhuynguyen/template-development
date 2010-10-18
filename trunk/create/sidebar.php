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
						$post_id = ID_ouside_loop();
						$video_id = get_post_meta($post_id, 'mf_vimeo', true);
						
						$side_vid->width = 304;
						$side_vid->height = 171;
						
						
						if (post_has_video($post_id, $video_id)==false){
							$single_video = false;//prevents sidebar from displaying video if no video exists 
							fb::log($post_id, $video_id);
						} else {
							
							$single_video = $side_vid->oembed_single_video_by_id($video_id); //places video object inside single video
							
						}
						
						
						?>
						<?php if(is_page('videos')==true):?>
							<li>
							<div class="video">
							<?php 
							
							$first_video = $side_vid->title_thumb_desc();
							
							
							$player = $side_vid->get_requested_video($first_video['first_film_id']);
							echo '<h4>'.$player['title'].'</h4>';
							
							
							echo "<p class='video-nav'>Next Video:".$player['next']."</p>";
							echo "<p class='video-nav'>Previous Video:".$player['prev']."</p>";
							echo $player['video'];
							
							echo '<p>'.$player['desc'].'</p>';?>
							</div>
							</li>
						<?php elseif($single_video==true):?>
							
							<li>
							<div class="video">
							
							<?php 
														
							/*$player = $side_vid->get_requested_video($single_video);
							echo $player['video'];
							echo '<p>'.$player['desc'].'</p>';*/
							
							echo $single_video->html;
							echo '<p>'.$single_video->description.'</p>';
							
							?>
							</div>
							</li>
								
						<?php else: ?>
							
							<li><?php get_attached_images(ID_ouside_loop(), 'large_side_image');?></li>
						<?php endif;?><!--end if videos test-->
						
					<?php endif;?><!--end if page/single test-->
					
			
			<?php endif; ?><!--end dynamic sidebar-->
		</ul>