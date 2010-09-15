<?php get_header(); ?>
	<?php if(get_post_type()=='Venues'):?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<div class="post" id="post-<?php the_ID(); ?>">


					<?php mf_post_thumbnail('large-cropped');?>
					<h2><?php the_title(); ?></h2>

					<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
					<?php $map = mf_render_google_maps(get_the_ID(),300,300);?>
					<?php if($map)://if map element not false.?>
					<a class="google-map" classhref=#>View Map</a>
					<div class="google-map">

					<?php echo $map;?>

					</div>
					<?php endif;?>

					<?php $events_list = mf_get_posts_connected_to_meta(get_the_ID());?>
					<?php if($events_list):?>
					<ul class='meta-list'>
						<h4>Events at this Venue</h4>
						<?php echo $events_list;?>
					</ul>
					<?php endif;?>
					<ul id='address'>
						<?php echo get_venue_address(get_the_ID());?>
					</ul>









				</div>





			<?php endwhile; else: ?>

				<p>Sorry, no posts matched your criteria.</p>

		<?php endif; ?>
		
	<?php elseif(get_post_type()=='Artists'):?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">


				<?php mf_post_thumbnail('large-cropped');?>
				<h2><?php the_title(); ?></h2>

				<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>


				<ul class='meta-list'>
					<h4>Events With This Artist</h4>
						<?php echo mf_get_posts_connected_to_meta(get_the_ID(),false,true);?>
				</ul>









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
						include($template.'/program-meta-include.php')

				?>
				<?php mf_post_thumbnail('large-uncropped');?>
				
				
				<?php echo program_meta_display($date,$time,$venue, $artist,$price,$eventbrite_link,get_the_ID())?>
				<h2><?php the_title(); ?></h2>

				<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php //the_tags( '<p>Tags: ', ', ', '</p>'); ?>















					<script type="text/javascript">
					function getTinyUrl($url) {   
					     $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);  
					     return $tinyurl;  
					}
					var twtTitle  = "Just reading '<?php the_title(); ?>'";

					var tinyUrl = "<?php 

						echo getTinyUrl(get_permalink(get_the_ID()));?>";

					var twtLink =  'http://twitter.com/home?status='+encodeURIComponent(twtTitle + ' ' + tinyUrl + " #salf");
					document.write('<a class="twitter" href="'+twtLink+'" target="_blank"'+'><img src="<?php echo bloginfo('template_url')?>/style/images/social/twitter.png"  border="0" alt="Tweet This!" /'+'><'+'/a>');
					</script>
					<noscript><a class="twitter" href="http://twitter.com/home?status=<?php echo getTinyUrl(get_permalink(get_the_ID()));?>" target="_blank"'+'><img src="<?php echo bloginfo('template_url')?>/style/images/social/twitter.png"  border="0" alt="Tweet This!" /></a></noscript>

					<span class="facebook-connect">
					<a href=# target="_blank" class="facebook"><img src="<?php echo bloginfo('template_url')?>/style/images/social/facebook.png" width="16" height="16" alt="Facebook" /></a>
					<div id="fb-root"></div>
					<script>
					window.fbAsyncInit = function() {
					FB.init({appId: '130496703654288', status: true, cookie: true,
					xfbml: true});
					};
					(function() {
					var e = document.createElement('script'); e.async = true;
					e.src = document.location.protocol +
					'//connect.facebook.net/en_US/all.js';
					document.getElementById('fb-root').appendChild(e);
					}());
					</script>
					<div class="fb-iframe"><fb:like action='like' colorscheme='light'
					layout='standard' show_faces='true' /></div>
					</span>
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
			
			<?php
			$flickr = new FlickrObject();
			$image_id = get_post_meta(get_the_ID(), 'mf_SALF_multimedia_meta_flickr_image', true);
			if ($image_id):
			?>
			<div style="float: right; clear: right;" id='flickr' class="multimedia">
			<h3>Flickr Image</h3>
			<?php $flickr->get_image_by_id($image_id); ?>
			</div>
			<?php endif;?>
			<?php
			$set_id = get_post_meta(get_the_ID(), 'mf_SALF_multimedia_meta_flickr_set', true);
			if ($set_id):
			?>
			<div style="float: right; clear: right;" id='flickr' class="multimedia">
			<h3>Flickr Set</h3>
			<?php $flickr->get_photoset($set_id); ?>
			</div>
			<?php endif;?>
			
			<h2><?php the_title(); ?></h2>
			
			<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>

			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<?php //the_tags( '<p>Tags: ', ', ', '</p>'); ?>
			
			
			
			
				
				
				
				
				<script type="text/javascript">
				function getTinyUrl($url) {   
				     $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);  
				     return $tinyurl;  
				}
				var twtTitle  = "Just reading '<?php the_title(); ?>'";

				var tinyUrl = "<?php 

					echo getTinyUrl(get_permalink(get_the_ID()));?>";

				var twtLink =  'http://twitter.com/home?status='+encodeURIComponent(twtTitle + ' ' + tinyUrl + " #salf");
				document.write('<a class="twitter" href="'+twtLink+'" target="_blank"'+'><img src="<?php echo bloginfo('template_url')?>/style/images/social/twitter.png"  border="0" alt="Tweet This!" /'+'><'+'/a>');
				</script>
				<noscript><a class="twitter" href="http://twitter.com/home?status=<?php echo getTinyUrl(get_permalink(get_the_ID()));?>" target="_blank"'+'><img src="<?php echo bloginfo('template_url')?>/style/images/social/twitter.png"  border="0" alt="Tweet This!" /></a></noscript>
				 
				<span class="facebook-connect">
				<a href=# target="_blank" class="facebook"><img src="<?php echo bloginfo('template_url')?>/style/images/social/facebook.png" width="16" height="16" alt="Facebook" /></a>
				<div id="fb-root"></div>
				<script>
				window.fbAsyncInit = function() {
				FB.init({appId: '130496703654288', status: true, cookie: true,
				xfbml: true});
				};
				(function() {
				var e = document.createElement('script'); e.async = true;
				e.src = document.location.protocol +
				'//connect.facebook.net/en_US/all.js';
				document.getElementById('fb-root').appendChild(e);
				}());
				</script>
				<div class="fb-iframe"><fb:like action='like' colorscheme='light'
				layout='standard' show_faces='true' /></div>
				</span>
				<?php mf_voting_form();?>
				<div id="comment_block">
					<?php comments_template( '', true ); ?>
				</div>
				
				
		</div>
		

		
	
	
	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>
