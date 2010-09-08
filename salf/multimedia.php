<?php
ob_start();
/*
Template Name: Multimedia Page
*/
?>
<?php get_header(); ?>

		
	<div class="post partners">		
		<?php
		$vimeo = new VimeoObject();
		$vimeo->id = 'mildfuzz';
		fb::log($vimeo->get_video_array());
		?>
		
		
		
		
	</div>
		
		
		
<?php get_footer(); ?>