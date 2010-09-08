<?php
ob_start();
/*
Template Name: Multimedia Page
*/
?>
<?php get_header(); ?>

		
	<div class="post multimedia">		
		<?php
		$vimeo = new VimeoObject();
		$vimeo->id = 'mildfuzz';
		$embed_code = $vimeo->create_video_player_by_ID('4426537');
		echo $embed_code;
		fb::log($embed_code);
		?>
		
		
		
		
	</div>
		
		
		
<?php get_footer(); ?>