jQuery(document).ready(function($) {
	map_show=false;
	
	$('#prem a').click(function(){
		if (!map_show){
				$('#map').slideDown(500);	
				map_show=true;	
				
				
		} else {
		$('#map').slideUp(500);	
		map_show=false;
		}
		return false;
	});
	$('#map').click(function(){
		if(map_show){
			$('#map').slideUp(500);	
			map_show=false;
		}
	});
	
});