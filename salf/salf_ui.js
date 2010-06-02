
jQuery(document).ready(function($) {
	
	//buttonHTML = '<input type="image" src="'+ templateDir + '/style/images/submit-button.png" id="mc_signup_submit" value="Subscribe" />';
	fadeOutSpeed = 350;
	fadeInSpeed = 350;
	signUpFocus = false;
	active_element = '#post-2';
	$('div.post, .top').hide();
	$('div.post').css("margin-top","5px");
	$('#footer').css("margin-top","25px");
	$('#footer').css("padding-bottom","10px");
	//$('div.mc_signup_submit').html(buttonHTML);
	$('#mc_signup_container').hide();

	$('#post-2').show();
	
	
	
	$('#sidebar').click(function(){
			$('#mc_signup_container').fadeIn(300)
			;})
	$('#sidebar').hover(function(){
			$('#mc_signup_container').fadeIn(300);
		}, function(){
			if(!signUpFocus){
			$('#mc_signup_container').delay(1000).fadeOut(300);
			};
		});
	//*/
	$('input#mc_mv_EMAIL').focus(function(){
		signUpFocus = true;
		
		/*$('div.post').animate({
			marginTop: "30px"
			}, 500);
		$('#mc_signup_submit').fadeIn(1000);*/
	});
	$('input#mc_mv_EMAIL').blur(function(){
		signUpFocus = false;
		
		
		/*$('#mc_signup_submit').fadeOut(200, function(){
			$('div.post').animate({
				marginTop: "5px"
				}, 500);
		});*/
	});
	
	$("#about_btn").click( function() {
		button_action('#post-2');
		return false;
	});
		
	$("#venues_btn").click( function() {
		button_action('#venues');
		return false;
	});
	$("#partners_btn").click( function() {
		button_action('#partners');
		return false;
	});
	$("#enquiries_btn").click( function() {
		button_action('#enquiries');
		return false;
	});
	$("#events_btn").click( function() {
		button_action('#events');
		return false;
	});
	
	function button_action(mf_element){
		if (active_element != mf_element){
			
			$(active_element).fadeOut(fadeOutSpeed, function(){
				$(mf_element).fadeIn(fadeInSpeed, function(){
					active_element = mf_element;
					});
				});
			}
		}
		
	
});

	
