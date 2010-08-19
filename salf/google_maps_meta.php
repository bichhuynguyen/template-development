<?php
session_start();
//FB::log($_SESSION['checks'],'checks');
//FB::log($_SESSION['maps_meta'],'maps meta');
//FB::log($_SESSION['meta'],'meta');





$prefix = 'mf_SALF_maps_meta_';


	
$maps_array = array(
					'name' => 'Google Map',
					'id' => $prefix.'map',
					'type' => 'wide-text',
					'desc' => '<p>Enter Google Maps Share URL</p>'
						
);
	

$maps_meta_box = array(
    'id' => 'program_maps',
    'title' => 'Google Map',
    'page' => 'Venues',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array($maps_array)
);


add_action('admin_menu','mf_SALF_maps_meta_box');



add_action('save_post', 'mf_SALF_maps_meta_save_data');



?>