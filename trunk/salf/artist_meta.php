<?php







$prefix = 'mf_SALF_artist_meta_';

$the_artists = mf_SALF_artist_get_custom_post_list('Artists');


$artist_array = array();
foreach ($the_artists as $id => $artist){
	FB::log($id, 'Artist');
	$new_artist_array = array(
						'name' => $artist,
						'id' => $prefix.$id,
						'type' => 'checkbox'
	);
	array_push($artist_array,$new_artist_array);
}//*/

$artist_meta_box = array(
    'id' => 'program_artists',
    'title' => 'Artists',
    'page' => 'Program',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array()
);
foreach($artist_array as $artist){
	array_push($artist_meta_box['fields'], $artist);
}

add_action('admin_menu','mf_SALF_artist_meta_box');



add_action('save_post', 'mf_SALF_artist_meta_save_data');



?>