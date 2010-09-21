<?php
ob_start();

session_start();
/*
Template Name: Program
*/

//set session for venue posts
if (!isset($_SESSION['venue_post_vars'])) $_SESSION['venue_post_vars'] = array();

//if date search has not been used, reset session to post
if ($_SESSION['date_search']!=TRUE){
	$_SESSION['venue_post_vars'] = clean($_POST);
}
//process date search variables with functions from sort_by_meta, so we can use wordpress global vars
if (isset($_SESSION['date_posts'])){
	$date_search_objects = mf_get_posts_by_ID_array($_SESSION['date_posts']);
}







// If Venue search has been used
//get post ID's from from venue search
if (count($_SESSION['venue_post_vars'])>1){
	
	$get_posts = get_program_ids_from_selected_venues($_SESSION['venue_post_vars']);
	$get_post_id_array = get_just_post_ids($get_posts);
	
}
// if $date_search_objects exists, use that for post object instead.
if(isset($date_search_objects)) $get_posts = $date_search_objects;
if (isset($get_posts)) $get_posts = sort_by_sub_element($get_posts,'menu_order');


get_header(); 

?>

		
		<div class="post" id="home">
			 
			<script src="<?php bloginfo('template_url');?>/scripts/program.js"></script>
			<div id="program-head"><img style="float: left; margin-bottom: 12px" src="<?php bloginfo('template_url');?>/style/images/Program-title.png"  alt="Program" />
			
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="clear"><?php the_content(); ?></div>
			<?php endwhile; endif; ?>
			<?php if(count($_POST)>0) :
			$url = curPageURL();
			$url = explode('?search', $url);
			$url = $url[0];
			
			?>
				<p class="chimp" style="clear: both;"><a style="color: #ffffff;" href="<?php echo $url;?>">Clear Results</a></p>
			<?php endif;?>
			</div>
			
		
			<div id="program_search">
				<form method="post" action="<?php echo remove_post_vars(curPageURL());?>?search=event">
				<div class="search_element events">
				<h3>Search by Event Type</h3>
				<?php
				
				//Get Venue Names
				$events_sort = mf_get_post_titles('Events');//get's names of events
				$events_used = match_venues_to_used_meta($events_sort);
				
				
				
				$post_IDs = just_array_keys($_SESSION['venue_post_vars']);
				// Create Check Boxes For Venue Selection
				foreach ($events_used as $id => $venue_check):
				$full_slug_string = preg_replace('/[\s]/','-',$venue_check);//produce slug for title and name in checkbox series.
				
				
				?>
				
				<div style="float:left;clear:both;width: 200px;"><input style="float:right;clear:both;" type="checkbox" name="<?php echo $id;?>" id="<?php echo $full_slug_string.$id;?>" <?php if(in_array($id, $post_IDs)):?>checked="checked"<?php endif;?> /><label for="<?php echo $full_slug_string.$id;?>"><?php echo $venue_check;?></label>
				</div>


				<?php endforeach; ?>
				<input type="submit" value="submit" name="submit" />
				
				</div>
				</form>
				<form method="post" action="<?php echo remove_post_vars(curPageURL());?>?search=venue">
				<div class="search_element venue">
				<h3>or Search by Venue</h3>
				<?php
				
				//Get Venue Names
				$venues_sort = mf_get_post_titles('Venues');//get's names of venues
				$venues_used = match_venues_to_used_meta($venues_sort);
				//$_SESSION['venues_used'] = $venues_used;//firephp
				
				
				$post_IDs = just_array_keys($_SESSION['venue_post_vars']);
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
			<div class="search_element calendar">
				<h3>Filter Results by Day</h3>	
				<?php $_SESSION['get_program_dates']=create_all_program_dates_array();//firephp?>
				<?php
				if (!isset($get_post_id_array)) $get_post_id_array = FALSE; 
				$program_dates_array = create_all_program_dates_array($get_post_id_array); 
				$full_calendar_array = create_calendar_array($program_dates_array);
				echo create_html_calendar($full_calendar_array);	$_SESSION['calendar_build']=$full_calendar_array;?>
			</div>	
			</div>
			
			<div class="program_content">
			
			<div id="program_feed">
			
				
			<?php $news_query = new WP_Query('post_type=program&nopaging=true&orderby=menu_order');
			if(isset($get_posts)) :// search submitted
				$news_query->posts = $get_posts;
				$news_query->post_count = count($news_query->posts);
				//fb::log($news_query);
			else:
				$news_query->posts = array_reverse($news_query->posts);//reverse posts
			endif;
			
			
			if ($news_query->have_posts()) : while ($news_query->have_posts()) : $news_query->the_post(); 
			
			?>
						
						<?php 	
								//fb::log($post,'post');
								//Include program-meta-include
								$template = get_function_directory_extension();
								include($template.'/program-meta-include.php');

						?>
				
					<div class="event">
						<h3><?php the_title(); ?></h3>
						
						
						<?php echo program_meta_display($date,$time,$venue, $artist,$price,$eventbrite_link, $concession_link,get_the_ID())?>
						<?php mf_post_thumbnail('small-cropped',false,'program-thumb');?>
						<?php the_content(); ?>
						<?php mf_socialise_post('Can\'t wait for');?>
						</div>
			
						
						
					
					
					<?php endwhile;
					endif; 
					//Reset Query
					//wp_reset_query();
					?>
					
			
			
			
			</div><!--End news-feed-->
			
				
				
			</div><!--End post-->	   	
			
			
			
		
		
		</div>
	
		
	

		
		
		
		
		
		
	
		
		
<?php 
$_SESSION['date_search']=FALSE;//resets date search
unset($_SESSION['date_posts']);//unset date search
get_footer(); ?>