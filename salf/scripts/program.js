jQuery(document).ready(function($) {
/*
	* JS for Program Page
	*/
	//init
	program_titles = $('#program_feed .event h3');
	program_elements = $('#program_feed .event').children('div').add('#program_feed .event p');
	program_elements.hide();
	current_header_width = $('#program_feed .event h3').css('width');
	$('#program_feed .event h3').css('width', '70%');
	clicked = false
	$(program_titles).append("<span style='display: inline;color: #D92417;' class='action-call'>more</span>");
	
	//show/hide function
	$('#program_feed .event').click(function(){
		if (clicked != this){
			clicked = this;
			program_elements.hide();
			$('#program_feed .event h3').css('width', '70%');
			$(this).children('h3').children('span').html('less');
			$(this).children('div').add($(this).children('p')).fadeIn();
		} else {
			clicked = false;
			$(this).children('h3').children('span').html('more');
			$(this).children('div').add($(this).children('p')).hide();
		}
	});
});
