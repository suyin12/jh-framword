<?php

// Register widgetized areas

function the_widgets_init() {
    if ( !function_exists('register_sidebars') )
        return;

    register_sidebar(array('name' => 'Sidebar','id' => 'sidebar-1','before_widget' => '<div id="%1$s" class="block widget %2$s">','after_widget' => '</div>','before_title' => '<h2>','after_title' => '</h2>'));
    
}

add_action( 'init', 'the_widgets_init' );


    
?>