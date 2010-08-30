jQuery(document).ready(function($) {
/*
	* JS for Program Page
	*/
	//init
	program_elements = $('#program_feed .event').children('div').add('#program_feed .event p');
	program_elements.hide();
	current_header_width = $('#program_feed .event h2').css('width');
	$('#program_feed .event h2').css('width', '100%');
	clicked = false
	
	//show/hide function
	$('#program_feed .event').click(function(){
		if (clicked != this){
			clicked = this;
			program_elements.hide();
			$('#program_feed .event h2').css('width', '100%');
			$(this).children('h2').css('width', current_header_width);
			$(this).children('div').add($(this).children('p')).fadeIn();
		} else {
			clicked = false;
			$(this).children('h2').css('width', '100%');
			$(this).children('div').add($(this).children('p')).hide();
		}
	});
});
