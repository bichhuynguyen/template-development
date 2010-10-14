
jQuery(document).ready(function($){
	$("ul.vimeo_desc_feed li a").click(function(){
		mf_ajax_load_new_content($(this).attr('href'), "#sidebar");
		//alert($(this).attr('href'));
		return false;
	})
	
function mf_ajax_load_new_content(url, div){
		//$('#ajax_loader').clone().prependTo('#main-content-area').show();
		$(div).animate({opacity:0.1},500,function(){
			$(this).children().remove();
			
			$(this).parent().load(url+div, function() {
				$(this).animate({opacity:1},500);
			});
		})
}
});