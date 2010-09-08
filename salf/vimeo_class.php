<?php
class VimeoObject{
	var $id;//vimeo username
	var $video_code;//individual video code
	var $api_endpoint = 'http://vimeo.com/api/v2/';//start URL for VIMEO simple API
	var $width = 400;//default video width
	var $height = 230;//default video width
	
			
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
	
	function create_video_player_by_ID($video_id){
		$player = '<iframe src="http://player.vimeo.com/video/';
		$player .= $video_id.'" ';
		$player .= 'width="'.$this->width.'" ';
		$player .= 'height="'.$this->height.'" ';
		$player .=  'frameborder="0"></iframe>';
		
		return $player;
	}
	function get_video_player_array_by_username(){
		$entries = $this->get_video_array();
		foreach ($entries['video'] as $video){
			$player = $this->create_video_player_by_ID($video['id']);
			$player_array[]= $player;			
		}
		return $player_array;
	}
	function video_players_by_ID(){
		$videos = $this->get_video_player_array_by_username();
		$player_list = "<ul class='video_list>";
		foreach($videos as $video){
				$player_list .= "<li class='video'>";
				$player_list .= $video;
				$player_list .= "<li>";
		}
		$player_list .= "</ul>";
		echo $player_list;
	}
}

?>