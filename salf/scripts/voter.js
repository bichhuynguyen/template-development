jQuery(document).ready(function(){
	
  	$('.thumbs').click(function(){
		loader = $('#vote_count span.voter_loader').html();
		current_count = parseFloat($('#vote_count span.number').html());
		$('#vote_count span.number').html(loader);
		
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
				count = current_count + 1;
				$('#vote_count span.number').html(count);
				$('.thumbs').attr('value',"Undo Vote");
				if (count == 1){
					$('#vote_count span.vote_grammer').html("person likes");
				} else {
					$('#vote_count span.vote_grammer').html("people like");
				}
				if (!count){
						$('#vote_count span.bethefirst').html("Be The first!");
				} else {
					$('#vote_count span.bethefirst').html("");
				}
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
			count = current_count - 1;
			$('#vote_count span.number').html(count);
			$('.thumbs').attr('value',"I Like This");
			if (count == 1){
				$('#vote_count span.vote_grammer').html("person likes");
			} else {
				$('#vote_count span.vote_grammer').html("people like");
			}
			if (!count){
					$('#vote_count span.bethefirst').html("Be The first!");
			} else {
				$('#vote_count span.bethefirst').html("");
			}
		});//*/
	}
	
	return false;
		
	});
	
	
	
});