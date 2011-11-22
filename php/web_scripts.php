<?php
//add js 
function my_scripts_method_1() {
    //wp_deregister_script( 'jquery' );
    //wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}    
add_action('wp_enqueue_scripts', 'my_scripts_method_1');

function my_scripts_method_2() {
    wp_register_script( 'bootstrap-tabs', CoopTheme_URL.'/js/bootstrap-tabs.js');
    wp_enqueue_script( 'bootstrap-tabs' );
}   
add_action('wp_enqueue_scripts', 'my_scripts_method_2');

function my_scripts_method_3() {
    wp_register_script( 'tablesorter', CoopTheme_URL.'/js/jquery.tablesorter.min.js');
    wp_enqueue_script( 'tablesorter' );
}   
add_action('wp_enqueue_scripts', 'my_scripts_method_3');

function my_scripts_method_4() {
    wp_register_script( 'my_script', CoopTheme_URL.'/js/my-script.js');
    wp_enqueue_script( 'my_script' );
}   
add_action('wp_enqueue_scripts', 'my_scripts_method_4');

// add ie conditional html5 shim to header
function add_ie_html5_shim () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_html5_shim');

