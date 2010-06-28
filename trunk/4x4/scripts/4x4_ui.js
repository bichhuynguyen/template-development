jQuery(document).ready(function($) {
	/*
	*
	* Map UI
	*
	*/
	
	map_show=false;
	
	currentMap=$('#map').css('margin-top');
	$('#prem a').click(function(){
		if (!map_show){
				$('#map').animate({'margin-top':"0px"});	
				map_show=true;	
				
				
		} else {
		$('#map').animate({'margin-top':currentMap});	
		map_show=false;
		}
		return false;
	});
	$('#map').click(function(){
		if(map_show){
			$('#map').animate({'margin-top':currentMap});	
			map_show=false;
			
		}
	});
	
	/*
	*
	* Block UI
	*
	*/
	
	
	$('.project,#body-wrapper,#logos').hide();
	$('.project img.border').remove();

	transSpeed = 700;
	
	if(window.location.hash){
	activeElement = window.location.hash;
	$(activeElement).slideDown(transSpeed);
	
	} else {
		
		activeElement = '#body-wrapper,#logos';
		$(activeElement).slideDown(transSpeed);
	};
	
	$("#nav li a").click(function(){
		if(map_show){
			$('#map').animate({'margin-top':currentMap});	
			map_show=false;
			
		}
		slideChange =  ($(this).attr("href"));
		
		if(activeElement != slideChange){
	 
			slideChange =  ($(this).attr("href"));
			$(activeElement).slideUp(transSpeed,function(){
				activeElement = slideChange;
				$(activeElement).slideDown(transSpeed);
			});
		activeElement = ($(this).attr("href"));
		
		
		}
		return false;
	});
	$("#header h1 a").click(function(){
		if(map_show){
			$('#map').animate({'margin-top':currentMap});	
			map_show=false;
			
		}
		if(activeElement != '#body-wrapper,#logos'){
			$(activeElement).slideUp(transSpeed,function(){
				activeElement = '#body-wrapper,#logos';
				$(activeElement).slideDown(transSpeed);
			});
		}
		return false;
	});
});