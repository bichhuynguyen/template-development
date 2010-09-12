<?php
// Save data from meta box
function mf_SALF_multimedia_meta_save_data($post_id) {
	global $multimedia_meta_box;
	
	
   
   
    // verify nonce
    if (!wp_verify_nonce($_POST['multimedia_meta_box_nonce'], basename(__FILE__))) {
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
    
    foreach ($multimedia_meta_box['fields'] as $field) {
	
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
// Callback function to show fields in meta box
function mf_SALF_multimedia_meta_show_box() {
    global $multimedia_meta_box, $post;
    
    // Use nonce for verification
    
	echo '<input type="hidden" name="multimedia_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
    echo '<table class="form-table">';

    foreach ($multimedia_meta_box['fields'] as $field) {
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
			            echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:80%" />', '
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
function mf_SALF_multimedia_meta_box(){
    global $multimedia_meta_box;
    
	
    add_meta_box($multimedia_meta_box['id'], $multimedia_meta_box['title'], 'mf_SALF_multimedia_meta_show_box', $multimedia_meta_box['page'], $multimedia_meta_box['context'], $multimedia_meta_box['priority']);
}
?>
