/*jQuery.extend({
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
});*/
jQuery(document).ready(function($) {
	
	

	

	/*init*/
	

	var 	form_submitted = false,
			fadeOutSpeed = 350,
			fadeInSpeed = 350,
			signUpFocus = false,
			signUpClicked = false;
	
	
	//Prepend > onto sign up form and submenus
	$('.mailchimpSF_display_widget h2.widgettitle').prepend('<span class="pulldown">&#62;</span> ');
	
	
	$('div.post').css("margin-top","5px");
	$('#sidebar').show();
	
	
	
	/*form submission*/
	$("#mc_signup_submit").click(function(){
		submitted = true;
		$("mc_signup_form").submit();
	});
	
	
	
	
	
	/*Interface editing for mail sign up form*/
	
	buttonHTML = '<input class="chimp" type="submit" name="mc_signup_submit" id="mc_signup_submit" value="Subscribe" />';
	messageLength = $("div#mc_message.updated").html().length;//checks to see if there is a status message on the input form.
	$('div.mc_signup_submit').html(buttonHTML);

	if(messageLength==0){
		$('#mc_signup_container').hide();
	} else{
		signUpClicked = true;
	}
	$('input.mc_input').blur(function(){
		signUpFocus = false;		
	});
	$('input.mc_input').focus(function(){
		signUpFocus = true;
	});
	

	$('#sidebar').add($('#mc_signup_container')).hover(function(){
			
			pointer = $(this).children('li').children('h2');
			
			if(!signUpFocus){//check to see if form is focused
				$('#mc_signup_container').fadeIn(300);
				rotatePointer(pointer,'down');
			};
			}, function(){
					if(!signUpFocus){
					if(messageLength==0){
						
						$('#mc_signup_container').delay(2500).fadeOut(300, function(){
							rotatePointer(pointer, 'up');
						});
				};
			};
		});
		
		//function for hover submenus
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
					$(submenus).filter(this_parent).hide().data('hovered', false);
				} else {
					$(submenus).hide().data('hovered', false);
				}
				
				
				if(!hovered){
							
					$(this).data('hovered', true);
					rotatePointer(submenu_pointers,'up');
					$(menu).slideDown(300);
					rotatePointer(pointer,'down');
								
					
				} else {
					$(this).data('hovered', false);
					$(menu).delay(1000).slideUp(300);
					rotatePointer(pointer,'up');
					
				}
							
				
			
			});
	//*/

	/*
	* JS for Venue Map
	*/
	map_open = false;
	$('a.google-map').click(function(){
		if (!map_open){
			$(this).html('Close');
			$('div#content-wrapper div.post iframe.google-map').animate({'margin-top': '0px'}, 250);
			map_open = true;
		} else {
			$(this).html('View Map');
			$('div#content-wrapper div.post iframe.google-map').animate({'margin-top': '-306px'}, 250);
			map_open = false;
		}
	return false;	
	});
	
	
	/*----------------------------------------------------------------
	------------------START AJAX NAVIGATION
	//----------------------------------------------------------------*/
	
	var hash = window.location.hash.substring(1),
		host = window.location.hostname;
	
	
	$("#pages li a").each(function(){
		//identify and store URL
		direct_url = $(this).attr('href');
		$(this).data('direct_url', direct_url);
		
		//convert to paths we can use in the jQuery,
		path = $(this).html().toLowerCase();
		$(this).addClass(path);
		new_path = 'http://'+host+'/'+'#'+path;//this is the correct usage
		if(host=='localhost'){
			new_path = 'http://'+host+'/wordpress-3-beta/'+'#'+path;//REMOVE BEFORE LAUNCH
		}
		
		//change href
		$(this).attr('href', new_path);//has return FALSE; effect.
		
		//on click function---->
		}).click( function() {
		//remove selected class from all elements
		$("#pages li a").removeClass('selected');
		$("#pages li").removeClass('sub_selected');
		//add class for submenus
		great_grandparent = $(this).parent().parent().parent();
		if ($(great_grandparent).hasClass('menu-item')){
			$(great_grandparent).addClass('sub_selected');
		}
		//add selected class to this element
		$(this).addClass('selected');
		//call original href and use it to define a load area	
		direct_url = $(this).data('direct_url');
		to_load = direct_url+' #main-content-area';
		
		//load content into main content area
		mf_ajax_load_new_content();
		
		
		
		
	});
	//add classes and pointer and hover dats
	$('#nav #pages li ul.sub-menu').addClass('jquery').parent().addClass('has_submenu').data('hovered', false);
	$('#nav #pages li ul.sub-menu').siblings('a').each(function(){
		text = $(this).html();
		$(this).html('<span class="pulldown">&#62;</span> '+text);
		
	
	});
	//if direct linked from hash tag
	if (hash){
		selected = "#pages li a."+hash
		direct_url = $(selected).data('direct_url');
		$(selected).addClass('selected');
		great_grandparent = $(selected).parent().parent().parent();
		
		if ($(great_grandparent).hasClass('menu-item')){
			$(great_grandparent).addClass('sub_selected');
		}
		to_load = direct_url+' #main-content-area';
		//load content into main content area
		mf_ajax_load_new_content();
	}
	function mf_ajax_load_new_content(){
		$('#ajax_loader').clone().prependTo('#main-content-area').show();
		$('#main-content-area .post').animate({opacity:0.1},500,function(){
			$(this).children().remove();
			$(this).parent().load(to_load, function() {
				program_js();
			  	hash = window.location.hash;
				current_id = $('.post').attr('id');
				$('.post').addClass(current_id);
				$('.post').attr('id','current');
				$(this).animate({opacity:1},500);
				$('#main-content-area #ajax_loader').animate({opacity:0},500,function(){
					$(this).remove();
				});
			});
		})
		
		
	}
	
	function program_js(){
		
			program_titles = $('#program_feed .event h3');
			program_elements = $('#program_feed .event').children('div').add('#program_feed .event p');
			program_elements.hide();
			current_header_width = $('#program_feed .event h3').css('width');
			$('#program_feed .event h3').css('width', '70%');
			clicked = false
			$(program_titles).append("<span style='display: inline;color: #D92417;' class='action-call'>more</span>");

			//show/hide function
			$('#program_feed .event').click(function(){
				if (clicked != this){
					clicked = this;
					program_elements.hide();
					$('#program_feed .event h3').css('width', '70%');
					$(this).children('h3').children('span').html('less');
					$(this).children('div').add($(this).children('p')).fadeIn();
				} else {
					clicked = false;
					$(this).children('h3').children('span').html('more');
					$(this).children('div').add($(this).children('p')).hide();
				}
			});
	};
	/*----------------------------------------------------------------
	------------------END AJAX NAVIGATION
	//----------------------------------------------------------------*/
		
		
	function rotatePointer(what, where){
		if (where == 'down'){
			$(what).children('span.pulldown').addClass("pointDown");
			$(what).children('span.pulldown').removeClass("pointRight");
		} else {
			$(what).children('span.pulldown').removeClass("pointDown");
			$(what).children('span.pulldown').addClass("pointRight");
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
	
	
});

	
	