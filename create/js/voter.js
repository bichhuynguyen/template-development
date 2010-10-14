jQuery(document).ready(function($){
	
  	$('.thumbs').click(function(){
		
		
		if ($(this).hasClass('up')){
			$(this).removeClass('up');
			$(this).addClass('down');
		action = $(this).parent().attr('action');
		var elements = new Object(),
			key,
			value;
		
		$(this).siblings('input').each(function(){
			key = $(this).attr('name'),
			value = $(this).attr('value');
					
			elements[key]=value;
		});
		
		$.post(action, {ip : elements['ip'],curl : elements['curl'],post_id : elements['post_id']},function(data){
			//on success
			count = parseFloat($('#vote_count span').html()) + 1;
			$('#vote_count span').html(count);
			console.log($(this));
			$('.thumbs').attr('value',"Undo Vote");
			
			
		});//*/
	} else {
		$(this).removeClass('down');
		$(this).addClass('up');
		if ($(this).parent().hasClass('up')){
			action = $(this).parent().attr('action')+'?remove=true';
		} else {
			action = $(this).parent().attr('action');
		}
		
		var elements = new Object(),
			key,
			value;
		
		$(this).siblings('input').each(function(){
			key = $(this).attr('name'),
			value = $(this).attr('value');
					
			elements[key]=value;
		});
		
		$.post(action, {ip : elements['ip'],curl : elements['curl'],post_id : elements['post_id']},function(data){
			//on success
			count = parseFloat($('#vote_count span').html()) - 1;
			$('#vote_count span').html(count);
			$('.thumbs').attr('value',"Vote");
			
			
		});//*/
	}
	
	return false;
		
	});
	
	
	
});