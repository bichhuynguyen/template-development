<?php

/*
---------------
Menus
---------------
*/
register_nav_menus(array('primary'=>'Primary Menu'));

/*--------------
//input santizing
*///---------------
function clean($str = '', $html = false) {
	//is String Empty?
	if (empty($str)) return false;
	
	//is String an array? If so, run clean with each item.
	if (is_array($str)) {
		foreach($str as $key => $value) $str[$key] = clean($value, $html);
	} else {
		// get magic quotes
		if (get_magic_quotes_gpc()) $str = stripslashes($str);
		//is HTML an Array?
		if (is_array($html)) $str = strip_tags($str, implode('', $html));
		//is html a valid html tag?
		elseif (preg_match('|&lt;([a-z]+)&gt;|i', $html)) $str = strip_tags($str, $html);
		//is html false?
		elseif ($html !== true) $str = strip_tags($str);
		$str = trim($str);
	}
	return $str;
}


function mf_get_time($time,$format=false){
	/*Get 12hour time, based on
	* input 00:00 in 24 hour format
	* Can accept alternative formats
	*/
	//remove colon
	$time = str_replace(':','',$time);
	//get unix time	
	$time = strtotime($time);
	//
	
	if(!$format){
		$time = date('g:ia',$time);
	} else {
		$time = date($format,$time);
	}
	return $time;
}
//reverseout PHP key value
function just_array_keys($array = array()){
	if(!is_array($array)) return array();
	$switched_array = array();
	foreach ($array as $key => $value){
		$switched_array[]=$key;
	}
	return $switched_array;
}
// Method to obtain URL
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
function remove_post_vars($url){
	//crude function for removing anything after the first ? in a string
	$url_split = explode('?', $url);
	
	return $url_split[0];
}
function mf_meta_javascript_launch(){
	wp_enqueue_script('jquery');
	
	wp_enqueue_script('date', get_bloginfo('template_url') .'/scripts/date.js','jquery');
	wp_enqueue_script('datepicker', get_bloginfo('template_url') .'/scripts/datePicker.js','date');
	wp_enqueue_script('mf_date_picker', get_bloginfo('template_url') .'/scripts/mf_date_picker.js','datepicker');
	
	
}
function mf_datepicker_css() {//create HTML for loading Admin style sheet for table
    
    $url = get_bloginfo('template_url') .'/style/css/mf_datepicker_css.css';
	$_SESSION['URL']=get_bloginfo('template_url').'/style/css/mf_datepicker_css.css';
    echo '<link rel="stylesheet" type="text/css" href="' . $url . '" />';
}
add_action('admin_head', 'mf_datepicker_css');//load admin style sheet for datepicker
add_action('admin_init','mf_meta_javascript_launch');
//*/
/*--------------
Thumbnail Support
----------------*/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 100, 100, true);
add_image_size( 'micro-cropped', 50, 50);
add_image_size( 'small-uncropped', 100, 100);
add_image_size( 'small-cropped', 100, 100, true);
add_image_size( 'med-uncropped', 200, 200);
add_image_size( 'med-cropped', 200, 200, true);
add_image_size( 'large-uncropped', 500, 500);
add_image_size( 'large-cropped', 500, 500, true);
add_image_size( 'partner-titles', 395, 49);
add_image_size( 'venue-images', 165, 115, true);
add_image_size( 'partners-image', 458, 573);


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


function get_attached_images(){
    // This function runs in "the_loop", you could run this out of the loop but
    // you would need to change this to $post = $valid_post or something other than
    // using the global post declaration.
	/*
	$img	[0] => url
			[1] => width
			[2] => height	
	*/	
	
    global $post; 
    $args = array(
      'post_type' => 'attachment',
      'numberposts' => 1,
      'post_status' => null,
      'post_parent' => $post->ID,
      'order' => 'ASC',
      'orderby' => 'menu_order'
      ); 
    $attachment = get_posts($args); // Get attachment
    if ($attachment) {
      $img = wp_get_attachment_image_src($attachment[0]->ID, $size = 'thumbnail'); 
    	//echo "<img alt=\"";
		//echo the_title();
		//echo "\" src=\"";
		echo $img[0];
		//echo "\" width=\"";
		//echo $img[1]
		//echo "\" height=\""
		//echo $img[2]
		//echo "\"/>";
		//print_r($attachment);
  	}
}




