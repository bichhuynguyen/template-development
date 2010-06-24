<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */

automatic_feed_links();

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}
/*
*
*Post Types and Tax
*
*/
add_action( 'init', 'add_4x4_objects_and_taxonomy' );
function add_4x4_objects_and_taxonomy(){
	add_new_object('project');
	add_new_object('video');
	add_new_taxonomy('project', array('project','video'));
	
	
	
	
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
*
*Meta Boxes
*
*/



$prefix = 'f4x4-vid_';

$meta_box = array(
    'id' => 'videos',
    'title' => 'Vimeo Copy Text',
    'page' => 'project',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Vimeo Short Code',
            'desc' => 'Enter Short Codes Here<br />They are the numbers found after vimeo.com/<br />If you wish to add more, separate them with a semicolon (;)',
            'id' => $prefix . 'text',
            'type' => 'text',
            'std' => ''
        )/*,
        array(
            'name' => 'Textarea',
            'desc' => 'Enter big text here',
            'id' => $prefix . 'textarea',
            'type' => 'textarea',
            'std' => 'Default value 2'
        ),
        array(
            'name' => 'Select box',
            'id' => $prefix . 'select',
            'type' => 'select',
            'options' => array('Option 1', 'Option 2', 'Option 3')
        ),
        array(
            'name' => 'Radio',
            'id' => $prefix . 'radio',
            'type' => 'radio',
            'options' => array(
                array('name' => 'Name 1', 'value' => 'Value 1'),
                array('name' => 'Name 2', 'value' => 'Value 2')
            )
        ),
        array(
            'name' => 'Checkbox',
            'id' => $prefix . 'checkbox',
            'type' => 'checkbox'
        )*/
    )
);


add_action('admin_menu','f4x4_vimeo_box');

// Add meta box
function f4x4_vimeo_box(){
    global $meta_box;
    
    add_meta_box($meta_box['id'], $meta_box['title'], 'f4x4_vimeo_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}
// Callback function to show fields in meta box
function f4x4_vimeo_show_box() {
    global $meta_box, $post;
    
    // Use nonce for verification
    echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '
', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '
', $field['desc'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
        }
        echo     '<td>',
            '</tr>';
    }
    
    echo '</table>';
}
add_action('save_post', 'f4x4_vimeo_save_data');

// Save data from meta box
function f4x4_vimeo_save_data($post_id) {
    global $meta_box;
    
    // verify nonce
    if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}

/*
*
*Vimeo Playback
*
*/


function f4x4_vimeo_callback($post_ID){
	
	
	$meta_values = get_post_meta($post_ID, 'f4x4-vid_text'); 
	$vids_array = explode(';',$meta_values[0]);
	$return = "<div class='project-videos'>";
	foreach ($vids_array as $current_vid){
		$return .= '<object width="400" height="225"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=';
		$return .= $current_vid;
		$return .= '&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" /><embed src="http://vimeo.com/moogaloop.swf?clip_id=';
		$return .= $current_vid;
		$return .= '&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="400" height="225"></embed></object>';
	}
	$return .= "</div>";
	return $return;
}

?>
