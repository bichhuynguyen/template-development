<?php
	
class FlickrObject{
		private $api_key;//default API key belongs to MildFuzz
		public $method 	= 'flickr.people.getPublicPhotos';//defult method
		public $params	= array();//for storing method calls
		
		private $encoded_params;//encoded parameters
		private $param_string;//contructed string for parameters
		private $stat;//checks to see if call back was made
		private $callback_array; //holds API responce array
		private $photo_array;//holds array of photo info
		
		function __construct($api_key = false){
			if($api_key){
				$this->api_key=$api_key;

			} else {
				$multimedia = get_option('multimedia_');
				$this->api_key = $multimedia['flickr_api_key'];
			}
		}
		
		function image_source($photo){
			//return URL for displaying image, based on array of attributes from flickr
			$img_tag = 'http://farm';
			$img_tag .= $photo['farm'];
			$img_tag .= '.static.flickr.com/';
			$img_tag .= $photo['server'];
			$img_tag .= '/';
			$img_tag .= $photo['id'];
			$img_tag .= '_';
			$img_tag .= $photo['secret'];
			$img_tag .= '_m.jpg';
			
			return $img_tag;
		}
		
		function image_on_flickr($photo){
			//build link to view image on flickr
			$img_tag = "http://www.flickr.com/photos/";
			$img_tag .= $photo['owner'];
			$img_tag .= '/';
			$img_tag .= $photo['id'];
			
			return $img_tag;
		}
		
		function build_params(){
			//create full list of parameters for URL contruction
			$this->params = array_merge(array(
				'api_key'	=> 	$this->api_key,
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
			fb::log($this->callback_array);
			
			
		}
		
		function convert_XML(){
			$this->api_call();
			if ($this->stat!='ok') return false; //Kills function if API call failed.
			
			foreach ($this->callback_array['photos'] as $photo){
				$photos[]=get_object_vars($photo);
			}
			$this->photo_array = $photos;
			
		}
		
		function images_and_links(){
			$this->convert_XML();
			
			foreach ($this->photo_array as $photo){
				$photo = $photo['@attributes'];
				
				$img_tag = '<img src="';
				$img_tag .= $this->image_source($photo);
				$img_tag .= '" />';
				$images[] = $img_tag;
				
				$link = "<a target='_blank' href='";
				$link .= $this->image_on_flickr($photo);
				$link .= "'>View on Flickr</a>";
				$links[] = $link;
			}
			fb::log($links,"links:");
			$return[0] = $images;
			$return[1] = $links; 
			return $return;
		}
		
		
		function echo_ul_images(){
			$images_and_links = $this->images_and_links();
			$images = $images_and_links[0];
			$links = $images_and_links[1];
			
			$ul_images = '<ul class="flickr_feed">';
			foreach ($images as $k=>$image){
				$ul_images .= '<li class="flickr_image">';
				$ul_images .= $image;
				$ul_images .= $links[$k];
				$ul_images .= '</li>';
			}
			$ul_images .= '</ul>';
			echo $ul_images;
		}

		
		
		
		
		

	
	
}
?>		