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
				query_posts('post_type=post&posts_per_page=3&paged='.$paged);
				
				
				if ( have_posts() ) : while ( have_posts() ) : the_post();
				
				$category = choose_one_category(get_the_category());
				
				switch ($category){
					case "Festival News":
						$left[] = $post;
						break;
					case "Industry News":
						$centre[] = $post;
						break;
					case "Other":
						$right[] = $post;
						break;
				}
				
				
				endwhile; 
				?>
				<div class="custom-pagination">

				<div ><?php previous_posts_link('&laquo; Previous') ?></div>

				<div ><?php next_posts_link('Next &raquo;') ?></div>
				</div>
				<?php endif;
				
				
				
				?>
				
				
			
				
			<div class="centre-left">
				<div class="cnl columns left"> 
				<?php 
				foreach ($left as $post){
					if($post):
					setup_postdata($post);
					include('front_page_loop.php');
					endif;
				} ?>
				<p><a href="<?php 
							$cat_object = get_term_by('name','Festival News','category');
							$mf_link = get_category_link($cat_object->term_id);
							echo $mf_link;
							?>">More in this Category</a></p>	
				</div>
				
				<div class="cnl columns centre">
					<?php 
					foreach ($centre as $post){
						if($post):
						setup_postdata($post);
						include('front_page_loop.php');
						endif;
					} ?>
					<p><a href="<?php 
								$cat_object = get_term_by('name','Industry News','category');
								$mf_link = get_category_link($cat_object->term_id);
								echo $mf_link;
								?>">More in this Category</a></p>		
				</div>
			</div>
			<div class="columns right">
				<?php 
				foreach ($right as $post){
					if($post):
					setup_postdata($post);
					include('front_page_loop.php');
					endif;				
				} ?>
				<p><a href="<?php 
							$cat_object = get_term_by('name','Other','category');
							$mf_link = get_category_link($cat_object->term_id);
							echo $mf_link;
							?>">More in this Category</a></p>	
			</div>
			<?php //*/ ?>
		
							
			
			
			</div><!--End news-feed-->
			
			<div class="clear"><a href="<?php get_permalink(294)?>">See More News</a></div>	
			<div id="stream-tweet">
			<div class="dsc_tweet tweets"><H2><img src="<?php echo bloginfo('template_url');?>/style/images/tweets-from.png" width="150" height="25" alt="TWEETS FROM US"></H2></div>
			<div class="query_tweet tweets"><H2><img src="<?php echo bloginfo('template_url');?>/style/images/tweets-about.png" width="150" height="25" alt="TWEETS ABOUT US"></H2></div>
			</div>	
		</div>
			
			
			
		
	
		
<?php get_footer(); ?>