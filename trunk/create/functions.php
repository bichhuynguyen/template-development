<?php
/**
 * @package WordPress
 * @subpackage Starkers
 */


automatic_feed_links();

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}


include('functions/includes.php');
include('functions/menus.php');
include('functions/meta_class.php');
include('functions/objects_and_tax.php');
include('functions/settings.php');
include('functions/utilities.php');
include('functions/thumbnails.php');

include('functions/vimeo_class.php');
include('functions/objects_class.php');





?>