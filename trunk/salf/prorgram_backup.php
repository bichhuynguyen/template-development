<?php
session_start();
/*
Template Name: Program
*/
/*FB::log($_POST,'POST');//firephp
//FB::log($_SESSION['venues_used'],'Venues Used');//firephp
//FB::log($_SESSION['get_post_ID_by_meta_value'],'Search Results');//firephp
//FB::log($_SESSION['artist'],'Artists');//firephp

FB::log($_SESSION['get_program_dates'],'get_program_dates');//firephp
FB::log($_SESSION['calendar_build'],'calendar build');//firephp
FB::log($_SESSION['date_posts'],'Posts after processing');//firephp
FB::log($_SESSION['venue_slug'],'venue slug');//firephp
FB::log($_SESSION['venue_check'],'venue check');//firephp
//*/
?>

<?php 


get_header(); ?>

		
		<div class="post" id="home">
			<div id="browse-head"><img style="float: left; margin-bottom: 12px" src="<?php bloginfo('template_url');?>/style/images/Browse.png"  alt="Browse" />
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; endif; ?>
			</div>
			
		
			<div id="news-archive">
				<form method="post" action="<?php echo curPageURL();?>">
				<div class="archive-type venue">
				<h3>Choose Venues</h3>
				<?php
				
				//Get Venue Names
				$venues_sort = mf_SALF_sort_by_meta('Venues');
				$venues_used = match_venues_to_used_meta($venues_sort);
				//$_SESSION['venues_used'] = $venues_used;//firephp
				
				
				$post_IDs = just_array_keys($_POST);
				// Create Check Boxes For Venue Selection
				foreach ($venues_used as $id => $venue_check):
				$full_slug_string = preg_replace('/[\s]/','-',$venue_check);//produce slug for title and name in checkbox series.
				
				
				?>
				
				<div style="float:left;clear:both;width: 200px;"><input style="float:right;clear:both;" type="checkbox" name="<?php echo $id;?>" id="<?php echo $full_slug_string.$id;?>" <?php if(in_array($id, $post_IDs)):?>checked="checked"<?php endif;?> /><label for="<?php echo $full_slug_string.$id;?>"><?php echo $venue_check;?></label>
				</div>


				<?php endforeach; ?>
				<input type="submit" value="submit" name="submit" />
				
				</div>
				</form>
				
				<?php 
				//---------------
				// Dates
				//---------------
				?>
			<div class="archive-type calendar">	
				<?php $_SESSION['get_program_dates']=create_all_program_dates_array();?>
				<?php
				 
				$program_dates_array = create_all_program_dates_array(); 
				$full_calendar_array = create_calendar_array($program_dates_array);
				echo create_html_calendar($full_calendar_array);	$_SESSION['calendar_build']=$full_calendar_array;?>
			</div>	
			</div>
			
			<div class="news archive-header">
				<img  src="<?php echo bloginfo('template_url'); ?>/style/images/news-top.png"  alt="News Top" />
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
					
					
					
					<?php endwhile;
					endif; 
					//Reset Query
					//wp_reset_query();
					?>
			<?php elseif(count($_POST)>1)://if search form submitted, and a venue selected?>	
				
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
					<? //$_SESSION['artist'] = $artist;//firephp?>
					<?php //foreach($artist as $artist):?>

					<a href="<?php echo get_permalink($artist->ID);?>"><?php echo $artist->post_title; ?></a>
					<?php //endforeach;?>
					</div>
					</div>
					
					
					<?php endif;?>
			
			
				</div>
			<? endforeach;?>
			<?php else: ?>
			<h3>No Results</h3>
			<p>Please make sure you have selected a venue.</p>
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