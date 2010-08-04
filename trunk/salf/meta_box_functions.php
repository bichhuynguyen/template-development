<?php
// Save data from meta box
function mf_SALF_meta_save_data($post_id) {
	global $meta_box;
	
	
   
   
    // verify nonce
    if (!wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
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
	
		
		//var_dump($field['id']);
        //var_dump($new);
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
// Callback function to get list of $type custom post titles and ID's
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

// Callback function to show fields in meta box
function mf_SALF_meta_show_box() {
    global $meta_box, $post;
    
    // Use nonce for verification
    
	echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
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
			            echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:95%" />', '
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
// Add meta box
function mf_SALF_meta_box(){
    global $meta_box;
    
	
    add_meta_box($meta_box['id'], $meta_box['title'], 'mf_SALF_meta_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}
?>
