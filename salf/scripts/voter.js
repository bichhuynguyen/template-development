jQuery(document).ready(function(){
	$('.voter').unbind();
	
  	$('.voter').submit(function(){
		parent = this.parentNode;
		home = $(this);
	
		loader = $('.vote_count span.voter_loader',$(this).parent()).html();
		current_count = parseFloat($('.vote_count span.number',$(this).parent()).html());
		
		
		
		$('.vote_count span.number',$(home).parent()).html(loader);
		
		if ($(home).children('.thumbs').hasClass('up')){
			$(home).children('.thumbs').removeClass('up');
			$(home).children('.thumbs').addClass('down');
			action = $(home).attr('action');
			
			
			
			
			var elements = new Object(),
			key,
			value;
		
			$(home).children('input').not($(home).children('.thumbs')).each(function(){
				key = $(this).attr('name'),
				value = $(this).attr('value');
			
			elements[key]=value;
			});
			
			$.post(action, {ip : elements['ip'],curl : elements['curl'],post_id : elements['post_id']},function(data){
				//on success
				
				count = current_count + 1;
			
				$(parent).children('.vote_count').children('span.number').html(count);
				
				
				$(home).children('.thumbs').attr('value',"Undo Vote");
				
				if (count == 1){
					$(parent).children('.vote_count').children('span.vote_grammer').html("person likes");
				} else {
					$(parent).children('.vote_count').children('span.vote_grammer').html("people like");
				}
				if (!count){
						$(parent).children('.vote_count').children('span.bethefirst').html("Be The first!");
				} else {
					$(parent).children('.vote_count').children('span.bethefirst').html("");
				}
			});//*/
	} else {
		$(home).children('.thumbs').removeClass('down');
		$(home).children('.thumbs').addClass('up');
		if ($(home).hasClass('up')){
			action = $(home).attr('action')+'?remove=true';
		} else {
			action = $(home).attr('action');
		}
		
		var elements = new Object(),
			key,
			value;
		
			$(home).children('input').not($(this).children('.thumbs')).each(function(){
				key = $(this).attr('name'),
				value = $(this).attr('value');
				
			elements[key]=value;
			});
			
		$.post(action, {ip : elements['ip'],curl : elements['curl'],post_id : elements['post_id']},function(data){
			
			count = current_count - 1;
			
			$(parent).children('.vote_count').children('span.number').html(count);
			$(home).children('.thumbs').attr('value',"I Like This");
			if (count == 1){
				$(parent).children('.vote_count').children('span.vote_grammer').html("person likes");
			} else {
				$(parent).children('.vote_count').children('span.vote_grammer').html("people like");
			}
			if (!count){
					$(parent).children('.vote_count').children('span.bethefirst').html("Be The first!");
			} else {
				$(parent).children('.vote_count').children('span.bethefirst').html("");
			}
		});//*/
	}
	
	return false;
		
	});
	
	
	
});