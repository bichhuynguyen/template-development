<?php







$prefix = 'mf_SALF_multimedia_meta_';



$multimedia_meta_box = array(
    'id' => 'multimedia_meta',
    'title' => 'Multimedia',
    'page' => 'post',
    'context' => 'side',
    'priority' => 'high',
    'fields' => array(
       
	    
		array(
		        'name' => 'Flickr Image',
				'desc' => "Enter the ID for a flickr Image",
		        'id' => $prefix . 'flickr_image',
		        'type' => 'wide-text'		        
		    ),
		array(
		        'name' => 'Flickr Set',
				'desc' => "Enter the ID for a flickr set",
		        'id' => $prefix . 'flickr_set',
		        'type' => 'wide-text'		        
		    ),
		array(
		        'name' => 'Vimeo',
				'id' => $prefix . 'vimeo',
		        'type' => 'wide-text'		        
		    )
    	)
);

add_action('admin_menu','mf_SALF_multimedia_meta_box');



add_action('save_post', 'mf_SALF_multimedia_meta_save_data');



?>