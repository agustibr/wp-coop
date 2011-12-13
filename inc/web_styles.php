<?php
add_action('wp_print_styles', 'add_wpCoop_stylesheet');
/*
* Enqueue style-file, if it exists.
*/
function add_wpCoop_stylesheet() {
	$myStyleUrl = CoopTheme_URL . '/css/wpcoop.css';
        $myStyleFile = RUSCPLUGIN_URL . '/css/wpcoop.css';
        if ( file_exists($myStyleFile) ) {
            wp_register_style('wpCoopSheets', $myStyleUrl);
            wp_enqueue_style( 'wpCoopSheets');
        }
    }
