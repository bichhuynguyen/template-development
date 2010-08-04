<?php
/*
Template Name: Program
*/
?>
<?php get_header(); ?>

		
		<div class="post" id="home">
			<div id="browse-head"><img style="float: left; margin-bottom: 12px" src="<?php bloginfo('template_url');?>/style/images/Browse.png"  alt="Browse" />
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; endif; ?>
			</div>
			<?php
			$venues_sort = mf_SALF_sort_by_meta('Venues');
			$get_meta_for_ID = get_post_ID_by_meta_value(129);
			$_SESSION['venues'] = $venues_sort;
			$_SESSION['get_post_ID_by_meta_value'] = $get_meta_for_ID;
			
			?>
			<div id="news-archive">
				<div class="archive-type category">
				<h3>Browse by Category</h3>
				<ul>
				<?php $args = array(
					'title_li'	=> ''
					/*
				    'type'            => 'monthly',
				    
				    'format'          => 'html', 
				    
				    'show_post_count' => false,
				    'echo'            => 1 */); 
					wp_list_categories( $args );?>
				</ul>
				</div>
				<div class="archive-type date">
				<h3>Browse by Date</h3>
				<ul>
				<?php $args = array(
				    'type'            => 'monthly',
				    
				    'format'          => 'html', 
				    
				    'show_post_count' => false,
				    'echo'            => 1 ); 
					wp_get_archives( $args );?>
				</ul>
				</div>
				<div class="archive-type category">
				<h3>Browse by Author</h3>
				<ul>
				<?php $args = array(
					'exclude_admin'	=>	false
					/*
				    'type'            => 'monthly',
				    
				    'format'          => 'html', 
				    
				    'show_post_count' => false,
				    'echo'            => 1 */); 
					wp_list_authors( $args );?>
				</ul>
				</div>
				
				
			</div>
			
			<div class="news archive-header">
				<a class="news-top" href="<?php bloginfo('rss_url'); ?>"><img  src="<?php echo bloginfo('template_url'); ?>/style/images/news-top.png"  alt="News Top"></a><span style="opacity: 0;"class="subscribe-hint">Get RSS Feed&nbsp;<img style="float: right;"src="<?php echo bloginfo('template_url'); ?>/style/images/social/feed.png" width="16" height="16" alt="Feed"></span>
			<div id="news-feed">
			<?php
			$news_query = new WP_Query('post_type=program');
			if ($news_query->have_posts()) : while ($news_query->have_posts()) : $news_query->the_post(); ?>



				
					
						
					
					
					<?php 	$venue_ID = get_post_meta(get_the_ID(), 'mf_SALF_meta_venue', true);
							$venue = get_post($venue_ID);
							$artist_ID = get_post_meta(get_the_ID(), 'mf_SALF_artist_meta_checks', true);

							$artist = array();
						if ($artist_ID !=""){
							foreach ($artist_ID as $artist_post){
								array_push($artist, get_post($artist_post));
							}
						} 

							$eventbrite_link = get_post_meta(get_the_ID(), 'mf_SALF_meta_eventbrite', true);
							$price = get_post_meta(get_the_ID(), 'mf_SALF_meta_price', true);
							$date = get_post_meta(get_the_ID(), 'mf_SALF_meta_date', true);
					?>	
				<?php //<a href="<?php the_permalink();">?>
					<div class="archive-link new-entry">
						<h2>     <?php the_title(); ?></h2><div class="post-details"><?php echo $date;?>  <a href="<?php echo get_permalink($venue->ID);?>"><?php echo $venue->post_title; ?></a></div>
						<?php mf_post_thumbnail('small-cropped');?>
						<?php the_excerpt(); ?>
						<p class="price"><?php if ($price != ""):?>£<?php echo $price; endif; if ($eventbrite_link != ""):?><a href="<?php echo $eventbrite_link;?>" target="_blank"> Buy Tickets Online</a><?php endif;?></p>
						
						<?php if (count($artist)>0):?>		
						<div class="meta">
						<?php foreach($artist as $artist):?>

						<a href="<?php echo get_permalink($artist->ID);?>"><?php echo $artist->post_title; ?></a>
						<?php endforeach;?>
						</div>
						<?php endif;?>
						
					</div>
					
				</a>	
					
					




					<?php endwhile;
					endif; 
					//Reset Query
					//wp_reset_query();
					?>
					
				
			</div><!--End news-feed-->
			
				<div style="float: left;"class="tag-cloud">
				
					<?php $args = array(
					    'smallest'  => 8, 
					    'largest'   => 22,
					    'unit'      => 'pt', 
					    'number'    => 45,  
					    'format'    => 'flat',
					    //'separator' => '\n',
					    'orderby'   => 'name', 
					    'order'     => 'ASC',
					    //'exclude'   => , 
					    //'include'   => , 
					    'link'      => 'view', 
					    'taxonomy'  => 'post_tag', 
					    'echo'      => true ); ?>
					<?php wp_tag_cloud($args); ?> 
				</div>
				
			</div><!--End post-->	   	
			
			
			
		
		
		</div>
	
		
	

		
		
		
		
		
		
	
		
		
<?php get_footer(); ?>