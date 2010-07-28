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
add_image_size( 'partner-titles', 395, 49);
add_image_size( 'venue-images', 165, 115, true);


function mf_post_thumbnail($style){
if ( has_post_thumbnail() ) {
	echo "<div class='news-thumb'>";
	the_post_thumbnail($style);
	echo "</div>";
	} else {
		/*echo "<div class='news-thumb'><img width='200' height='200'   src='";
		echo bloginfo('template_directory'); 
		echo"/images/teacher_no_thumb.png'></div>";*/
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
------------
---Menus----
------------
*/

include('meta.php');






?>