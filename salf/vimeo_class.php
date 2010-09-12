<?php


class VimeoObject{
	var $id;//vimeo username
	var $video_code;//individual video code
	var $api_endpoint = 'http://vimeo.com/api/v2/';//start URL for VIMEO simple API
	var $width = 400;//default video width
	var $height = 230;//default video width
	
	function __construct($id = false){
		if($id){
			$this->id=$id;
			
		} else {
			$multimedia = get_option('multimedia_');
			$this->id = $multimedia['vimeo_id'];
		}
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
				
				<tr valign="top"><th scope="row">Flickr Api Key</th>

                    <td><input type="text" name="multimedia_[flickr_api_key]" value="<?php echo $options['flickr_api_key']; ?>" /></td>

                </tr>
				<tr valign="top"><th scope="row">Flickr User ID</th>

                    <td><input type="text" name="multimedia_[flickr_user_id]" value="<?php echo $options['flickr_user_id']; ?>" /></td>

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