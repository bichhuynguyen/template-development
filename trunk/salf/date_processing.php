<?php
session_start();

$_SESSION['date_search']=TRUE;//tells program page session has ran.

//send object array back filled with posts
$selected_date_post_ids = explode(',',$_GET['posts']);//make array from get variables (send by URL's in calendar links)

//convert strings in array to integers
foreach ($selected_date_post_ids as $string_to_int){
	$processed_selected_date_post_ids[] = intval($string_to_int);
}



$_SESSION['date_posts']=$processed_selected_date_post_ids;

header('Location: '.$_SESSION['date_process_url']);


?>