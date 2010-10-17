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
			


				<?php

				global $query_string;
				parse_str( $query_string, $my_query_array );
				$paged = ( isset( $my_query_array['paged'] ) && !empty( $my_query_array['paged'] ) ) ? $my_query_array['paged'] : 1;
				query_posts('post_type=post&posts_per_page=5&paged='.$paged);
				




				if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
				
				
								

					<div class="new-entry">
						
						<a href="<?php the_permalink();?>"><h2><?php the_title(); ?></h2></a>
						<div class="post-details"><?php the_time('l, F jS, Y') ?><?php comments_number('',' - 1 comment',' - % comments'); ?></div>
						<?php mf_post_thumbnail('med-cropped');?>
						<?php 
						global $more;    // Declare global $more (before the loop).
						$more = 0;       // Set (inside the loop) to display content above the more tag.
						the_content(" Read More...");
						?>
					
						
						
						
					
						
						<?php mf_socialise_post();?>
					</div>
					
					
					
					



					

							<?php	

								endwhile;

							?>

							<div class="custom-pagination clear">

							<div><?php previous_posts_link('&laquo; Previous') ?></div>

							<div><?php next_posts_link('More &raquo;') ?></div>
							</div>



							<?php					

							endif; 

							//Reset Query

							rewind_posts();

							?>

								
					
					
					
					</div>
			</div><!--End news-feed-->
			<div id="stream-tweet">
			<div class="dsc_tweet tweets"><H2><img src="<?php echo bloginfo('template_url');?>/style/images/tweets-from.png" width="150" height="25" alt="TWEETS FROM US"></H2></div>
			<div class="query_tweet tweets"><H2><img src="<?php echo bloginfo('template_url');?>/style/images/tweets-about.png" width="150" height="25" alt="TWEETS ABOUT US"></H2></div>
			</div>
			
		</div>
			
			
			
		
	
		
<?php get_footer(); ?>