<?php
session_start();//firephp
FB::log($_SESSION['venues'],'Venues');//firephp
FB::log($_SESSION['get_post_ID_by_meta_value'],'Venues');//firephp

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

?>