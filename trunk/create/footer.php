<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */
?>
		
		</div><!--End content-wrapper -->
		
		<?php wp_footer(); ?>
		
		<div class="push"></div><!--Push for sticky Footer-->
		</div><!--End site-wrapper -->
		<div id="footer">
			<?php 
			$args = array(
			        'theme_location' => 'footer',
			        'container_id' => 'navigation',
			        'fallback_cb' => 'wp_page_menu',
					'link_before'		=> '/ ',
					'link_after'		=> ' /  '
			        );
			    wp_nav_menu($args);
			 ?>
			<p></p>
		</div>
	</body>

</html>