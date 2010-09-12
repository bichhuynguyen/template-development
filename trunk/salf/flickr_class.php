<?php
class FlickrObject{
	private $api_key;//retrieved from wordpress backend
	private $user_id;//retrieved from wordpress backend
	public $method 	= 'flickr.people.getPublicPhotos';//defult method
	public $params	= array();//for storing method calls
	
	private $encoded_params;//encoded parameters
	public $param_string;//contructed string for parameters
	private $stat;//checks to see if call back was made
	private $callback_array; //holds API responce array
	private $photo_array;//holds array of photo info
	
	function image_tag($photo){
		//return URL for displaying image, based on array of attributes from flickr
		
		$img_tag = '<img src="';
		$img_tag .= 'http://farm';
		$img_tag .= $photo['farm'];
		$img_tag .= '.static.flickr.com/';
		$img_tag .= $photo['server'];
		$img_tag .= '/';
		$img_tag .= $photo['id'];
		$img_tag .= '_';
		$img_tag .= $photo['secret'];
		$img_tag .= '_m.jpg';
		$img_tag .= '" />';
		
		return $img_tag;
	}
	
	function anchor_tag($photo, $inc_end=true){
		//build link to view image on flickr
		
		$img_tag = "<a target='_blank' href='";
		$img_tag .= "http://www.flickr.com/photos/";
		$img_tag .= $photo['owner'];
		$img_tag .= '/';
		$img_tag .= $photo['id'];
		if ($inc_end):
			$img_tag .= "'>View on Flickr</a>";
		else: //cut off close tag and text
			$img_tag .= "'>";
		endif;
			
		
		return $img_tag;
	}
	
	function __construct($api_key = false, $user_ID = false){
		/*Contruct arguments in order to override wordpress settings, if required.*/
		
		
		//Set API Key by input, else fetch from wordress DB
		if($api_key){
			$this->api_key=$api_key;
		} else {
			$multimedia = get_option('multimedia_');
			$this->api_key = $multimedia['flickr_api_key'];
		}
		//Set User ID by input, else fetch from wordress DB
		if($user_ID){
			$this->user_ID=$user_ID;
		} else {
			$multimedia = get_option('multimedia_');
			
			$this->user_id = $multimedia['flickr_user_id'];
		}
	}
	
	function build_params(){
			//create full list of parameters for URL contruction
		$this->params = array_merge(array(
			'api_key'	=> 	$this->api_key,
			'user_id'	=> 	$this->user_id,
			'method'	=> 	$this->method							
		),$this->params);
		
		//URL Encode the Parameters
		$encoded_params = array();

		foreach ($this->params as $k => $v){

			$this->encoded_params[] = urlencode($k).'='.urlencode($v);
		}
		//make into string, using '&' as delimiter
		$this->param_string = implode('&', $this->encoded_params);		
	}
	
	function api_call(){
		$this->build_params();
			
		$url = "http://api.flickr.com/services/rest/?".$this->param_string;
		$user_photos_callback = new SimpleXMLElement($url, NULL, TRUE);
		$this->callback_array = get_object_vars($user_photos_callback);
		//Set results $stat
		$this->stat = $this->callback_array['@attributes']['stat'];
		
			
			
	}
	
	function convert_XML($single = false){
		//converts returned API call into associative array
		$this->api_call();
		if ($this->stat!='ok') return false; //Kills function if API call failed.
		
		if(!$single):
			foreach ($this->callback_array['photos'] as $photo){
				$photos[]=get_object_vars($photo);
			}
		else://single is true
			$photos=get_object_vars($this->callback_array['photo']);
		endif;
		$this->photo_array = $photos;
		
	}
	
	function images_and_links(){
		$this->convert_XML();
	if ($this->stat != 'fail'): //check API call was success	
		$ul_images = '<ul class="flickr_feed">';	
			foreach ($this->photo_array as $photo){
				$photo = $photo['@attributes'];
			
			
				$ul_images .= '<li class="flickr_image">';
				$ul_images .= $this->anchor_tag($photo, false);
				$ul_images .= $this->image_tag($photo);
				$ul_images .= '</a>';
				$ul_images .= '</li>';
			}
			$ul_images .= '</ul>';
			
			echo $ul_images;	
	else: //if API call failed
			echo "Flickr Call Failed - Please Check Details";
	endif;
	}
	
	function get_image_by_id($id){
		$this->method = 'flickr.photos.getInfo';
		$this->params = array('photo_id' => $id);
		$this->convert_XML(true);
		
		if ($this->stat != 'fail'): //check API call was success
			$link = get_object_vars($this->photo_array['urls']);
			$link = $link['url'];
			$photo = $this->photo_array['@attributes'];
			$photo = array_merge(array(
				'owner'	=> 	$this->photo_array['owner']->attributes['nsid']			
				),$photo);
		
			echo "<a href='$link'>";
			echo $this->image_tag($photo);
			echo "</a>";
		else: //if API call failed
			echo "Flickr Call Failed - Please Check Photo ID";
		endif;
		fb::log($this->stat, 'status');
		
	}
	
	

}

?>