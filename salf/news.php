<?php
/*
Template Name: News
*/
?>
<?php get_header(); ?>

		
		<div class="post" id="home">
			
			
			<div class="news">
				<a class="news-top" href="<?php bloginfo('rss_url'); ?>"><img  src="<?php echo bloginfo('template_url'); ?>/style/images/news-top.png"  alt="News Top"></a><span style="opacity: 0;"class="subscribe-hint">Get RSS Feed&nbsp;<img style="float: right;"src="<?php echo bloginfo('template_url'); ?>/style/images/social/feed.png" width="16" height="16" alt="Feed"></span>
			<div id="news-feed">
			<?php
			$news_query = new WP_Query('post_type=post');
			if ($news_query->have_posts()) : while ($news_query->have_posts()) : $news_query->the_post(); ?>



				
					
						
					
					
					

					<div class="new-entry">
						<a href="<?php the_permalink();?>"><h2><?php the_date('j-n-y');?>     <?php the_title(); ?></h2></a>
						<?php mf_post_thumbnail('med-cropped');?>
						<?php the_excerpt(); ?>
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
						<iframe class="facebook" src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="width:450px; height:60px"></iframe class="facebook">
						</span>
					</div>
					
					
					
					




					<?php endwhile;
					endif; 
					//Reset Query
					//wp_reset_query();
					?>
			</div><!--End news-feed-->
			
			
				
			</div><!--End news-feed-->	   	
			
			
			
		
		
		</div>
		<a class="top" href="#" title="Top">BACK TO TOP</a>
		
	

		
		
		
		
		
		
	
		
		
<?php get_footer(); ?>