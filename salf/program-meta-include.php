<?php 	
/*
* This is variables needed for the program_meta_display() function, which renders
* the meta data for each program element
*/

if($custom_loop != true)://checks to see if the vars needed are for a normal loop

					$venue_ID = get_post_meta(get_the_ID(), 'mf_SALF_meta_venue', true);
					$venue = get_post($venue_ID);
					$artist_ID = get_post_meta(get_the_ID(), 'mf_SALF_artist_meta_checks', true);

					$artist = array();
				if ($artist_ID !=""){
					foreach ($artist_ID as $artist_post){
						array_push($artist, get_post($artist_post));
					}
				} 
					$time = get_post_meta(get_the_ID(), 'mf_SALF_meta_time', true);
					$time =  mf_get_time($time);
					fb::log($time,'time');
					$eventbrite_link = get_post_meta(get_the_ID(), 'mf_SALF_meta_eventbrite', true);
					$price = get_post_meta(get_the_ID(), 'mf_SALF_meta_price', true);
					$date = get_post_meta(get_the_ID(), 'mf_SALF_meta_date', true);
					
else:// if custom_loop set to true, fetch the vars with different methods					
					
					$venue_ID = get_post_meta($current_post->ID, 'mf_SALF_meta_venue', true);
					
					$venue = get_post($venue_ID);
					
					$artist_ID = get_post_meta($current_post->ID, 'mf_SALF_artist_meta_checks', true);

					$artist = array();
				if ($artist_ID !=""){
					foreach ($artist_ID as $artist_post){
						array_push($artist, get_post($artist_post));
					}
				} 

					$eventbrite_link = get_post_meta($current_post->ID, 'mf_SALF_meta_eventbrite', true);
					$price = get_post_meta($current_post->ID, 'mf_SALF_meta_price', true);
					$date = get_post_meta($current_post->ID, 'mf_SALF_meta_date', true);
endif;//end custom loop check
?>