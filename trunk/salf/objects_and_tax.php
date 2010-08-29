<?php
/*
---------------
Objects and Tax
---------------
*/
add_action( 'init', 'add_fitzgraham_objects_and_taxonomy' );
function add_fitzgraham_objects_and_taxonomy(){
	add_new_object('Events');
	
	add_new_object('Partners');
	add_new_object('People');
	add_new_taxonomy('Status', array('People','Partners'));
	
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
Objects and Tax
---------------
*/
?>