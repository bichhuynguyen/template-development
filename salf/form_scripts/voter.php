<?php
session_start();
//load wordpress functions
$wp_root = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_root = $wp_root[0];
chdir($wp_root);
if (!function_exists('add_action')) {
	if (file_exists('wp-load.php')) {
		require_once('wp-load.php');
	} else {
		require_once('wp-config.php');
	}
}
//input santizing
foreach($_POST as $key=>$value){
	$post[$key] = clean($_POST[$key]);
}



$current_ips = get_post_meta($post['post_id'],'thumbsup');

if ($_GET['remove'] != 'true'):
	if(!in_array($post['ip'],$current_ips)){
		add_post_meta($post['post_id'],'thumbsup',$post['ip']);
		$_SESSION['thumb_added'] = true;
	} else {
		$_SESSION['thumb_added'] = false;	
}
else://remove vote
	delete_post_meta($post['post_id'],'thumbsup',$post['ip']);
endif;

$_SESSION['thumb_count'] = get_post_meta($post['post_id'],'thumbsup');


header('Location: '.$post['curl']);
?>