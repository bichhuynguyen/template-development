<?php
session_start();






$prefix = 'mf_SALF_maps_meta_';


	
$maps_array = array(
					'name' => 'Google Map',
					'id' => $prefix.'map',
					'type' => 'wide-text',
					'desc' => '<p>Enter Google Maps Share URL</p>'
						
);
	

$maps_meta_box = array(
    'id' => 'program_maps',
    'title' => 'Address and Map',
    'page' => 'Venues',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
					array(
						'name' => 'Google Map',
						'id' => $prefix.'map',
						'type' => 'wide-text',
						'desc' => '<p>Enter Google Maps Share URL</p>'
						),
					array(
						'name' => 'Address 1',
						'id' => $prefix.'address1',
						'type' => 'text'
						),
					array(
						'name' => 'Address 2',
						'id' => $prefix.'address2',
						'type' => 'text'
						),
					array(
						'name' => 'Address 3',
						'id' => $prefix.'address3',
						'type' => 'text'
						),
					array(
						'name' => 'Address 4',
						'id' => $prefix.'address4',
						'type' => 'text'
						),
					array(
						'name' => 'Post Code',
						'id' => $prefix.'postcode',
						'type' => 'text'
						)
	)
);


add_action('admin_menu','mf_SALF_maps_meta_box');



add_action('save_post', 'mf_SALF_maps_meta_save_data');
add_action('update_post', 'mf_SALF_maps_meta_save_data');



?>