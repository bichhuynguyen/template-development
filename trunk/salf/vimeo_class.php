<?php
class VimeoObject{
	var $id;//vimeo username
	var $video_code;//individual video code
	var $api_endpoint = 'http://vimeo.com/api/v2/';//start URL for VIMEO simple API
	
	
			
	function curl_get($url) {
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			$return = curl_exec($curl);
			curl_close($curl);
			return $return;
	}
	
	
	function get_video_array(){
	$url = $this->curl_get($this->api_endpoint.$this->id. '/videos.xml');
	$videos = simplexml_load_string($url);//get XML
	
	//convert XML objects to array elements
	$videos_array = get_object_vars($videos);
	foreach ($videos_array['video'] as $id=>$video){
		$videos_array['video'][$id]=get_object_vars($video);
	}
	return $videos_array;
	
	}
}

?>