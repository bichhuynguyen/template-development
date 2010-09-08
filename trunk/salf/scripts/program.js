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
	$(program_titles).append("<span class='action-call'>more</span>");
	
	//show/hide function
	$('#program_feed .event').click(function(){
		if (clicked != this){
			clicked = this;
			program_elements.hide();
			$('#program_feed .event').removeClass('active');
			$(this).addClass('active');
			$('#program_feed .event h3').css('width', '70%');
			$('#program_feed .event h3 span').not($(this).children('h3').children('span')).html('more');
			$(this).children('h3').children('span').html('less');
			$(this).children('div').add($(this).children('p')).slideDown();
		} else {
			clicked = false;
			$(this).removeClass('active');
			$(this).children('h3').children('span').html('more');
			$(this).children('div').add($(this).children('p')).slideUp();
		}
	});
	//hide checks when different search criteria used (for usablity, makes it obvious only one can be used at once)
	$('#program_search .events input').click(function(){
		$('#program_search .venue input').removeAttr('checked');
	})
	$('#program_search .venue input').click(function(){
		$('#program_search .events input').removeAttr('checked');
	})
});
