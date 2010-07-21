<?php
/*--------------
Thumbnail Support
----------------*/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 100, 100, true);
add_image_size( 'small-uncropped', 100, 100);
add_image_size( 'small-cropped', 100, 100, true);
add_image_size( 'med-uncropped', 200, 200);
add_image_size( 'med-cropped', 200, 200, true);
add_image_size( 'large-uncropped', 500, 500);
add_image_size( 'large-cropped', 500, 500, true);
add_image_size( 'partner-titles', 395, 49);
add_image_size( 'venue-images', 165, 115, true);


function mf_post_thumbnail($style){
if ( has_post_thumbnail() ) {
	echo "<div class='news-thumb'>";
	the_post_thumbnail($style);
	echo "</div>";
	} else {
		/*echo "<div class='news-thumb'><img width='200' height='200'   src='";
		echo bloginfo('template_directory'); 
		echo"/images/teacher_no_thumb.png'></div>";*/
	} 

}


function get_attached_images(){
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
      'post_parent' => $post->ID,
      'order' => 'ASC',
      'orderby' => 'menu_order'
      ); 
    $attachment = get_posts($args); // Get attachment
    if ($attachment) {
      $img = wp_get_attachment_image_src($attachment[0]->ID, $size = 'thumbnail'); 
    	//echo "<img alt=\"";
		//echo the_title();
		//echo "\" src=\"";
		echo $img[0];
		//echo "\" width=\"";
		//echo $img[1]
		//echo "\" height=\""
		//echo $img[2]
		//echo "\"/>";
		//print_r($attachment);
  	}
}




/*--------------
Sidebar Support
----------------*/
if ( function_exists('register_sidebar') ) {
   register_sidebar(array(
       'before_widget' => '<li id="%1$s" class="widget %2$s">',
       'after_widget' => '</li>',
       'before_title' => '<h2 class="widgettitle">',
       'after_title' => '</h2>',
   ));
}

/*
---------------
Objects and Tax
---------------
*/
add_action( 'init', 'add_fitzgraham_objects_and_taxonomy' );
function add_fitzgraham_objects_and_taxonomy(){
	add_new_object('Volunteer');
	add_new_object('Events');
	add_new_object('Venues');
	add_new_object('Partners');
	add_new_object('People');
	add_new_taxonomy('Partners', array('People','Partners'));
	
	//add_new_object('Prices');
}

function add_new_object($object_name) {
	register_post_type($object_name,
		array(
			'labels' => mf_create_labels($object_name),
			'public' => true,
			'supports' => array('title','editor','thumbnail','page-attributes')			
		)
	);

	
}

function add_new_taxonomy($taxonomy, $object){//attaches taxonomy to an object in the admin area 
$labels = mf_create_labels($taxonomy);
$args = array(
    'labels' => $labels,
	'show_tagcloud' => false,
	'hierarchical'=> true
);
register_taxonomy($taxonomy, $object, $args);
}

function mf_create_labels($label){
	return array(
		'name' => __($label),
		'singular_name' => __($label),
		'add_new' => _x('Add New', $label),
	    'add_new_item' => __('Add New '.$label),
	    'edit_item' => __('Edit '.$label),
	    'new_item' => __('New '.$label),
	    'view_item' => __('View '.$label),
	    'search_items' => __('Search '.$label),
	    'not_found' =>  __('No ' . $label . ' found'),
	    'not_found_in_trash' => __('No ' . $label . '  found in Trash'), 
	    'parent_item_colon' => ''
	);
}
/*
---------------
-----END-------
---------------
*/

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

/*
------------
---Menus----
------------
*/

add_action( 'template_redirect', 'mfields_redirect_custom_content_multiple' );
function mfields_redirect_custom_content_multiple() {
	global $mfields_template;
	if( $mfields_template ) {
		include_once( $mfields_template );
		exit();
	}
	return false;
}

add_filter( 'status_header', 'mfields_template_404' );
function mfields_template_404( $c ) {
	global $mfields_template;
	$mfields_template = mfields_locate_custom_template();
	if( $mfields_template ) {
		$header = '200';
		$text = get_status_header_desc( $header );
		$protocol = $_SERVER["SERVER_PROTOCOL"];
		if ( 'HTTP/1.1' != $protocol && 'HTTP/1.0' != $protocol )
			$protocol = 'HTTP/1.0';

		return "$protocol $header $text";
	}
	else
		return $c;
}

function mfields_locate_custom_template() {
	global $wp_post_types, $wp;
	if( is_404() ) {
		if( array_key_exists( $wp->request, $wp_post_types ) ) {
			$file = STYLESHEETPATH . '/' . $wp->request . '-multiple.php';
			$file = ( file_exists( $file ) ) ? $file : get_index_template();
			return $file;
		}
	}
	return false;
}


