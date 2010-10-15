
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
			
			$(this).load(url+' '+div, function() {
				mf_pop_parent($(this).children("#sidebar"));
				$(this).animate({opacity:1},500);
				
	 
			});
		})
}

function mf_pop_parent(selector){
	$(selector).each(function(){
          grandparent = $(this).parent().parent();
          object = $(this).parent().html();
          grandparent.prepend(object);
          $(this).parent().remove();
     })
}

});