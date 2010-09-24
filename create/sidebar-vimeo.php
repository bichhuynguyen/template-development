<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */
?>
		<ul id="sidebar">
			
					
			
			<li>
			
			<?php 
			$side_vid = new VimeoObject();
			$side_vid->width = 304;
			$side_vid->height = 171;
			echo $side_vid->get_requested_video($films['first_film_id']);?><li>
		</ul>