/*
------------
---Menus----
------------
*/




/*function tweetmeme(){
?>
<div style="float: right; margin: 5px 0 15px 15px;">
<script type="text/javascript">
tweetmeme_url = '<?php the_permalink(); ?>';
</script>
<script type="text/javascript" src="http://tweetmeme.com/i/scripts/button.js"></script>
</div>
<?php
}//*/

/*
Get Twitter Followers

function curl($url)
{
$ch = curl_init($url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_HEADER, 0);
curl_setopt($ch,CURLOPT_USERAGENT,"southasianlitfest.com");
curl_setopt($ch,CURLOPT_TIMEOUT,10);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}
function GetTwitterFollowerCount($username)
{
$twitter_followers = curl("http://twitter.com/statuses/user_timeline/".$username.".xml?count=1");
$xml = new SimpleXmlElement($twitter_followers, LIBXML_NOCDATA);
return $xml->status->user->followers_count;
}

echo GetTwitterFollowerCount("YourTwitterName");


//Alterate Method


$twit = file_get_contents('http://twitter.com/users/show/USERNAME.xml');
$begin = '<followers_count>'; $end = '</followers_count>';
$page = $twit;
$parts = explode($begin,$page);
$page = $parts[1];
$parts = explode($end,$page);
$tcount = $parts[0];
if($tcount == '') { $tcount = '0'; }
echo '<div class="twitter-badge"><strong>'.$tcount.' </strong> Followers</div>';//*/

/*class twitter_class
{
  function twitter_class()
  {
    $this->realNamePattern = '/\((.*?)\)/';
    $this->searchURL = 'http://search.twitter.com/search.atom?lang=en&q=';
 
    $this->intervalNames = array('second', 'minute', 'hour', 'day', 'week', 'month', 'year');
    $this->intervalSeconds = array( 1,        60,       3600,   86400, 604800, 2630880, 31570560);
 
    $this->badWords = array('bannedword', 'anotherbannedword');
  }
 
  function getTweets($q, $limit=15)
  {
    $output = '';
 
    // get the seach result
    $ch= curl_init($this->searchURL . urlencode($q));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    $response = curl_exec($ch);
 
    if ($response !== FALSE)
    {
      $xml = simplexml_load_string($response);
      $output = '';
      $tweets = 0;
 
      for($i=0; $i<count($xml->entry); $i++)
      {
        $crtEntry = $xml->entry[$i];
        $account  = $crtEntry->author->uri;
        $image    = $crtEntry->link[1]->attributes()->href;
        $tweet    = str_replace('<a href=', '<a target="_blank" href=', $crtEntry->content);
 
        // skip tweets containing banned words
        $foundBadWord = false;
        foreach ($this->badWords as $badWord)
        {
          if(stristr($tweet, $badWord) !== FALSE)
          {
            $foundBadWord = true;
            break;
          }
        }
 
        // skip this tweet containing a banned word
        if ($foundBadWord)
          continue;
 
        // don't process any more tweets if at the limit
        if ($tweets==$limit)
          break;
        $tweets++;
 
        // name is in this format "acountname (Real Name)"
        preg_match($this->realNamePattern, $crtEntry->author->name, $matches);
        $name = $matches[1];
 
        // get the time passed between now and the time of tweet, don't allow for negative
        // (future) values that may have occured if server time is wrong
        $time = 'just now';
        $secondsPassed = time() - strtotime($crtEntry->published);
        if ($secondsPassed>0)
        {
          // see what interval are we in
          for($j = count($this->intervalSeconds)-1; ($j >= 0); $j--)
          {
            $crtIntervalName = $this->intervalNames[$j];
            $crtInterval = $this->intervalSeconds[$j];
 
            if ($secondsPassed >= $crtInterval)
            {
              $value = floor($secondsPassed / $crtInterval);
              if ($value > 1)
                $crtIntervalName .= 's';
 
              $time = $value . ' ' . $crtIntervalName . ' ago';
 
              break;
            }
          }
        }
        $output .= '
          <div class="tweet">
          <div class="avatar">
            <a href="' . $account . '" target="_blank"><img src="' . $image .'"></a>
          </div>
          <div class="message">
            <span class="author"><a href="' . $account . '"target="_blank">' . $name . '</a></span>: ' .
              $tweet .
              '<span class="time"> - ' . $time . '</span>
          </div>
        </div>';
      }
    }
    else
      $output = '<div class="tweet"><span class="error">' . curl_error($ch) . '</span></div>';
    curl_close($ch);
    return $output;
  }
}//*/
?>