<?php







$prefix = 'mf_SALF_meta_';



$meta_box = array(
    'id' => 'program_meta',
    'title' => 'Program Meta',
    'page' => 'Program',
    'context' => 'side',
    'priority' => 'high',
    'fields' => array(
       
	    array(
		        'name' => 'Date',
				'desc' => "<p>Enter in the format DD/MM/YYY</p>",
		        'id' => $prefix . 'date',
		        'type' => 'date'		        
		    ),
		array(
		        'name' => 'Time',
				'desc' => "<p>Enter in the format 00:00</p>",
		        'id' => $prefix . 'time',
		        'type' => 'wide-text'		        
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
	            'options' => mf_SALF_get_custom_post_list('Venues')
	        ), 
		array(
		        'name' => 'Event Type',
		        'id' => $prefix . 'type',
		        'type' => 'select2',
		        'options' => mf_SALF_get_custom_post_list('Events')
		    ),
			
		array(
		        'name' => 'EventBrite',
				'desc' => '<p>Enter Eventbrite Link</p>',
		        'id' => $prefix . 'eventbrite',
		        'type' => 'wide-text'		        
		    ),
			
		array(
		        'name' => 'Concession',
				'desc' => '<p>Enter Concession Link</p>',
		        'id' => $prefix . 'concession',
		        'type' => 'wide-text'		        
		    )
    	)
);

add_action('admin_menu','mf_SALF_meta_box');



add_action('save_post', 'mf_SALF_meta_save_data');



?>