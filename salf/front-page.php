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
				$column_query = new WP_Query();
				$column_query->query('post_type=post&paged='.$paged);
				if ( $column_query->have_posts() ) : while ( $column_query->have_posts() ) : $column_query->the_post();
				
				$category = choose_one_category(get_the_category());
				
				fb::log($category,"Category");
				?>
			<?php /*
				
			<div class="centre-left">
				<div class="cnl columns left"> <?php include('front_page_loop.php'); ?></div>
				<?php
				if
				?>
				<div class="cnl columns centre"><?php include('front_page_loop.php'); ?></div>
			</div>
			<div class="columns right"><?php include('front_page_loop.php'); ?></div>
			*/?>
			<?php endwhile; endif;
					//Reset Query
					rewind_posts();
			?>
			<a href="<?php get_permalink(294)?>">See More News</a>					
			
			
			</div><!--End news-feed-->
			<div id="stream-tweet">
			<div class="dsc_tweet tweets"><H2><img src="<?php echo bloginfo('template_url');?>/style/images/tweets-from.png" width="150" height="25" alt="TWEETS FROM US"></H2></div>
			<div class="query_tweet tweets"><H2><img src="<?php echo bloginfo('template_url');?>/style/images/tweets-about.png" width="150" height="25" alt="TWEETS ABOUT US"></H2></div>
			</div>	
		</div>
			
			
			
		
	
		
<?php get_footer(); ?>