/*--------------
Sidebar Support
----------------*/
if ( function_exists('register_sidebar') ) {
   register_sidebar(array(
       'before_widget' => '<li id="%1$s" class="widget %2$s">',
       'after_widget' => '</li>',
       'before_title' => '<h2 class="widgettitle">',
       'after_title' => '</h2>',
   ));
}

/*
---------------
Objects and Tax
---------------
*/
add_action( 'init', 'add_fitzgraham_objects_and_taxonomy' );
function add_fitzgraham_objects_and_taxonomy(){
	add_new_object('Volunteer');
	add_new_object('Program');
	add_new_object('Books');
	
	add_new_taxonomy('Elements', 'Program');
	add_new_object('Artists');
	add_new_object('Events');
	add_new_object('Venues');
	add_new_object('Partners');
	add_new_object('People');
	add_new_taxonomy('Partners', array('People','Partners'));
	
	//add_new_object('Prices');
}

function add_new_object($object_name) {
	register_post_type($object_name,
		array(
			'labels' => mf_create_labels($object_name),
			'public' => true,
			'supports' => array('title','editor','thumbnail','page-attributes')			
		)
	);

	
}

function add_new_taxonomy($taxonomy, $object){//attaches taxonomy to an object in the admin area 
$labels = mf_create_labels($taxonomy);
$args = array(
    'labels' => $labels,
	'show_tagcloud' => false,
	'hierarchical'=> true
);
register_taxonomy($taxonomy, $object, $args);
}

function mf_create_labels($label){
	return array(
		'name' => __($label),
		'singular_name' => __($label),
		'add_new' => _x('Add New', $label),
	    'add_new_item' => __('Add New '.$label),
	    'edit_item' => __('Edit '.$label),
	    'new_item' => __('New '.$label),
	    'view_item' => __('View '.$label),
	    'search_items' => __('Search '.$label),
	    'not_found' =>  __('No ' . $label . ' found'),
	    'not_found_in_trash' => __('No ' . $label . '  found in Trash'), 
	    'parent_item_colon' => ''
	);
}
/*
---------------
-----END-------
---------------
*/

// Ondemand function to generate tinyurl

 
function getTinyUrl($url)  
{  
	$ch = curl_init();  
	$timeout = 5;  
	curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
	$data = curl_exec($ch);  
	curl_close($ch);  
	return $data;  
}

/*
------------
---Menus----
------------
*/

add_action( 'template_redirect', 'mfields_redirect_custom_content_multiple' );
function mfields_redirect_custom_content_multiple() {
	global $mfields_template;
	if( $mfields_template ) {
		include_once( $mfields_template );
		exit();
	}
	return false;
}

add_filter( 'status_header', 'mfields_template_404' );
function mfields_template_404( $c ) {
	global $mfields_template;
	$mfields_template = mfields_locate_custom_template();
	if( $mfields_template ) {
		$header = '200';
		$text = get_status_header_desc( $header );
		$protocol = $_SERVER["SERVER_PROTOCOL"];
		if ( 'HTTP/1.1' != $protocol && 'HTTP/1.0' != $protocol )
			$protocol = 'HTTP/1.0';

		return "$protocol $header $text";
	}
	else
		return $c;
}

function mfields_locate_custom_template() {
	global $wp_post_types, $wp;
	if( is_404() ) {
		if( array_key_exists( $wp->request, $wp_post_types ) ) {
			$file = STYLESHEETPATH . '/' . $wp->request . '-multiple.php';
			$file = ( file_exists( $file ) ) ? $file : get_index_template();
			return $file;
		}
	}
	return false;
}


