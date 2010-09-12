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
		<?php/*
		$vimeo = new VimeoObject();
		
		$vimeo->video_players_by_ID();*/
		?>
		</div>
		<div id='videos' class="multimedia">
		<h2>Images</h2>
		<?php
		
		$flickr = new FlickrObject();
		
		$flickr->params = array(
				
				'per_page'	=>	'10');
		//$flickr->echo_ul_images();
		$flickr->images_and_links();
		//fb::log($flickr->param_string);
		?>
		</div>
		
		
	</div>
		
		
		
<?php get_footer(); ?>