<?php
ob_start();
/*
Template Name: Multimedia Page
*/
?>
<?php get_header(); ?>

		
	<div class="post multimedia">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php the_content(); ?>
		<?php endwhile; endif; ?>
		
		<div id='videos' class="multimedia">
		<h2>Videos</h2>
		<?php
		$vimeo = new VimeoObject();
		$vimeo->id = 'mildfuzz';
		$vimeo->video_players_by_ID();
		?>
		</div>
		<div id='videos' class="multimedia">
		<h2>Images</h2>
		<?php
		
		$flickr = new FlickrObject();
		$flickr->params = array(
				'user_id'	=> 	'32895227@N00',
				'per_page'	=>	'5');
		$flickr->echo_ul_images();
		?>
		</div>
		
		
	</div>
		
		
		
<?php get_footer(); ?>