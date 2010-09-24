<?php

add_action( 'init', 'register_my_menus',10 );

function register_my_menus() {
	register_nav_menus(
			array(
				'main-navigation' => 'Main Navigation',
				'footer' => 'Footer Links'
			)
		);
	
	register_nav_menu('main-navigation', 'Main Navigation');
	register_nav_menu('footer', 'Footer Links');
}

?>