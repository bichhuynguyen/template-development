<?php
session_start();
function clean($str = '', $html = false) {
	//is String Empty?
	if (empty($str)) return false;
	
	//is String an array? If so, run clean with each item.
	if (is_array($str)) {
		foreach($str as $key => $value) $str[$key] = clean($value, $html);
	} else {
		// get magic quotes
		if (get_magic_quotes_gpc()) $str = stripslashes($str);
		//is HTML an Array?
		if (is_array($html)) $str = strip_tags($str, implode('', $html));
		//is html a valid html tag?
		elseif (preg_match('|&lt;([a-z]+)&gt;|i', $html)) $str = strip_tags($str, $html);
		//is html false?
		elseif ($html !== true) $str = strip_tags($str);
		$str = trim($str);
	}
	return $str;
}
$_SESSION['date_search']=TRUE;//tells program page session has ran.

//send object array back filled with posts
$selected_date_post_ids = explode(',',$_GET['posts']);//make array from get variables (send by URL's in calendar links)

//convert strings in array to integers
foreach ($selected_date_post_ids as $string_to_int){
	$string_to_int = clean($string_to_int);
	$string_to_int = intval($string_to_int);
	if(is_int($string_to_int)) $processed_selected_date_post_ids[] = intval($string_to_int);
}



$_SESSION['date_posts']=$processed_selected_date_post_ids;

header('Location: '.$_SESSION['date_process_url']);


?>