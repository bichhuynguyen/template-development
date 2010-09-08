<?php
	
class FlickrObject{
		public $api_key	= '742f4e6fb0d0b624666cc74638779fe7';//default API key belongs to MildFuzz
		public $method 	= 'flickr.people.getPublicPhotos';//defult method
		public $params	= array();//for storing method calls
		
		private $encoded_params;//encoded parameters
		private $param_string;//contructed string for parameters
		private $stat;//checks to see if call back was made
		private $callback_array; //holds API responce array
		private $photo_array;//holds array of photo info
		
		
		function image_source($photo){
			//build URL for images, based on array of attributes from flickr
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
			
			
			
		}
		
		function convert_XML(){
			$this->api_call();
			if ($this->stat!='ok') return false; //Kills function if API call failed.
			
			foreach ($this->callback_array['photos'] as $photo){
				$photos[]=get_object_vars($photo);
			}
			$this->photo_array = $photos;
			
		}
		
		function img_tag_array(){
			$this->convert_XML();
			
			foreach ($this->photo_array as $photo){
				$photo = $photo['@attributes'];
				
				$img_tag = '<img src="';
				$img_tag .= $this->image_source($photo);
				$img_tag .= '" />';
				$images[] = $img_tag;
			} 
			return $images;
		}
		
		
		function echo_ul_images(){
			$images = $this->img_tag_array();
			
			$ul_images = '<ul class="flickr_feed">';
			foreach ($images as $image){
				$ul_images .= '<li class="flickr_image">';
				$ul_images .= $image;
				$ul_images .= '</li>';
			}
			$ul_images .= '</ul>';
			echo $ul_images;
		}

		
		
		
		
		

	
	
}
?>		