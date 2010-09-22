<?php
ob_start();
/*
Template Name: Multimedia Page
*/
?>
<?php get_header(); ?>

		
	<div class="post multimedia">
		<img src="<?php echo bloginfo('template_url'); ?>/style/images/media_title.png" alt="Media">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="clear"><?php the_content(); ?></div>
		<?php endwhile; endif; ?>
		
		
		<div id='vimeo' class="multimedia">
		<h2>Videos</h2>
		<?php
		$vimeo = new VimeoObject();
		
		$vimeo->video_players_by_ID();//*/
		?>
		</div>
		<div id='flickr' class="multimedia">
		<h2>Images</h2>
		<?php
		
		$flickr = new FlickrObject();
		
		$flickr->params = array(
				
				'per_page'	=>	'10');
		
		$flickr->images_and_links();
		$flickr->get_image_by_id('cock');
		?>
		</div>
		
		
	</div>
		
		
		
<?php get_footer(); ?>