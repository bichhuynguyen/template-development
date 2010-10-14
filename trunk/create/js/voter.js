jQuery(document).ready(function(){
	
  	jQuery('.thumbs').click(function(){
		
		
		if (jQuery(this).hasClass('up')){
			jQuery(this).removeClass('up');
			jQuery(this).addClass('down');
		action = jQuery(this).parent().attr('action');
		var elements = new Object(),
			key,
			value;
		
		jQuery(this).siblings('input').each(function(){
			key = jQuery(this).attr('name'),
			value = jQuery(this).attr('value');
					
			elements[key]=value;
		});
		
		jQuery.post(action, {ip : elements['ip'],curl : elements['curl'],post_id : elements['post_id']},function(data){
			//on success
			count = parseFloat(jQuery('#vote_count span').html()) + 1;
			jQuery('#vote_count span').html(count);
			console.log(jQuery(this));
			jQuery('.thumbs').attr('value',"Undo Vote");
			
			
		});//*/
	} else {
		jQuery(this).removeClass('down');
		jQuery(this).addClass('up');
		if (jQuery(this).parent().hasClass('up')){
			action = jQuery(this).parent().attr('action')+'?remove=true';
		} else {
			action = jQuery(this).parent().attr('action');
		}
		
		var elements = new Object(),
			key,
			value;
		
		jQuery(this).siblings('input').each(function(){
			key = jQuery(this).attr('name'),
			value = jQuery(this).attr('value');
					
			elements[key]=value;
		});
		
		jQuery.post(action, {ip : elements['ip'],curl : elements['curl'],post_id : elements['post_id']},function(data){
			//on success
			count = parseFloat(jQuery('#vote_count span').html()) - 1;
			jQuery('#vote_count span').html(count);
			jQuery('.thumbs').attr('value',"Vote");
			
			
		});//*/
	}
	
	return false;
		
	});
	
	
	
});