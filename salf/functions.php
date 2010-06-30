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
add_image_size( 'partner-titles', 274, 41);
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




?>
