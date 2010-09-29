jQuery(document).ready(function($) {
/*
	* JS for Program Page
	*/
	//init
	program_titles = $('#program_feed .event h3');
	program_elements = $('#program_feed .event').children('div');
	program_elements.hide();
	current_header_width = $('#program_feed .event h3').css('width');
	$('#program_feed .event h3').css('width', '70%');
	clicked = false
	$(program_titles).append("<span class='action-call'>more info / buy tickets</span>");
	
	//show/hide function
	$('#program_feed .event').click(function(){
		if (!$(this).hasClass('active')){
			
			
			$(this).addClass('active');
			
			$(this).children('h3').children('span').html('less');
			$(this).children('div').add($(this).children('div.event_content').children('p')).slideDown();
		} else {
			
			$(this).removeClass('active');
			$(this).children('h3').children('span').html('more info / buy tickets');
			$(this).children('div').add($(this).children('div.event_content').children('p')).slideUp();
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
