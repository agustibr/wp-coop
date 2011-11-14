<?php
/** wp-coop Functions.php **/
// Define paths
define('CoopTheme_PATH', dirname(__FILE__));
define('CoopTheme_URL', get_theme_root_uri() . '/wp-coop');
//


// incloure 1 cop per crear ROLS i PERMISOS
include(CoopTheme_PATH.'/php/user_roles.php');

/**** END TEMPORALS ****/



/*** INCLUDES PERMANENTS ***/

// camps dinfo per usuaris (UF, Coope desde, Menor d edat)
include(CoopTheme_PATH.'/php/user_contactmethods.php');

// S'encarrega de enviar 1 mail a la llista de mail quan hi ha un nou post
include(CoopTheme_PATH.'/php/user_notification.php');

// inclou js pel tema
include(CoopTheme_PATH.'/php/web_scripts.php');

// inclou Receptes
include(CoopTheme_PATH.'/php/web_cpt.php');


// inclou favicon
function favicon_link() {
    echo '<link rel="shortcut icon" type="image/x-icon" href="'.CoopTheme_URL.'/favicon.ico" />' . "\n";
}
add_action('wp_head', 'favicon_link');

function toolbox_setup() {
	load_theme_textdomain( 'toolbox', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Menu Public', 'wp-coop' ),
		'ruscaire' => __( 'Menu Ruscaires', 'wp-coop' ),
		'proveidor_arc' => __( 'Menu Arc Natura', 'wp-coop' ),
	) );

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'gallery' ) );//'aside', 'image', 
}

// inclou Coop Widgets
//include(CoopTheme_PATH.'/php/web_widgets.php');


/**** END PERMANENTS ****/

/****** INCLUDES TEMPORALS PER MODIFICAR CONFIGURACIONS **/


/*
// WP PERFONMANCE
// Display DB Queries, Time Spent and Memory Consumption
function performance( $visible = true ) {

    $stat = sprintf(  '%d queries in %.3f seconds, using %.2fMB memory',
        get_num_queries(),
        timer_stop( 0, 3 ),
        memory_get_peak_usage() / 1024 / 1024
        );

    echo $visible ? $stat : "<!-- {$stat} -->" ;
}
//(make sure your theme is calling wp_footer):
add_action( 'wp_footer', 'performance', 20 );
*/



