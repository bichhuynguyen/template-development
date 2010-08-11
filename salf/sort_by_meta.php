<?php
session_start();//firephp
//FB::log($_SESSION['venues'],'Venues');//firephp
//FB::log($_SESSION['get_post_ID_by_meta_value'],'Venues');//firephp


//-------------
//Venue Sorting
//-------------
function mf_SALF_sort_by_meta($type){
global $wpdb;
$meta_array = array();
$query = "SELECT post_title, ID FROM $wpdb->posts WHERE post_type='$type' AND post_status ='publish'";


$meta_query= $wpdb->get_results($query);
	
	foreach ($meta_query as $object){
		$i = get_object_vars($object);
		$meta_array[$i['ID']]=$i['post_title'];
		
	}
	if (count($meta_array)<1) $meta_array[0]='No '.$type.' Found!';//*/
	
		
	return $meta_array;
}//*/

function get_post_ID_by_meta_value($value){
	global $wpdb;
	
	//Build Query, find Post ID's based on post meta values.
	$meta_array = array();
	$query = "SELECT post_id FROM $wpdb->postmeta WHERE meta_value='$value'";
	$post_ID_query= $wpdb->get_results($query);
	
	//Convert into usable array.
	$post_ID_array = array();
	foreach ($post_ID_query as $post){
		array_push($post_ID_array, $post->post_id);
	}  
	
	//Build Object Array of Posts
	$post_object_array = array();
	foreach ($post_ID_array as $post_ID){
		$post_object_array[]=get_post($post_ID);
	}
	
	return $post_object_array;
}
//returns $id->$title array for used venues, according to post_meta
function match_venues_to_used_meta($venue_array){
	global $wpdb;
	//build query array
	foreach($venue_array as $id => $title){
		$query[$id] = "SELECT post_id FROM $wpdb->postmeta WHERE meta_value='$id'";
	}
	//run queries
	foreach ($query as $id => $query){
		$post_ID_query[$id]= $wpdb->get_results($query);
	}
	//find lengths of arrays(to establish if they have been used in posts)
	foreach ($post_ID_query as $id=>$count){
		$counted[$id]=count($count);
	}
	//remove all elements that equal 0, and place key's as value
	foreach ($counted as $id=>$count){
		if($count>0){
			$used_venue[]=$id;
		};
	}
	//get final $id=>$title array of used venues
	foreach ($venue_array as $id=>$title){
		if(in_array($id,$used_venue)){
			$final_used_venue_list[$id]=$title;
		}
	}
	
	return $final_used_venue_list;
}

//create post id array from post variable/venue search
function get_program_ids_from_selected_venues($post_var){
	foreach($post_var as $id => $status){
		if($status == 'on'){
			$post_array[$id] = get_post_ID_by_meta_value($id);
		}
	}
	
	
	//Create array of post objects
	foreach($post_array as $id=>$object){
		$ids[]=$id;//firephp
		$_SESSION['ids']= $ids;//firephp
		$get_posts[$id]=$object[0];
	}
	return $get_posts;
}

//break down array of post objects into an array of ID's
function get_just_post_ids($object_array = false){
	if($object_array){
		foreach ($object_array as $object){
			$id_array[]=$object->ID;
		}
		return $id_array;
	} else {
		return FALSE;
	}
}

//---------------
//Date Sorting
//---------------
//Functions for sorting program info by date


//Creates an array with all program dates, with program post id, as multidimensional array 
function create_all_program_dates_array(){
	global $wpdb;
	
	//Build Query. Fetch all post id's and dates from Post Meta
	$query = "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key='mf_SALF_meta_date'";
	// Run Query
	$post_ID_query= $wpdb->get_results($query);
	//seperate days/months/years
	foreach ($post_ID_query as $post_dates){
		
		//create $post_id->$date array
		$dates[$post_dates->post_id]=$post_dates->meta_value;
		
		//explode dates within array as day/month/year
		foreach ($dates as $post_id=>$post_date){
			$exploded_post_date_array[$post_id] = explode('/',$post_date);
			
			//Create Key Values, Day, Month, Year
			$exploded_post_date_array[$post_id]['day']= $exploded_post_date_array[$post_id][0];
			$exploded_post_date_array[$post_id]['month']= $exploded_post_date_array[$post_id][1];
			$exploded_post_date_array[$post_id]['year']= $exploded_post_date_array[$post_id][2];
			
			//remove old key values
			unset($exploded_post_date_array[$post_id][0]);
			unset($exploded_post_date_array[$post_id][1]);
			unset($exploded_post_date_array[$post_id][2]);
		}
	
	}
	
	
	return $exploded_post_date_array;
}

//create an array containing all dates in a month, with post id's 
//attached to dates, and FALSE on days with no date.
function create_calendar_array($used_dates){

	//create array of dates for October with false attributes
	$october = array();
	for($day=1;$day<=31;$day++){
		$october[$day]=FALSE;
	}
	
	//compare used dates to whole month
	foreach	($used_dates as $post_id=>$date){
		$october[intval($date['day'])][]=$post_id;
	}
		
	
	return $october;
}

// creates grid calendar
function create_html_calendar($october){
	//create HTML output
	$html_output = '<table id="calendar_search" summary="Calendar Selector for Program.">';
	$html_output .= '<thead>';
	$html_output .= '<tr>';
	$html_output .= '<th class="weekday" scope="col" abbr="Monday" title="Monday">M</th>';
	$html_output .= '<th class="weekday" scope="col" abbr="Tuesday" title="Tuesday">T</th>';
	$html_output .= '<th class="weekday" scope="col" abbr="Wednesday" title="Wednesday">W</th>';
	$html_output .= '<th class="weekday" scope="col" abbr="Thursday" title="Thursday">T</th>';
	$html_output .= '<th class="weekday" scope="col" abbr="Friday" title="Friday">F</th>';
	$html_output .= '<th class="weekday" scope="col" abbr="Saturday" title="Saturday">S</th>';
	$html_output .= '<th class="weekday" scope="col" abbr="Sunday" title="Sunday">S</th>';
	$html_output .= '</tr>';
	$html_output .= '</thead>';
	
	$html_output .= '<tbody>';
	
	$weekday = 4;//Offset to start month on FRIDAY.
	$html_output .= "<tr><td></td><td></td><td></td><td></td>";
	$firstweek = TRUE;
	$_SESSION['date_process_url'] = curPageURL();//Set Current Location for form processing
	foreach ($october as $id => $post){
		if ($weekday == 0){
			$html_output .= "<tr>";
		} 
		
			if($post){
				//create string for all posts in this section
				$posts_string = NULL;
				foreach($post as $post_id){
					if ($posts_string == NULL){
						$posts_string .= $post_id;
					} else {$posts_string .=','.$post_id;}
				}
				$html_output .= "<td class='has_posts'><a href='".get_bloginfo('template_url')."/date_processing.php?posts=".$posts_string."'>".$id."</a></td>";
			} else{
				$html_output .= "<td class='no_posts'>".$id."</td>";
			}
		
		$weekday++;
		if ($weekday == 7){
			$html_output .= '</tr>';
			$weekday = 0;
			$firstweek = FALSE;
		} 
		
	}
	
	
	$html_output .= '</tbody>';
	$html_output .= '</table>';
	
	return $html_output;
}	
	

?>