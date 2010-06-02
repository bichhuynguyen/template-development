
jQuery(document).ready(function($) {
	
	/*init*/
	

	form_submitted = false;
	fadeOutSpeed = 350;
	fadeInSpeed = 350;
	signUpFocus = false;
	signUpClicked = false;
	active_element = '#post-2';
	$('.mc_custom_border_hdr h2').prepend('<span id="pulldown">&#62;</span> ')
	$('div.post, .top').hide();
	$('div.post').css("margin-top","5px");
	$('#footer').css("margin-top","25px");
	$('#footer').css("padding-bottom","10px");
	$('#post-2').show();
	
	/*form submission*/
	$("#mc_signup_submit").click(function(){
		submitted = true;
		$("mc_signup_form").submit();
	});
	
	/*Interface editing for mail sign up form*/
	buttonHTML = '<input type="image" name="mc_signup_submit" src="'+ templateDir + '/style/images/submit-button.png" id="mc_signup_submit" value="Subscribe" />';
	messageLength = $("div#mc_message.updated").html().length;//checks to see if there is a status message on the input form.
	$('div.mc_signup_submit').html(buttonHTML);

	if(messageLength==0){
		$('#mc_signup_container').hide();
	} else{
		signUpClicked = true;
	}
	$('.mc_custom_border_hdr h2').click(function(){//toggle for touchscreens
		if(!signUpClicked){
			/*$('span#pulldown').addClass("pointDown");
			$('span#pulldown').removeClass("pointRight");//*/
			rotatePointer('down');
			
			$('#mc_signup_container').fadeIn(300);
			signUpClicked = true;
			} else {
			rotatePointer();
			$('#mc_signup_container').fadeOut(300);
			signUpClicked = false;	
		};})
	/*$('#sidebar').hover(function(){
			$('#mc_signup_container').fadeIn(300);
		}, function(){
			if(!signUpFocus){
				if(messageLength==0){
					$('#mc_signup_container').delay(1000).fadeOut(300);
				};
			};
		});
	//*/
	$('input#mc_mv_EMAIL').focus(function(){
		signUpFocus = true;
	});
	$('input#mc_mv_EMAIL').blur(function(){
		signUpFocus = false;		
	});
	
	
	
	/*Navigation */
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
		
	function rotatePointer(where){
		if (where == 'down'){
			$('span#pulldown').addClass("pointDown");
			$('span#pulldown').removeClass("pointRight");
		} else {
			$('span#pulldown').removeClass("pointDown");
			$('span#pulldown').addClass("pointRight");
		}
	}
});

	
