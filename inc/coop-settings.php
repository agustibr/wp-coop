<?php
/**
Theme settings
**/
// Define paths
define('CoopTheme_URL', get_theme_root_uri() . '/wp-coop');
//
define('WP_POST_REVISIONS', 5); // 2 post revisions
define('EMPTY_TRASH_DAYS', 5 ); // Empty trash every 2 days

if(!current_user_can('administrator'))
	add_filter( 'show_admin_bar', '__return_false' ); // hide admin bar (frontend)

/**
 * Theme support
 **/

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
