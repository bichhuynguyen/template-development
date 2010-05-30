
jQuery(document).ready(function($) {
	$('div.post, .top').hide();
	$('#post-2').show();
	

	$("#about_btn").click( function() {
		$('div.post').fadeOut(5000, function(){
			$('#post-2').fadeIn(500);
			});
		return false;
	});
	$("#venues_btn").click( function() {
		$('div.post').fadeOut(500);
		$('#venues').fadeIn(500);
		return false;
	});
	$("#partners_btn").click( function() {
		$('div.post').fadeOut(500);
		$('#partners').fadeIn(500);
		return false;
	});
	$("#enquiries_btn").click( function() {
		$('div.post').fadeOut(500);
		$('#enquiries').fadeIn(500);
		return false;
	});
});

	
