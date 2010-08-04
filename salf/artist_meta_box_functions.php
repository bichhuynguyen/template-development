<?php
// Save data from meta box 
function mf_SALF_artist_meta_save_data($post_id) {
	global $artist_meta_box;
	
	
	
	
   
   
    // verify nonce
    if (!wp_verify_nonce($_POST['artist_meta_box_nonce'], basename(__FILE__))) {
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
    
    foreach ($artist_meta_box['fields'] as $field) {
		
		if($field['type']!='checkbox'){
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
		 
		
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }

		} else {
		
		$old = get_post_meta($post_id, 'mf_SALF_artist_meta_checks', true);
		$new = $_POST['mf_SALF_artist_meta_checks'];
		
		
		if ($new && $new != $old) {
            update_post_meta($post_id, 'mf_SALF_artist_meta_checks', $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, 'mf_SALF_artist_meta_checks', $old);
        }	
		}
		
    }
}
// Callback function to get list of $type custom post titles and ID's
function mf_SALF_artist_get_custom_post_list($type){
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

// Callback function to show fields in meta box
function mf_SALF_artist_meta_show_box() {
    global $artist_meta_box, $post;
    
    // Use nonce for verification
    
	echo '<input type="hidden" name="artist_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
    echo '<table class="form-table">';

    foreach ($artist_meta_box['fields'] as $field) {
        // get current post meta data
        
        switch ($field['type']) {
            
				case 'select2':
				$meta = get_post_meta($post->ID, $field['id'], true);
				
				echo '<div style="margin: 12px 0; float: left;">';
		        echo '<h2><label for="', $field['id'], '">', $field['name'], '</label></h2>';
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $ID => $option) {
                    echo '<option value="'. $ID .'" ', $meta == $ID ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
				echo '</div><h2 style="clear: both; margin: 12px 0;">Additional Speakers</h2>';	
				break;
				case 'checkbox';
				$meta = get_post_meta($post->ID, 'mf_SALF_artist_meta_checks', true);
				if (!$meta){
					$meta = array();
				}
		echo '<div style="margin-right: 12px; float: left;">';
        echo '<label for="', $field['id'], '">', $field['name'], '</label>';

       
		echo '<input type="checkbox" name="mf_SALF_artist_meta_checks[]"value="', $field['id'], '" id="', $field['id'], '"', in_array($field['id'],$meta) ? ' checked="checked"' : '', ' />';
		echo '</div>';
			    break;
		}			 
       
    }
    
    echo '</table>';
}
// Add meta box
function mf_SALF_artist_meta_box(){
    global $artist_meta_box;
    
	
    add_meta_box($artist_meta_box['id'], $artist_meta_box['title'], 'mf_SALF_artist_meta_show_box', $artist_meta_box['page'], $artist_meta_box['context'], $artist_meta_box['priority']);
}
?>
