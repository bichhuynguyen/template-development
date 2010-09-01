jQuery(document).ready(function($) {
/*
	* JS for news Page
	*/
	//init
	
	news = $('.archive-page .new-entry');
	news.each(function(){
   			grandparent = $(this).parent().parent();
        	href = $(this).parent('a').attr('href');
			$(this).append('<a href="'+href+'">Read More</a>');
         	object = $(this).parent().html();
			grandparent.prepend(object);
         	$(this).parent().remove();
        
        
    })
    news = $('.archive-page .new-entry');

	news_titles = $('.archive-page .new-entry h2').add('post-details');
	news_elements = $('.archive-page .new-entry').children().not(news_titles);
	news_elements.hide();
	

	news.css({'min-height':'80px'});
	
	clicked = false
	$(news_titles).append("<span class='action-call'>more</span>");
	
	//show/hide function
	news.click(function(){
		if (clicked != this){
			clicked = this;
			news_elements.hide();
			news.removeClass('active');
			$(this).addClass('active');
			$(this).children().slideDown();
			news.children('h2').children('span').not($(this).children('h2').children('span')).html('more');
			$(this).children('h2').children('span').html('less');
		} else {
			clicked = false;
			$(this).removeClass('active');
			$(this).children('h2').children('span').html('more');
			$(this).children().not('h2').slideUp();
			$(this).children('span').html('more');
		}
	});
});
