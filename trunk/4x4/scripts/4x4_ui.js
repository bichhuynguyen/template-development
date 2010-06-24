jQuery(document).ready(function($) {
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
	
});