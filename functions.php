<?php
/** wp-coop Functions.php **/
// Define paths
define('CoopTheme_PATH', dirname(__FILE__));
define('CoopTheme_URL', get_theme_root_uri() . '/wp-coop');
//
define('WP_POST_REVISIONS', 5); // 2 post revisions
define('EMPTY_TRASH_DAYS', 5 ); // Empty trash every 2 days
//add_filter( 'show_admin_bar', '__return_false' ); // hide admin bar (frontend)

/****** INCLUDES TEMPORALS PER MODIFICAR CONFIGURACIONS **/

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

// inclou Custom Post types i Taxonomies
include(CoopTheme_PATH.'/php/web_cpt.php');


// inclou favicon
function favicon_link() {
    echo '<link rel="shortcut icon" type="image/x-icon" href="'.CoopTheme_URL.'/favicon.ico" />' . "\n";
}
add_action('wp_head', 'favicon_link');


// inclou Coop Widgets
include(CoopTheme_PATH.'/php/web_widgets.php');


/**** END PERMANENTS ****/
add_theme_support( 'breadcrumb-trail' );
add_theme_support( 'loop-pagination' );
function extensions() {

        /* Load the Breadcrumb Trail extension if supported and the plugin isn't active. */
        if ( !function_exists( 'breadcrumb_trail' ) )
            require_if_theme_supports( 'breadcrumb-trail', CoopTheme_PATH . '/extensions/breadcrumb-trail/breadcrumb-trail.php' );
        
        if ( !function_exists( 'loop-pagination' ) )
            require_if_theme_supports( 'loop-pagination', CoopTheme_PATH . '/extensions/loop-pagination.php' );
}
extensions();
// Remove Private and Protected Prefix. This function removes the "Privite:" prefix from posts and pages marked private.
function the_title_trim($title) {
$title = attribute_escape($title);
$findthese = array(
    '#Protected:#',
    '#Privat:#'
);
$replacewith = array(
    '', // What to replace "Protected:" with
    '' // What to replace "Private:" with
);
$title = preg_replace($findthese, $replacewith, $title);
return $title;
}
add_filter('the_title', 'the_title_trim');
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