/*
-----------------
---Meta Boxes----
-----------------
*/
//include('meta_box_functions.php');
//include('meta.php');

include('artist_meta_box_functions.php');
include('artist_meta.php');

//include('google_maps_meta_functions.php');
//include('google_maps_meta.php');

include('multimedia_meta_functions.php');
include('multimedia_meta.php');

//functions for sorting the program events
include('sort_by_meta.php');

//classes
include('classes.php');



/*---
* Get Full Extentions
*/
/*
FUNCTIONS for automatically including php documents from the functions folder.
*/
//if running on php4, make a scandir functions
if(!function_exists('scandir')){
     function scandir($directory, $sorting_order = 0) {
         $dh  = opendir($directory);
         while( false !== ($filename = readdir($dh)) ) {
             $files[] = $filename;
         }
         if( $sorting_order == 0 ) {
             sort($files);
         } else {
             rsort($files);
         }
         return($files);
     }
}
/*
* this function returns the path to the funtions folder.
* If the folder does not exist, it creates it.
*/
function get_function_directory_extension($template_url = FALSE){
     //get template url if not passed
     if(!$template_url)$template_url = get_bloginfo('template_directory');

    
     //replace slashes with dashes for explode
     $template_url_no_slash = str_replace('/','.',$template_url);

     //create array from URL
     $template_url_array = explode('.',$template_url_no_slash);
    
     //--splice array

     //Calculate offset(we only need the last three levels)
     //We need to do this to get the proper directory, not the one passed by the server, as scandir doesn't work when aliases get involved.
     $offset = count($template_url_array)-3;
    
     //splice array, only keeping back to the root WP install folder (where wp-config.php lives, where the front end runs from)
     $template_url_array = array_splice($template_url_array,$offset,3);
     //put back togther as string
     $template_url_return_string = implode('/',$template_url_array);
     //////fb::log($template_url_return_string,'Template');//firephp
    
     //creates current working directory with template extention and functions directory    
     //if admin, change out of admin folder before storing working dir, then change back again.
     if (is_admin()){
          $admin_directory = getcwd();
          chdir("..");
          $current_working_directory = getcwd();
          chdir($admin_directory);
     } else {
          $current_working_directory = getcwd();
     }
     //////fb::log($current_working_directory,'Directory');//firephp
    
     //alternate method is chdir method doesn't work on your server (some windows servers might not like it)
     //if (is_admin()) $current_working_directory = str_replace('/wp-admin','',$current_working_directory);
    
     $function_folder = $current_working_directory.'/'.$template_url_return_string;
    
    
     
     //return path
     return $function_folder;

}
/*--------------
Custom Template Tags
---------------*/
function mf_voting_form(){
	include('voter_form.php');
}
function mf_socialise_post($tweet_leader = false, $tweet_post = ""){
	//$tweet_leader = $tweet_leader;
	include('social_posts.php');
}

//set comments off as default
/*function default_comments_off( $data ) {
	//fb::log($data);
	$current_ips = get_post_meta($post['post_id'],'thumbsup');
    if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' ) {
        $data['comment_status'] = 'closed';
    }

    return $data;
}

add_filter( 'wp_insert_post_data', 'default_comments_off' );//*/

function choose_one_category($get_categorys){
	//takes in value from get_the_category() and outputs a single category. If element has multiple categories, outputs a random category from list
	
	$categories = array();
	foreach ($get_categorys as $category){
		$categories[] = $category->name;
	}
	if (count($categories)>1){
		$chosen_category = $categories[array_rand($categories, 1)];
	} else {
		$chosen_category = $categories[0];
	}
	return $chosen_category;
}

function mf_get_cat_permalink($category){
	$cat_object = get_term_by('name',$category,'category');
	
	$mf_link = get_category_link($cat_object->term_id);
	return $mf_link;
}


?>