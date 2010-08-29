<?php
ob_start();

/*
Template Name: Front Page
*/
?>
<?php get_header(); ?>

		
		<div class="post" id="home">
			<h2><img src="<?php echo bloginfo('template_url'); ?>/style/images/home-page-header-para.png" alt="Britain's first major festival celebrating South Asian literature" ></img></h2>
		
			
			<div class="news">
				<a class="news-top" href="<?php bloginfo('rss_url'); ?>"><img  src="<?php echo bloginfo('template_url'); ?>/style/images/news-top.png"  alt="News Top"></a><span style="opacity: 0;"class="subscribe-hint">Get RSS Feed&nbsp;<img style="float: right;"src="<?php echo bloginfo('template_url'); ?>/style/images/social/feed.png" width="16" height="16" alt="Feed"></span>
			<div id="news-feed">
			


<?php query_posts("post_type=post&paged=$paged");?>
<?php 	fb::log($wp_query);?>
<?php while (have_posts()) : the_post(); ?>

				
								

					<div class="new-entry">
						
						<a href="<?php the_permalink();?>"><h2><?php the_title(); ?></h2></a><div class="post-details"><?php the_time('l, F jS, Y') ?><?php comments_number('',' - 1 comment',' - % comments'); ?></div>
						<?php mf_post_thumbnail('med-cropped');?>
						<?php 
						global $more;    // Declare global $more (before the loop).
						$more = 0;       // Set (inside the loop) to display content above the more tag.
						the_content(" Read More...");
						?>
					
						
						
						
					
						
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
						<div class="fb-iframe"><fb:like action='like' href="<?php the_permalink();?>"colorscheme='light'
						layout='standard' show_faces='true' width='200'/></div>
						</span>
					</div>
					
					
					
					



					<div class="custom-pagination">
					<span class="alignleft"><?php previous_posts_link('&laquo; Previous') ?></span>
					<span class="alignright"><?php next_posts_link('More &raquo;') ?></span>
</div>

					<?php endwhile; ?>  
	
                	<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

									
					
					
					
					</div>
			</div><!--End news-feed-->
			<div id="stream-tweet">
			<div class="dsc_tweet tweets"><H2><img src="<?php echo bloginfo('template_url');?>/style/images/tweets-from.png" width="150" height="25" alt="TWEETS FROM US"></H2></div>
			<div class="query_tweet tweets"><H2><img src="<?php echo bloginfo('template_url');?>/style/images/tweets-about.png" width="150" height="25" alt="TWEETS ABOUT US"></H2></div>
			</div>	
		</div>
			
			
			
		
	
		
<?php get_footer(); ?>