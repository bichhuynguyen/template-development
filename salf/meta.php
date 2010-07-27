<?php
/*
*
*Meta Boxes
*
*/
function mf_get_custom_post_list($type){
	query_posts( array( 'post_type' => $type) );
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$post_list[get_the_ID()] = get_the_title();
	endwhile; //else:
	endif;
	//Reset Query
	wp_reset_query();
	return $post_list;
}

$prefix = 'mf_SALF_';

$meta_box = array(
    'id' => 'videos',
    'title' => 'date',
    'page' => 'Program',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
       
	     array(
	            'name' => 'Venue',
	            'id' => $prefix . 'venue',
	            'type' => 'select2',
	            'options' => mf_get_custom_post_list('Venues')
	        ),
		array(
	            'name' => 'Artist',
	            'id' => $prefix . 'artist',
	            'type' => 'select2',
	            'options' => mf_get_custom_post_list('Artists')
	        )
    	)
);


add_action('admin_menu','mf_SALF_vimeo_box');

// Add meta box
function mf_SALF_vimeo_box(){
    global $meta_box;
    
    add_meta_box($meta_box['id'], $meta_box['title'], 'mf_SALF_vimeo_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}
// Callback function to show fields in meta box
function mf_SALF_vimeo_show_box() {
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
        }
        echo     '<td>',
            '</tr>';
    }
    
    echo '</table>';
}
add_action('save_post', 'mf_SALF_vimeo_save_data');

// Save data from meta box
function mf_SALF_vimeo_save_data($post_id) {
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
?>