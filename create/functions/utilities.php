<?php

//input santizing
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

//get current page url
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

// Ondemand function to generate tinyurl
function getTinyUrl($url)  
{  
	$ch = curl_init();  
	$timeout = 5;  
	curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
	$data = curl_exec($ch);  
	curl_close($ch);  
	return $data;  
}
//get real IP address
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function get_attached_images($id, $size = 'thumbnail'){
    // This function runs in "the_loop", you could run this out of the loop but
    // you would need to change this to $post = $valid_post or something other than
    // using the global post declaration.
	/*
	$img	[0] => url
			[1] => width
			[2] => height	
	*/	
	
    global $post;
 	
    $args = array(
      'post_type' => 'attachment',
      'numberposts' => 1,
      'post_status' => null,
      'post_parent' => $id,
      'order' => 'ASC',
      'orderby' => 'menu_order'
      ); 
    $attachment = get_posts($args); // Get attachment
	
    if (count($attachment)>0) {
      	$img = wp_get_attachment_image_src($attachment[0]->ID, $size); 
    	echo "<img alt=\"";
		echo the_title();
		echo "\" src=\"";
		echo $img[0];
		echo "\"/>";
		
  	} 
}

function mf_get_extension(){
	//determines whether to use ? or & before defining a GET variable
	$curl = curPageURL();
	$exploded_url = explode('?',$curl);
	if (!$exploded_url[1]){
		return "?";
	} else {
		return '&';
	}
	
}

function default_comments_off( $data ) {
    if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' ) {
        $data['comment_status'] = 0;
    }

    return $data;
}
add_filter( 'wp_insert_post_data', 'default_comments_off' );

function mf_customised_pages(){
	if (is_page('Videos')||post_has_video(ID_ouside_loop())){
		?><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/page-customs/css/videos.css" type="text/css" media="screen" /><?php
	}
	if (is_page('Contact')){
		?><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/page-customs/css/contact.css" type="text/css" media="screen" /><?php
	}
}

function ID_ouside_loop() {
global $wp_query;

$thePostID = $wp_query->post->ID;
return $thePostID;
}

function post_has_video($id, $meta_results = "not_set"){
	if ($meta_results=="not_set") $meta_results = get_post_meta($id, 'mf_vimeo', true);
	
	$test_object = new VimeoObject();
		
	
	if (!$meta_results || !$test_object->id_is_video($meta_results)) {
		return false;
	} else {
		return true;
	}
	

	
}
?>