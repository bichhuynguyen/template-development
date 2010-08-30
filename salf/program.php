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


get_header(); 

?>

		
		<div class="post" id="home">
			 
			<script src="<?php bloginfo('template_url');?>/scripts/program.js"></script>
			<div id="program-head"><a href="<?php curPageURL();?>"><img style="float: left; margin-bottom: 12px" src="<?php bloginfo('template_url');?>/style/images/Program-title.png"  alt="Program" /></a>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; endif; ?>
			</div>
			
		
			<div id="program_search">
				<form method="post" action="<?php echo curPageURL();?>">
				<div class="search_element venue">
				<h3>Search by Venue</h3>
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
				<h3>Search by Day</h3>	
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
			<?php if(!isset($get_posts)) ://no search submitted?>
				
			<?php $news_query = new WP_Query('post_type=program&nopaging=true');
			$_SESSION['news_query'] = $news_query;
			if ($news_query->have_posts()) : while ($news_query->have_posts()) : $news_query->the_post(); ?>

						<?php 	
								//Include program-meta-include
								$template = get_function_directory_extension();
								include($template.'/program-meta-include.php');

						?>
				
					<div class="event">
						<h3><?php the_title(); ?></h3>
						
						
						<?php echo program_meta_display($date,$time,$venue, $artist,$price,$eventbrite_link,get_the_ID())?>
						<?php mf_post_thumbnail('small-cropped',false,'program-thumb');?>
						<?php the_content(); ?>
						
						</div>
			
						
						
					
					
					<?php endwhile;
					endif; 
					//Reset Query
					//wp_reset_query();
					?>
					
			<?php elseif(count($_SESSION['venue_post_vars'])>1 OR $_SESSION['date_search'])://if search form submitted, and a venue selected OR date search performed
			?>	
				
				<?php
				
				
			
			
			//The Loop!!
			foreach ($get_posts as $venue_id => $current_post):
			$_SESSION['current_post'] = $current_post;
			
			?>

				
					<?php 	
							//Include program-meta-include
							$custom_loop = true; //tell include file to render custom loop vars
							$template = get_function_directory_extension();
							include($template.'/program-meta-include.php');
							$custom_loop = false;//reset custom loop var

					?>
					<div class="event">
					<h3><?php echo $current_post->post_title;?></h3>
					<?php echo program_meta_display($date,$time,$venue, $artist,$price,$eventbrite_link,$current_post->ID)?>
					<?php mf_post_thumbnail('small-cropped', $current_post->ID, 'program-thumb' );?>
					<p><?php echo $current_post->post_content;?></p>

					
					
					</div>




				
			<? endforeach;
			
			
			?>
			
			<?php else: ?>
			<h3>No Results</h3>
			<p>Please make sure you have selected a venue.</p>
			<?php endif;?>	
			</div><!--End news-feed-->
			
				
				
			</div><!--End post-->	   	
			
			
			
		
		
		</div>
	
		
	

		
		
		
		
		
		
	
		
		
<?php 
$_SESSION['date_search']=FALSE;//resets date search
unset($_SESSION['date_posts']);//unset date search
get_footer(); ?>