jQuery(document).ready(function($) {
menu_items = $('#nav #pages li');
submenus = $('#nav #pages li ul.sub-menu');
submenu_pointers = $(submenus).siblings('a');
submenus_parents = $(submenus).parent();




$(submenus_parents).hover(function(){
		hovered = $(this).data('hovered');
		pointer = $(this).children('a');
		menu = $(this).children('.sub-menu');
		
		this_parent = $(this).parent();
		if($(this_parent).hasClass('sub-menu')){
			$(submenus).filter(this_parent).stop(true,true).hide().data('hovered', false);
		} else {
			$(submenus).hide().data('hovered', false);
		}
		
		
		if(!hovered){
					
			$(this).data('hovered', true);
			rotatePointer(submenu_pointers,'up');
			$(menu).stop(true,true).slideDown(300);
			rotatePointer(pointer,'down');
						
			
		} else {
			$(this).data('hovered', false);
			$(menu).delay(1000).stop(true,true).slideUp(300);
			rotatePointer(pointer,'up');
			
		}
					
		
	
});
});