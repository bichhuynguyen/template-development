<?php
session_start();//firephp
//FB::log($_SESSION['venues'],'Venues');//firephp
//FB::log($_SESSION['get_post_ID_by_meta_value'],'Venues');//firephp

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
?>