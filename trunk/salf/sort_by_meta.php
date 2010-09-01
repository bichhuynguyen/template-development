<?php
ob_start();
session_start();//firephp

////fb::log($_SESSION['artist_query'],'artist_debug');//firephp
//////fb::log($_SESSION['get_post_ID_by_meta_value'],'Venues');//firephp


//-------------
//Venue Sorting
//-------------
function mf_get_post_titles($type = false){
	//returns list of published post titles, with ID's
	//$type used to speciify post type, if empty defaults to ALL published posts
global $wpdb;
$meta_array = array();
if (!$type){
	$query = "SELECT post_title, ID FROM $wpdb->posts WHERE post_status ='publish'";
} else {
	$query = "SELECT post_title, ID FROM $wpdb->posts WHERE post_type='$type' AND post_status ='publish'";
}

$meta_query= $wpdb->get_results($query);
	
	foreach ($meta_query as $object){
		$i = get_object_vars($object);
		$meta_array[$i['ID']]=$i['post_title'];
		
	}
	if (count($meta_array)<1) $meta_array[0]='No '.$type.' Found!';//*/
	
		
	return $meta_array;
}//*/

//Build Object Array of Posts from an array of ID's
//used to recreate the Loop
function mf_get_posts_by_ID_array($post_ID_array){
	global $wpdb;
	foreach ($post_ID_array as $post_ID){
	$query[] = "SELECT post_title, ID FROM $wpdb->posts WHERE post_status ='publish' AND post_id = '$post_ID'";
	}
	
	
	foreach ($post_ID_array as $post_ID){
		$post_object_array[]=get_post($post_ID);
	}
	foreach ($post_object_array as $post_object){
		if ($post_object->post_status == 'publish'){
			$published_objects[]=$post_object;
		}
	}
	
	return $published_objects;
}
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
	
	$post_object_array=mf_get_posts_by_ID_array($post_ID_array);
	
	
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
function get_program_ids_from_selected_venues($venue_var = FALSE){
	
	foreach($venue_var as $id => $status){
		if($status == 'on'){
			$post_array[$id] = get_post_ID_by_meta_value($id);
		}
	}
	
	
	//Create array of post objects
	foreach($post_array as $id=>$object){
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
function create_all_program_dates_array($valid_post_array = FALSE){
	
	global $wpdb;
	
	//Build Query. Fetch all post id's and dates from Post Meta
	$query = "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key='mf_SALF_meta_date'";
	// Run Query
	$post_ID_query= $wpdb->get_results($query);
	$post_ID_query = remove_unpublished_posts($post_ID_query);
	
	
	
	
	
	//seperate days/months/years
	foreach ($post_ID_query as $post_dates){
		
		//create $post_id->$date array
		$dates[$post_dates->post_id]=$post_dates->meta_value;
		
		//unset invalid posts (program dates from unselected venues)
		if($valid_post_array){//if have valid posts
			foreach ($dates as $post_id=>$post_date){
				if(!in_array($post_id,$valid_post_array)) unset($dates[$post_id]);
			}
		}
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
	$festival_days = range(15,31);//get festival dates.
	//create HTML output
	$html_output = "<h4>October</h4>";
	$html_output .= "<div class='calendar_search'>";
	
	$html_output .= '<table class="calendar_search" summary="Calendar Selector for Program.">';
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
		//checks to see if date  is in festival days.
		if (in_array($id, $festival_days)){
			$in_fest = ' festival_day';
		} else {
			$in_fest = '';
		}
		
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
				$html_output .= "<td class='has_posts".$in_fest;
				
				$html_output .= "'><a href='".get_bloginfo('template_url')."/date_processing.php?posts=".$posts_string."'>".$id."</a></td>";
			} else{
				$html_output .= "<td class='no_posts ".$in_fest."'>".$id."</td>";
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
	$html_output .= '</div>';
	return $html_output;
}	


	
//build HTML output for program meta data on program page
function program_meta_display($date = false,$time=false,$venue=false, $artist=false,$price=false,$eventbrite_link=false,$id=false){
	$return = '<div class="post-details">';
	$return .= '<div class="date"><h4>Date:&nbsp;</h4><span>'.$date.'</span></div>';
	$return .= '<div class="time"><h4>Time:&nbsp;</h4><span>'.$time.'</span></div>';
	$return .= '<div class="venue"><h4>Venue:&nbsp;</h4><a href="'. get_permalink($venue->ID).'">'.$venue->post_title.'</a></div>';
	if ($artist && count($artist)>0):		
		$return .= '<ul class="meta artist"><h4>Artists:</h4>';
		foreach($artist as $artist):
			$return .= '<li><a href="'.get_permalink($artist->ID).'">'.$artist->post_title.'</a></li>';
		endforeach;
	$return .= '</ul>';
	endif;
	//Start
	//Get Taxonomy
	
	$meta_list = array();
	$args = array(
				'type' => 'Elements',
		);
	$meta = get_the_term_list($id,'Elements','<li>','</li><li>','</li>');
	
	if ($meta){//check if there is any meta data returns (get_the_term_list returns false if empty)
		$return .= '<ul class="elements">';
		$return .= '<h4>Elements</h4>';
		$meta_stripped = strip_tags($meta,'<li>'); 
		$_SESSION['meta'] = $meta_stripped;
		$return .= $meta_stripped;
		$return .= '</ul>';
	}
	//Get Taxonomy
	//End
	$return .= '<ul class="price">';
	$return .= '<h4>Price</h4>';
		if (strtolower($price) == "free"){ 
			$return .='<li><span>'.$price.'</span></li>'; 
		} elseif ($price != "") {
			$return .='<li><span>£'.$price.'</span></li>'; 
		}
		if ($eventbrite_link != "") $return .='<li class="tickets"><a  style="margin: 10px;" href="'. $eventbrite_link.'" target="_blank"><img src="'.get_bloginfo('template_url').'/style/images/tickets.png" /></a></li>'; 
	$return .='</ul>';
	
	
	$return .= '</ul>';
	$return .= '</div>';
	
	return $return;
	
}
/*
*-----MAPS
*/
//fetches MAP url from meta table, and converts it into an HTML iframe.
function mf_render_google_maps($post_id, $width=395,$height=395){
	
	
	//get map meta data from datbase, based on ID
	$meta_from_id = get_post_meta($post_id, 'mf_SALF_maps_meta_map');
	//if nothing found, return false. End Function.
	if(count($meta_from_id)<1) return false; 
	
	//get link element and trim it
	$map_link = trim($meta_from_id[0]);
	
	
	
	$html_return =  '<iframe class="google-map" width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="';
	//$html_return .= $map_link;
	$html_return .= 'http://maps.google.com/?ie=UTF8&amp;hq=&amp;hnear=&amp;ll=51.565266,-1.747813&amp;spn=0.007736,0.022638&amp;t=h&amp;z=16';
	$html_return .= '&amp;output=embed"></iframe>';
	
	
	
	$_SESSION['maps_debug']= $html_return;
	return $html_return;
}

function mf_get_posts_connected_to_meta($meta_value, $return_array = false, $artist = false){
/*
* returns an array of post ID's connected to a certain 
* meta object, based on meta value
* 
* if $return_array remains false, function will continue and produce a HTML 
* unordered list,
* sans UL elements (this is so it is easier to add classes, ID's and other attributes)
* otherwise returns multidimensional array, 	id 	-> 'link' 
*													-> 'title'
*
*
* runs different query for Artist is 3rd $arg true (hack: very specific to SALF)
*/
	global $wpdb;

	$query = "SELECT post_id FROM $wpdb->postmeta WHERE meta_value='$meta_value'";
	
	if($artist){
		$query = "SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key= 'mf_SALF_artist_meta_checks'";
		
		
	}
	
	//run query, get list of post ID's connected to this meta
	$post_ID_query = $wpdb->get_results($query);
	$post_ID_query = remove_unpublished_posts($post_ID_query);
	
	
	
	
	
	
	
	
	$_SESSION['artist_query'] = $post_ID_query;
	//create array $post_ID -> $permalink
	foreach($post_ID_query as $post){
		if(!$artists || in_array($post_id,$post_ID_query->meta_value)){
			
			$posts[$post->post_id]['link'] = get_permalink($post->post_id);
			$posts[$post->post_id]['title'] = get_the_title($post->post_id);
		} 
	}
	if($posts===null) return false;
	
	
	
	if($return_array){
		return $posts;
	}
	
	foreach ($posts as $list_element){
		$html_list .= '<li><a href="';
		$html_list .= $list_element['link'];
		$html_list .= '">';
		$html_list .= $list_element['title'];
		$html_list .= '</a></li>';
	}
	////fb::log($html_list,'Venue Debug');
	return $html_list;
}
function remove_unpublished_posts($post_ID_query){
	/*
	* Take's array of post objects, removes unpublished posts, returns array of objects
	*/
	global $wpdb;
	$date_object = count($post_ID_query);
	
	//build query to find is posts within the results are not published
	$post_query .= "SELECT ID FROM $wpdb->posts WHERE post_status != 'publish' AND (";
	for($i=0; $i<$date_object;$i++){
		$current_object = $post_ID_query[$i];
		$post_query .= "ID='$current_object->post_id'";
		if ($i<($date_object-1)){//add or at the end of each query, expect the last one
			$post_query .= " OR ";
		} else{
			$post_query .= ");";
		}
	}
	$trashed_post_id = $wpdb->get_results($post_query);
	//make array of id's of trashed posts
	$trashed_post_id = get_just_post_ids($trashed_post_id);
	//cycle though results or date query, unsetting trashed id's
	if (is_array($trashed_post_id)){//check to see $trashed_post_id has results
		foreach($post_ID_query as $key=>$post){
			//is post id in trashed list?
		
			if(in_array($post->post_id,$trashed_post_id)){
				unset($post_ID_query[$key]);
			}
		}
	} else{
		fb::log($trashed_post_id, 'trashed posts');
	}
	return $post_ID_query;
}
function get_venue_address($id, $list=true){
	//list form elemtents
	$address_lines = array('address1','address2','address3','address4','postcode');
	//get meta from datbase
	foreach ($address_lines as $addressline){
		$meta = get_post_meta($id,'mf_SALF_maps_meta_'.$addressline, true);
		//test if each element exists (some address are longer than others)
		if ($meta){
			$address[]=$meta;
		}else{
			return false;
		}
	}
	//return array if list is false
	if(!$list) return $address;
	//else create HTML list
	foreach ($address as $list_address){
		$html .= '<li>';
		$html .= $list_address;
		$html .= '</li>';
	}
	
	return $html; 
}

?>