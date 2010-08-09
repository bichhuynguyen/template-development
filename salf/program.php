<?php
//FB::log($_POST,'POST');//firephp
//FB::log($_SESSION['venues_used'],'Venues Used');//firephp
//FB::log($_SESSION['get_post_ID_by_meta_value'],'Search Results');//firephp
//FB::log($_SESSION['artist'],'Artists');//firephp

FB::log($_SESSION['get_program_dates'],'get_program_dates');//firephp

/*
Template Name: Program
*/
?>

<?php 
session_start();

get_header(); ?>

		
		<div class="post" id="home">
			<div id="browse-head"><img style="float: left; margin-bottom: 12px" src="<?php bloginfo('template_url');?>/style/images/Browse.png"  alt="Browse" />
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; endif; ?>
			</div>
			
		
			<div id="news-archive">
				<form method="post" action="<?php echo curPageURL();?>">
				<div class="archive-type category">
				<h3>Choose Venues</h3>
				<?php
				
				//Get Venue Names
				$venues_sort = mf_SALF_sort_by_meta('Venues');
				$venues_used = match_venues_to_used_meta($venues_sort);
				$_SESSION['venues_used'] = $venues_used;//firephp
				
				
				$post_IDs = just_array_keys($_POST);
				// Create Check Boxes For Venue Selection
				foreach ($venues_used as $id => $venue_check):?>

				<div style="float:left;clear:both;width: 200px;"><label for="<?php echo $id;?>"><?php echo $venue_check;?></label><input style="float:right;clear:both;" type="checkbox" name="<?php echo $id;?>" id="<?php echo $id;?>" <?php if(in_array($id, $post_IDs) OR count($_POST)<1):?>checked="checked"<?php endif;?> /></div>


				<?php endforeach;?>
				<input type="submit" value="submit" name="submit" />
				</div>
				
				</form>
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
			<?php if(count($_POST)<1) ://if search form NOT submitted?>
				
			<?php $news_query = new WP_Query('post_type=program');
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
			<?php else://if search form submitted	?>	
				
				<?php
				
				//create object loop from venue search
				foreach($_POST as $id => $status){
					if($status == 'on'){
						$post_array[$id] = get_post_ID_by_meta_value($id);
					}
				}
				
				
				//Create array of post objects
				foreach($post_array as $id=>$object){
					$get_posts[$id]=$object[0];
				}
				
			//The Loop!!
			foreach ($get_posts as $venue_id => $the_post):?>
				<div class="event">
					<?php 	
							//Get the meta data
							$venue_ID = get_post_meta($the_post->ID, 'mf_SALF_meta_venue', true);
							$venue = get_post($venue_ID);
							$artist_ID = get_post_meta($the_post->ID, 'mf_SALF_artist_meta_checks', true);

							$artist = array();
						if ($artist_ID !=""){
							foreach ($artist_ID as $artist_post){
								array_push($artist, get_post($artist_post));
							}
						} 

							$eventbrite_link = get_post_meta($the_post->ID, 'mf_SALF_meta_eventbrite', true);
							$price = get_post_meta($the_post->ID, 'mf_SALF_meta_price', true);
							$date = get_post_meta($the_post->ID, 'mf_SALF_meta_date', true);
					?>
					
					
					<h2><?php echo $the_post->post_title;?></h2><div class="post-details"><?php echo $date;?>  <a href="<?php echo get_permalink($venue->ID);?>"><?php echo $venue->post_title; ?></a></div>
					<p><?php echo $the_post->post_content;?></p>
					
					<p class="price"><?php if ($price != ""):?>£<?php echo $price; endif; if ($eventbrite_link != ""):?><a href="<?php echo $eventbrite_link;?>" target="_blank"> Buy Tickets Online</a><?php endif;?></p>
					
					<?php if (count($artist)>0):?>		
					<div class="meta">
					<?$_SESSION['artist'] = $artist;//firephp?>
					<?php //foreach($artist as $artist):?>

					<a href="<?php echo get_permalink($artist->ID);?>"><?php echo $artist->post_title; ?></a>
					<?php //endforeach;?>
					</div>
					</div>
					<?php endif;?>
			
			
				</div>
			<? endforeach;?>
			<?php endif;?>	
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