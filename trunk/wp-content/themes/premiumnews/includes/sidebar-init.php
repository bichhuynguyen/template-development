<?php

// Register widgetized areas

function the_widgets_init() {
    if ( !function_exists('register_sidebars') )
        return;

if ( function_exists('register_sidebar') )
    register_sidebars(2,array(
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div><!--/widget-->',
        'before_title' => '<h2 class="hl">',
        'after_title' => '</h2>',
    ));
    
}

add_action( 'init', 'the_widgets_init' );


    
?>