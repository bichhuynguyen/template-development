<?php


class VimeoObject{ 
	var $id;//vimeo username
	var $video_code;//individual video code
	var $api_endpoint = 'http://vimeo.com/api/v2/';//start URL for VIMEO simple API
	var $width = 400;//default video width
	var $height = 230;//default video width
	private $curl; //current URL WITH additional symbol for correct GET var addition
	private $all_vids;//array containing all videos - created in construct
	function __construct($id = false){
		if($id){
			$this->id=$id;
			
		} else {
			$multimedia = get_option('multimedia_');
			$this->id = $multimedia['vimeo_id'];
		}
		
		$curl = $this->strip_vimeo_get_vars();
		$ext = mf_get_extension();
		$this->curl = $curl.$ext;
		
		$this->all_vids = $this->get_video_array();//get all videos and place them in an array
	}
			
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
	
	function id_is_video($id){//fetches data from vimeo's oembed mechaninism
		$url = $this->curl_get("http://vimeo.com/api/oembed.xml?url=http%3A//vimeo.com/".$id);
		$call = simplexml_load_string($url);//get XML
		
		if(isset($call->title)){
			return true;
		} else {
			return false;
		}
		
	}
	
	function get_single_video_player($id){
		$return .= '<object width="'.$this->width.'" height="'.$this->height.'"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=';
		$return .= $id;
		$return .= '&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" /><embed src="http://vimeo.com/moogaloop.swf?clip_id=';
		$return .= $id;
		$return .= '&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="400" height="225"></embed></object>';
		
		return $return;
		
	}
	
	
	
	function get_universal_player_object($id){
		$url = $this->curl_get('http://vimeo.com/api/oembed.xml?url=http%3A//vimeo.com/'.$id);
		$xml_video = simplexml_load_string($url);//get XML

		//convert XML objects to array elements
		$video = get_object_vars($xml_video);
		
		return $video;
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
		$entries = $this->all_vids;
		
		foreach ($entries['video'] as $video){
			
			//$props = $this->get_universal_player_object($video['id']); need to control width!!
		
			
			$player = $this->create_video_player_by_ID($video['id']);
			$player_array[]= $player;			
		}
		return $player_array;
	}
	
	function desc_by_id($id){
		
		$array = $this->all_vids;
		$videos = $array['video'];
		
		foreach ($videos as $video){
			
			if($video['id']==$id){
				return $video['description'];
			} 
		}
	}
	
	function title_by_id($id){
		
		$array = $this->all_vids;
		$videos = $array['video'];
		
		foreach ($videos as $video){
			
			if($video['id']==$id){
				return $video['title'];
			} 
		}
	}
	
	function next_video_by_id($id){
	$curl = $this->curl;	
		$array = $this->all_vids;
		$videos = $array['video'];
		
		foreach ($videos as $key=>$video){
			
			if($video['id']==$id){
				$next = $videos[$key+1];
								
				$return .= "<a class='next'  href='";
				$return .= $curl."vimeo=".$next['id'];
				$return .= "'>";
				$return .= $next['title'];
				$return .= '&raquo;</a>';
				return $return;	
			} 
		}
		
	}
	
	function prev_video_by_id($id){
	$curl = $this->curl;	
		$array = $this->all_vids;
		$videos = $array['video'];
		
		foreach ($videos as $key=>$video){
			
			if($video['id']==$id){
				$prev = $videos[$key-1];
				
				if($prev):
					$return .= "<a class='prev' href='";
					$return .= $curl."vimeo=".$prev['id'];
					$return .= "'>&laquo;";
					$return .= $prev['title'];
					$return .= '</a>';
					return $return;
				endif;
			} 
		}
	}
	
	function get_requested_video($id){
		if(isset($_GET['vimeo'])){
			$id = $_GET['vimeo'];
		}
		
		
		$return['title'] = $this->title_by_id($id);
		$return['video'] = $this->create_video_player_by_ID($id);
		$return['desc'] = $this->desc_by_id($id);
		$return['next'] = $this->next_video_by_id($id);
		$return['prev'] = $this->prev_video_by_id($id);
		
		return $return;
	}
	
	function strip_vimeo_get_vars(){
		$curl = curPageURL();
		$curl = explode('vimeo',$curl);
		return $curl[0];
	}
	
	function title_thumb_desc(){
		
		$curl = $this->curl;
		$entries = $this->all_vids;
		$return['first_film_id'] = $entries['video'][0]['id'];
		
		//$return = $this->get_requested_video($entries['video'][0]['id']);
		
		$return['list'] = '<ul class="vimeo_desc_feed">';
		foreach ($entries['video'] as $video){
			$return['list'] .= '<li>';
			$return['list'] .= "<a href='";
			$return['list'] .= $curl."vimeo=".$video['id'];
			$return['list'] .= "'>";
			$return['list'] .= $video['title'];
			$return['list'] .= '</a>';
			//$return['list'] .= '<p>';
			//$return['list'] .= $video['description'];
			//$return['list'] .= '</p>';
			$return['list'] .= '</li>';
		}
		$return['list'] .= '</ul>';
		
		return $return;
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





add_action('admin_init', 'multimedia_options_init' );

add_action('admin_menu', 'multimedia_options_add_page');



// Init plugin options to white list our options

function multimedia_options_init(){

    register_setting( 'multimedia_options_options', 'multimedia_', 'multimedia_options_validate' );

}



// Add menu page

function multimedia_options_add_page() {

    add_options_page('Vimeo Sample Options', 'Multimedia Settings', 'manage_options', 'multimedia_options', 'multimedia_options_do_page');

}



// Draw the menu page itself

function multimedia_options_do_page() {
	
    ?>

    <div class="wrap">

        <h2>Multimedia</h2>

        <form method="post" action="options.php">

            <?php settings_fields('multimedia_options_options'); ?>

            <?php $options = get_option('multimedia_'); ?>

            <table class="form-table">

                <tr valign="top"><th scope="row">Vimeo ID</th>

                    <td><input type="text" name="multimedia_[vimeo_id]" value="<?php echo $options['vimeo_id']; ?>" /></td>

                </tr>
				
				
            </table>

            <p class="submit">

            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />

            </p>

        </form>

    </div>

    <?php    

}



// Sanitize and validate input. Accepts an array, return a sanitized array.

function multimedia_options_validate($input) {
	
    

    // Say our option must be safe text with no HTML tags
	
    $input['vimeo_id'] =  wp_filter_nohtml_kses($input['vimeo_id']);
	$input['flickr_api_key'] =  wp_filter_nohtml_kses($input['flickr_api_key']);
	//$input['flickr_user_id'] =  wp_filter_nohtml_kses($input['flickr_user_id']);
	

    

    return $input;

}







?>