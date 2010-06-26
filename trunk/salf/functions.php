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

/*--------------
Post & Tax Support
----------------*/

add_action('init', 'add_events_object');

function add_events_object() 
{
  $labels = array(
    'name' => _x('Events', 'post type general name'),
    'singular_name' => _x('Event', 'post type singular name'),
    'add_new' => _x('Add New', 'Event'),
    'add_new_item' => __('Add New Event'),
    'edit_item' => __('Edit Event'),
    'new_item' => __('New Event'),
    'view_item' => __('View Event'),
    'search_items' => __('Search Event'),
    'not_found' =>  __('No Events found'),
    'not_found_in_trash' => __('No events found in Trash'), 
    'parent_item_colon' => ''
  );
	/*$taxonomies = array(
		'tax1' => 'tax1',
		'tax2' => 'tax2'
		);*/
	
  $args = array(
    'labels' => $labels,
	//'taxonomies' => $taxonomies,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','editor','thumbnail')
  ); 
  	register_post_type('Events',$args);
	$tax_args = array(
	'show_ui' => true,
	);
	
	register_taxonomy('Genres', 'event', $tax_args);
}

//add filter to insure the text Event, or Event, is displayed when user updates a Event 
add_filter('post_updated_messages', 'Event_updated_messages');
function Event_updated_messages( $messages ) {

  $messages['Event'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Event updated. <a href="%s">View Event</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Event updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Event published. <a href="%s">View post</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Event saved.'),
    8 => sprintf( __('Event submitted. <a target="_blank" href="%s">Preview Event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview post</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Event draft updated. <a target="_blank" href="%s">Preview Event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

add_action( 'init', 'add_partners_object' );
add_action( 'init', 'add_people_object' );

function add_partners_object() {
	register_post_type( 'Partners',
		array(
			'labels' => array(
				'name' => __( 'Partners' ),
				'singular_name' => __( 'Partner' )
			),
			'public' => true,
			'supports' => array('title','editor','thumbnail','page-attributes')			
		)
	);
	$labels = array(
	    'name' => _x('Pages', 'post type general name'),
	    'singular_name' => _x('Page', 'post type singular name'),
	    'add_new' => _x('Add New', 'Page'),
	    'add_new_item' => __('Add New Page'),
	    'edit_item' => __('Edit Page'),
	    'new_item' => __('New Page'),
	    'view_item' => __('View Page'),
	    'search_items' => __('Search Page'),
	    'not_found' =>  __('No Page found'),
	    'not_found_in_trash' => __('No Page found in Trash'), 
	    'parent_item_colon' => ''
	  );
	$args = array(
	    'labels' => $labels,
		'show_tagcloud' => false,
		'hierarchical'=> true
	);
	register_taxonomy('pages', 'Partners', $args);//*/
	
}

function add_people_object() {
	register_post_type( 'People',
		array(
			'labels' => array(
				'name' => __( 'People' ),
				'singular_name' => __( 'Person' )
			),
			'public' => true,
			'supports' => array('title','editor','thumbnail','page-attributes')			
		)
	);
	$labels = array(
	    'name' => _x('Partners', 'post type general name'),
	    'singular_name' => _x('Partner', 'post type singular name'),
	    'add_new' => _x('Add New', 'Partner'),
	    'add_new_item' => __('Add New Partner'),
	    'edit_item' => __('Edit Partner'),
	    'new_item' => __('New Partner'),
	    'view_item' => __('View Partner'),
	    'search_items' => __('Search Partners'),
	    'not_found' =>  __('No partners found'),
	    'not_found_in_trash' => __('No partners found in Trash'), 
	    'parent_item_colon' => ''
	  );
	$args = array(
	    'labels' => $labels,
		'show_tagcloud' => false,
		'hierarchical'=> true
	);
	register_taxonomy('Partners', array('People','Partners'), $args);
	
}

?>
