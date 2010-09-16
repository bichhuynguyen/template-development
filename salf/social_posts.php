<?php ?>
<script type="text/javascript">
function getTinyUrl($url) {   
     $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url);  
     return $tinyurl;  
}
var twtTitle  = "Just reading '<?php the_title(); ?>'";

var tinyUrl = "<?php 

	echo getTinyUrl(get_permalink(get_the_ID()));?>";

var twtLink =  'http://twitter.com/home?status='+encodeURIComponent(twtTitle + ' ' + tinyUrl + " #salf");
document.write('<a class="twitter" href="'+twtLink+'" target="_blank"'+'><img src="<?php echo bloginfo('template_url')?>/style/images/social/twitter.png"  border="0" alt="Tweet This!" /'+'><'+'/a>');
</script>
<noscript><a class="twitter" href="http://twitter.com/home?status=<?php echo getTinyUrl(get_permalink(get_the_ID()));?>" target="_blank"'+'><img src="<?php echo bloginfo('template_url')?>/style/images/social/twitter.png"  border="0" alt="Tweet This!" /></a></noscript>
 
<span class="facebook-connect">
<a href=# target="_blank" class="facebook"><img src="<?php echo bloginfo('template_url')?>/style/images/social/facebook.png" width="16" height="16" alt="Facebook" /></a>
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
FB.init({appId: '130496703654288', status: true, cookie: true,
xfbml: true});
};
(function() {
var e = document.createElement('script'); e.async = true;
e.src = document.location.protocol +
'//connect.facebook.net/en_US/all.js';
document.getElementById('fb-root').appendChild(e);
}());
</script>
<div class="fb-iframe"><fb:like action='like' colorscheme='light'
layout='standard' show_faces='true' /></div>
</span>
<?php ?>