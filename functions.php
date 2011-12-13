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

// inclou Funcions i Templates per als Comentaris
include(CoopTheme_PATH.'/php/web_comments.php');


// inclou favicon
function favicon_link() {
    echo '<link rel="shortcut icon" type="image/x-icon" href="'.CoopTheme_URL.'/favicon.ico" />' . "\n";
}
add_action('wp_head', 'favicon_link');


// inclou Coop Widgets
include(CoopTheme_PATH.'/php/web_widgets.php');


/**
 * Adds JavaScript and CSS to Front Page page template.
 */
function coop_front_page_template() {

    /* If we're not looking at the front page template, return. */
    if ( !is_page_template( 'tpl-home.php' ) )
        return;

    /* Load the jQuery Cycle plugin JavaScript and custom JavaScript for it. */
    wp_enqueue_script( 'slider', get_stylesheet_directory_uri() . '/js/jquery.cycle.js', array( 'jquery' ), 0.1, true );

    /* Load the front page stylesheet. */
    wp_enqueue_style( 'front-page', get_stylesheet_directory_uri() . '/css/tpl-home.css', false, '0.1', 'screen' );
}
add_action( 'template_redirect', 'coop_front_page_template' );

/**** END PERMANENTS ****/
add_theme_support('post-thumbnails'); // http://codex.wordpress.org/Post_Thumbnails
// set_post_thumbnail_size(150, 150, false);
add_theme_support( 'breadcrumb-trail' );
add_theme_support( 'loop-pagination' );
add_theme_support( 'get_the_image' );
//add_theme_support( 'the_ratings' );
add_theme_support( 'sidebarlogin' );

function extensions() {

        /* Load the Breadcrumb Trail extension if supported and the plugin isn't active. */
        if ( !function_exists( 'breadcrumb_trail' ) )
            require_if_theme_supports( 'breadcrumb-trail', CoopTheme_PATH . '/extensions/breadcrumb-trail/breadcrumb-trail.php' );
        
        if ( !function_exists( 'loop-pagination' ) )
            require_if_theme_supports( 'loop-pagination', CoopTheme_PATH . '/extensions/loop-pagination.php' );
        
        if ( !function_exists( 'get_the_image' ) )
            require_if_theme_supports( 'get_the_image', CoopTheme_PATH . '/extensions/get-the-image.php' );
        
        if ( !function_exists( 'the_ratings' ) )
            require_if_theme_supports( 'the_ratings', CoopTheme_PATH . '/extensions/wp-postratings/wp-postratings.php' );

        if ( !function_exists( 'sidebarlogin' ) )
            require_if_theme_supports( 'sidebarlogin', CoopTheme_PATH . '/extensions/sidebar-login/sidebar-login.php' );

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

function toolbox_content_nav( $nav_id ) {
    global $wp_query;

    ?>
    <nav id="<?php echo $nav_id; ?>">
        <h1 class="assistive-text section-heading"><?php _e( 'Post navigation', 'wp-coop' ); ?></h1>

    <?php if ( is_single() ) : // navigation links for single posts ?>
        
        <div class="pagination"><ul>
        <?php previous_post_link( '<li class="prev">%link</li>', '' . _x( '&larr;', 'Previous post link', 'toolbox' ) . ' %title' ); ?>
        <?php next_post_link( '<li class="next">%link</li>', '%title ' . _x( '&rarr;', 'Next post link', 'toolbox' ) . '' ); ?>

    <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

        <?php if ( get_next_posts_link() ) : ?>
        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'toolbox' ) ); ?></div>
        <?php endif; ?>

        <?php if ( get_previous_posts_link() ) : ?>
        <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'toolbox' ) ); ?></div>
        <?php endif; ?>

    <?php endif; ?>

    </nav><!-- #<?php echo $nav_id; ?> -->
    <?php
}
