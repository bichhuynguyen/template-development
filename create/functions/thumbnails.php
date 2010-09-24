<?php
/*--------------
Thumbnail Support
----------------*/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 100, 100, true);
add_image_size( 'small-uncropped', 100, 100);
add_image_size( 'small-cropped', 100, 100, true);
add_image_size( 'med-uncropped', 200, 200);
add_image_size( 'med-cropped', 200, 200, true);
add_image_size( 'large-uncropped', 500, 500);
add_image_size( 'large-cropped', 500, 500, true);

add_image_size('large_side_image', 300,300);//uncropped

function mf_post_thumbnail($style=false, $id=false, $class='news-thumb', $echo = true){
/*
* Echo's thumbnail, given style
* Accepts ID for manual method (outside the loop)
* accepts class attribute for surrounding div tag
* $echo attribute used to block echoing, if you only need true or false returned.
*/
//is post ID provided?
//if not, use wordpress template tags
if(!$id){
	if ( has_post_thumbnail() ) {
		if ($echo) echo "<div class='".$class."'>";
		if (!$style){
			if ($echo) the_post_thumbnail();
			
		} else{
			if ($echo) the_post_thumbnail($style);
			
		}
		if ($echo) echo "</div>";
		return true;
		}
	else{
		return false;
	}
} else {
	//if ID provided, use manual method
	global $wpdb;
	//build query
	$query = "SELECT meta_value FROM $wpdb->postmeta WHERE post_id='$id' AND meta_key = '_thumbnail_id'";
	
	//run query
	$query_results = $wpdb->get_results($query);
	//fetch thumbnail details
	if(!$style){
		$thumnail_array = wp_get_attachment_image_src($query_results[0]->meta_value);
	} else {
		$thumnail_array = wp_get_attachment_image_src($query_results[0]->meta_value,$style);
	}
	//break out of function if no thumbnail found
	if(!$thumnail_array) return false;
	//get featured image with img tags
	$thumbnail_url ="<div class='$class'>";
	$thumbnail_url .= "<img src='";
	$thumbnail_url .= $thumnail_array[0];
	$thumbnail_url .= "' />";
	$thumbnail_url .= "</div>";
	
	
	if ($echo) echo $thumbnail_url;
	return true;
} 

}
?>