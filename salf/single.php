<?php get_header(); ?>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">
			<?php if(get_post_type() == 'Program') echo "Hello World!!";?>
			<?php mf_post_thumbnail('large-uncropped');?>
			<h2><?php the_title(); ?></h2>
			<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>

			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<?php //the_tags( '<p>Tags: ', ', ', '</p>'); ?>
			
			
			
			<?php if(get_post_type() == 'Program'):?>
				
			<?php 	$venue_ID = get_post_meta($post->ID, 'mf_SALF_meta_venue', true);
					$venue = get_post($venue_ID);
					$artist_ID = get_post_meta($post->ID, 'mf_SALF_meta_artist', true);
					$artist = get_post($artist_ID);?>
			
			<div class="meta">
			<a href="<?php echo get_permalink($venue->ID);?>"><?php echo $venue->post_title; ?></a>
			</div>
					
			<div class="meta">
			<a href="<?php echo get_permalink($artist->ID);?>"><?php echo $artist->post_title; ?></a>
			</div>	
			<?php endif;?>	
				
				
				
				
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

<?php get_footer(); ?>
