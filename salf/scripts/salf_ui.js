jQuery.extend({
  getUrlVars: function(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
  },
  getUrlVar: function(name){
    return $.getUrlVars()[name];
  }
});
jQuery(document).ready(function($) {
	if(window.location.hash){
if(window.location.hash == '#mc_signup_form'){
active_element = '#home';
	
} else{active_element = window.location.hash;}
	} else {
		active_element = '#home';
	};
	/*init*/
	

	var form_submitted = false,
	fadeOutSpeed = 350,
	fadeInSpeed = 350,
	signUpFocus = false,
	signUpClicked = false;
	
	/*copyText = $('span.copyright').css('float','right');
	
	$(active_element).after(copyText);//Move copyright text;
	$('#footer').remove();*/
	//$('.mc_custom_border_hdr h2').prepend('<span id="pulldown">&#62;</span> ');
	$('.mailchimpSF_display_widget h2.widgettitle').prepend('<span id="pulldown">&#62;</span> ');
	$('.home div.post, .top').hide();
	$('div.post').css("margin-top","5px");
	
	$(active_element).show();
	
	/*form submission*/
	$("#mc_signup_submit").click(function(){
		submitted = true;
		$("mc_signup_form").submit();
	});
	
	
	
	
	
	/*Interface editing for mail sign up form*/
	//buttonHTML = '<input type="image" name="mc_signup_submit" src="'+ templateDir + '/style/images/submit-button.png" id="mc_signup_submit" value="Subscribe" />';
	buttonHTML = '<input class="chimp" type="submit" name="mc_signup_submit" id="mc_signup_submit" value="Subscribe" />';
	messageLength = $("div#mc_message.updated").html().length;//checks to see if there is a status message on the input form.
	$('div.mc_signup_submit').html(buttonHTML);

	if(messageLength==0){
		$('#mc_signup_container').hide();
	} else{
		signUpClicked = true;
	}
	
	$('.mc_custom_border_hdr h2').click(function(){//toggle for touchscreens
		if(!signUpClicked){
			
			rotatePointer('down');
			$('#mc_signup_container').fadeIn(300);
			signUpClicked = true;
			
			} else {
			
			rotatePointer();
			$('#mc_signup_container').fadeOut(300);
			signUpClicked = false;	
			
		};
	});
	$('#sidebar').hover(function(){
			
			
			$('#mc_signup_container').fadeIn(300);
			rotatePointer('down');
			}, function(){
					if(!signUpFocus){
					if(messageLength==0){
						
						$('#mc_signup_container').delay(1000).fadeOut(300, function(){
							rotatePointer();
						});
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
	
	
	/*----------
	Navigation 
	------------*/
	$(".home #pages li a").click( function() {
		
		button_action($(this).attr('href'));
		return false;
	});
	
	
	function button_action(mf_element){
		if (active_element != mf_element){
			/*Move Copyright Text	
			$('span.copyright').hide(function(){
				$(mf_element).after(copyText, function(){
					$(this).show();
				});
			});*/
			
			
			$(active_element).fadeOut(fadeOutSpeed, function(){
				$(mf_element).fadeIn(fadeInSpeed, function(){
					
					/*Switch Active Element*/
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
	$(function(){
		positionFooter(); 
		function positionFooter(){
			if($(document.body).height() < $(window).height()){
				$("#pageFooterOuter").css({position: "absolute",top:($(window).scrollTop()+$(window).height()-$("#pageFooterOuter").height())+"px"})
			}	
		}

		$(window)
			.scroll(positionFooter)
			.resize(positionFooter)
	});
	
	/*
	*
	*Interface Interactions
	*
	*/
	$('a.news-top').hover(function(){
		$('span.subscribe-hint').animate({ opacity: 1}, 200);
	}, function(){
		$('span.subscribe-hint').animate({ opacity: 0}, 100);
	}
	);
	//Hover/click classes nav menu
	$('.page_item a').each(function(){
		if($(this).attr('href')==active_element){
			$(this).addClass('selected');
			$('.page_item a').not(this).removeClass('selected');
		}
	});
	
	$('.page_item a').click(function(){
		$(this).addClass('selected');
		$('.page_item a').not(this).removeClass('selected');
	});
	//facebook controls
	commentOpen = false;
	commentFocus = false;
	$('span.facebook-connect').show();
	$('#nav span.facebook-connect').click(function(){
		parent = $(this);
		socialButtons = $(this).children('a.facebook').children('img').add($(this).siblings('a.twitter'));
		
		$(socialButtons).fadeOut(200, function(){
			$(parent).siblings('a.twitter').hide();
			$(parent).children('div.fb-iframe').animate({ opacity: 1, width: 250, height: 74}, 500);
		});
	
		$(this).children('div.fb-iframe').mouseout(function(){
					if($(this).css('opacity') == 1){
						$(this).animate({ opacity: 0, width: 10, height: 10}, 200, function(){
							$(socialButtons).fadeIn(200);
						});
					}
			
			});//*/
			
		return false;
	});//*/
	$('.post span.facebook-connect').click(function(){
		parent = $(this);
		socialButtons = $(this).children('a.facebook').children('img');
		
		$(socialButtons).fadeOut(500, function(){
			
			$(parent).children('div.fb-iframe').animate({ opacity: 1, width: 200, height: 34}, 500);
		});
	
			
			
			
		return false;
	});//*/
	$('.datepicker').datePicker({clickInput:true});
	
	
});

	
	