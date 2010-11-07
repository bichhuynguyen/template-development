<?php
ob_start();
/*
Template Name: Flickr Page
*/
?>
<?php get_header(); ?>

	
	<div class="post media">
		<img src="<?php echo bloginfo('template_url'); ?>/style/images/media_title.png" alt="Media">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="clear"><?php the_content(); ?></div>
		<?php endwhile; endif; ?>
		
		
		<?php if($_GET['media']=='video'): ?>
			<div id='flickr' class="multimedia">
				<?php $vimeo = new VimeoObject(); 
				
				?>
				
				<?php $films = $vimeo->thumb_list();?>
				<?php echo $films['list']; ?>
			</div>
			<div class="video clear">
			<?php 
			
			
			
			
			$player = $vimeo->get_requested_video($films['first_film_id']);
			echo '<h4>'.$player['title'].'</h4>';
			
			
			echo "<p class='video-nav'>Next Video:".$player['next']."</p>";
			echo "<p class='video-nav'>Previous Video:".$player['prev']."</p>";
			echo $player['video'];
			
			echo '<p>'.$player['desc'].'</p>';?>
		
			</div>
		<?php else: ?>
			<div id='flickr' class="multimedia">
		
			<?php $flickr = new FlickrObject(); ?>
		
		
			<div id="photoset_select" class='clear'>		
				<?php $flickr->get_sets(); ?>
			</div>
			<div id="photoset" class='clear'>	
			<?php if ($_GET['id']):?>
			
				<?php if($_GET['title']) echo "<h2>".$_GET['title'].'</h2>'; ?>
				<?php $flickr->get_photoset($_GET['id']); ?>	
			<?php else:?>
				<h2>Please Select a photoset</h2>
					
			<?php endif; ?>
			</div>
			<?php endif; ?>
</div>
		
		
		
<?php get_footer(); ?>