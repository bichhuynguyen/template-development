<?php get_header(); ?>

	<?php if(get_post_type()=='Venues'):?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="post" id="post-<?php the_ID(); ?>">


					<?php mf_post_thumbnail('large-cropped');?>
					<h2><?php the_title(); ?></h2>

					
					
					<div class='the_content'>
					<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
					</div>
					
					<?php $map = mf_render_google_maps(get_the_ID(),300,300);?>
					<?php if($map)://if map element not false.?>
					<a class="google-map" classhref=#>View Map</a>
					<div class="google-map">

					<?php echo $map;?>

					</div>
					<?php endif;?>
					<ul id='address'>
						<?php echo get_venue_address(get_the_ID());?>
					</ul>
					<?php $events_list = mf_get_posts_connected_to_meta(get_the_ID());?>
					<?php if($events_list):?>
						
						
					<ul class='meta-list'>
						<h4>Events at this Venue</h4>
						<?php echo $events_list;?>
					</ul>
					<?php endif;?>
					









				</div>





			<?php endwhile; else: ?>

				<p>Sorry, no posts matched your criteria.</p>

		<?php endif; ?>
		
	<?php elseif(get_post_type()=='Artists'):?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">


				<?php mf_post_thumbnail('large-cropped');?>
				<h2><?php the_title(); ?></h2>
				<div class='the_content'>
					<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
				</div>

				<ul class='meta-list'>
					<h4>Events With This Artist</h4>
						<?php echo mf_get_posts_connected_to_meta(get_the_ID(),false,true);?>
				</ul>
				<?php mf_socialise_post('Just reading about ')?>








			</div>





		<?php endwhile; else: ?>

			<p>Sorry, no posts matched your criteria.</p>

	<?php endif; ?>
		
	<?php elseif(get_post_type()=='Program'):?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">
				<?php 	
						//Include program-meta-include
						$template = get_function_directory_extension();
						
						include($template.'/program-meta-include.php');
						
						
				?>
				<?php mf_post_thumbnail('large-uncropped');?>
				
				
				<?php echo program_meta_display($date,$time,$venue, $artist,$price,$eventbrite_link, $concession_link,get_the_ID())?>
				<h2><?php the_title(); ?></h2>
				<div class='the_content'>
				<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
				</div>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php //the_tags( '<p>Tags: ', ', ', '</p>'); ?>















					<?php mf_socialise_post('I will be attending ');?>
					<div id="comment_block">
					<?php comments_template( '', true ); ?>
					</div>
			</div>





		<?php endwhile; else: ?>

			<p>Sorry, no posts matched your criteria.</p>

	<?php endif; ?>
		
	<?php else:// if single post ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">
			
			<?php mf_post_thumbnail('large-uncropped');?>
			
			<div id="multimedia-block">
				<?php
				$flickr = new FlickrObject();
				$vimeo = new VimeoObject();
				$image_id = get_post_meta(get_the_ID(), 'mf_SALF_multimedia_meta_flickr_image', true);
				if ($image_id):
				?>
					<div id='flickr_image' class="multimedia">
						<h3>Flickr Image</h3>
						<?php $flickr->get_image_by_id($image_id); ?>
					</div>
				<?php endif;?>
				
				<?php
				$set_id = get_post_meta(get_the_ID(), 'mf_SALF_multimedia_meta_flickr_set', true);
				if ($set_id):
				?>
					<div id='flickr_set' class="multimedia">
						<h3>Flickr Set</h3>
						<?php $flickr->get_photoset($set_id); ?>
					</div>
				<?php endif;?>
				
				<?php $vimeo_id = get_post_meta(get_the_ID(), 'mf_SALF_multimedia_meta_vimeo', true);
				if ($vimeo_id):
				?>
					<div id='vimeo' class="multimedia">
						<h3>Vimeo</h3>
						<?php 
							$video_props = $vimeo->get_universal_player_object($vimeo_id);
							$back_up_player = $vimeo->get_single_video_player($vimeo_id);
							echo $back_up_player;
						 ?>
						
					</div>
				<?php endif;?>
			</div>
			<h2><?php the_title(); ?></h2>
			<div class='the_content'>
				<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
			</div>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<?php //the_tags( '<p>Tags: ', ', ', '</p>'); ?>
			
			
			
			
				
				
				
				
				
				
				<?php mf_socialise_post();?>
				<?php //mf_voting_form();?>
				<div id="comment_block">
					<?php comments_template( '', true ); ?>
				</div>
				
				
		</div>
		

		
	
	
	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>
