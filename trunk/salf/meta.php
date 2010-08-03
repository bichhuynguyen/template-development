<?php


session_start();

//Fb::log(mf_SALF_get_custom_post_list('Artists'), "artists");
//Fb::log($_SESSION['fields'], "fields");//firephp -- metabox fields
//Fb::log($_SESSION['new'], "new");//firephp -- to be added to database
/*
*
*Meta Boxes
*
*/

///*/
/*function mf_meta_javascript_launch(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('salf_ui', bloginfo('template_url') .'/scripts/salf_ui.js');
	wp_enqueue_script('date', bloginfo('template_url') .'/scripts/date.js');
	wp_enqueue_script('datepicker', bloginfo('template_url') .'/scripts/datepicker.js');
	
}
add_action('admin_head','mf_meta_javascript_launch');
//*/




$prefix = 'mf_SALF_meta_';

$the_artists = mf_SALF_get_custom_post_list('Artists');
Fb::log($the_artists, "Artists Call-");//firephp

$artist_array = array();
foreach ($the_artists as $artist){
	$new_artist_array = array(
						'name' => $artist,
						'id' => $prefix.'_artist_'.$artist.'_check',
						'type' => 'checkbox'
	);
	array_push($artist_array,$new_artist_array);
}//*/

$meta_box = array(
    'id' => 'videos',
    'title' => 'date',
    'page' => 'Program',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
       
	    array(
		        'name' => 'Date',
				'desc' => "Enter in the format DD/MM/YYY",
		        'id' => $prefix . 'date',
		        'type' => 'date'		        
		    ),
		array(
		        'name' => 'Price',
		        'id' => $prefix . 'price',
		        'type' => 'text'		        
		    ), 
		array(
	            'name' => 'Venue',
	            'id' => $prefix . 'venue',
	            'type' => 'select2',
	            //'options' => mf_SALF_get_custom_post_list('Venues')
	        ),
			
		array(
		        'name' => 'EventBrite',
				'desc' => 'Enter Eventbrite Link',
		        'id' => $prefix . 'eventbrite',
		        'type' => 'wide-text'		        
		    )
    	)
);
foreach($artist_array as $artist){
	array_push($meta_box['fields'], $artist);
}
Fb::log($meta_box['fields'], "fields");//firephp
add_action('admin_menu','mf_SALF_meta_box');

// Add meta box
function mf_SALF_meta_box(){
    global $meta_box;
    
    add_meta_box($meta_box['id'], $meta_box['title'], 'mf_SALF_meta_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}
// Callback function to show fields in meta box
function mf_SALF_meta_show_box() {
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
            
				case 'select2':
					
	                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
	                foreach ($field['options'] as $ID => $option) {
	                    echo '<option value="'. $ID .'" ', $meta == $ID ? ' selected="selected"' : '', '>', $option, '</option>';
	                }
	                echo '</select>';
					
	                break;
				case 'text':
		            echo '<input  type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:15%" />', '
		', $field['desc'];
		            break;
					case 'date':
			            echo '<input class="datepicker" class="type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:15%" />', '
			', $field['desc'];
			            break;
					case 'wide-text':
			            echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:42%" />', '
			', $field['desc'];
			            break;
						case 'checkbox':
			                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
			                break;
					 case 'radio':
			                foreach ($field['options'] as $option) {
			                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
			                }
			                break;
        }			
        echo     '<td>',
            '</tr>';
    }
    
    echo '</table>';
}
add_action('save_post', 'mf_SALF_meta_save_data');

// Save data from meta box
function mf_SALF_meta_save_data($post_id) {
	global $meta_box;
	$_SESSION['fields'] = $_POST; 
	
   
   
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
	
		$_SESSION['new'][$field['name']] = $new;//firephp
		//var_dump($field['id']);
        //var_dump($new);
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
function mf_SALF_get_custom_post_list($type){
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
?>