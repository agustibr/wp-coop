<?php
/**
EMAILS
**/
function authorNotification1($post_id) {
    global $wpdb;
    $post = get_post($post_id);
    $author = get_userdata($post->post_author);

    $message = "
    Hi ".$author->display_name.",
    Your post, ".$post->post_title." has just been published. Well done!
    ";
    $email = 'itsuga@agusti.cat'; //$author->user_email
    wp_mail($email, "Your article is online", $message);
}
add_action('publish_post', 'authorNotification1');

function email_friends( $post_ID )
{
   $friends = 'itsuga@agusti.cat';
   wp_mail( $friends, "Comment blog updated", 'I just put something on my blog: http://blog.example.com' );

   return $post_ID;
}
add_action('comment_post', 'email_friends');

/**
Disable RSS
**/
function wp_disable_feed() {
   wp_die( __('Sorry, no feeds available, return to <a href="'. get_bloginfo('url') .'">homepage</a>') );
}

add_action('do_feed', 'wp_disable_feed', 1);
add_action('do_feed_rdf', 'wp_disable_feed', 1);
add_action('do_feed_rss', 'wp_disable_feed', 1);
add_action('do_feed_rss2', 'wp_disable_feed', 1);
add_action('do_feed_atom', 'wp_disable_feed', 1);

// inclou favicon
function favicon_link() {
    echo '<link rel="shortcut icon" type="image/x-icon" href="'.CoopTheme_URL.'/favicon.ico" />' . "\n";
}
add_action('wp_head', 'favicon_link');

/**
Change URL Slug from Author to Cens
abans       =>  domini.cat/author
despres     =>  domini.cat/cens
**/
function new_author_base() {
    global $wp_rewrite;
    $author_slug = 'cens';
    $wp_rewrite->author_base = $author_slug;
}
add_action('init', 'new_author_base');

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

/*
* Enqueue style-file, if it exists.

add_action('wp_print_styles', 'add_wpCoop_stylesheet');
function add_wpCoop_stylesheet() {
    $myStyleUrl = CoopTheme_URL . '/css/wpcoop.css';
    $myStyleFile = RUSCPLUGIN_URL . '/css/wpcoop.css';
    if ( file_exists($myStyleFile) ) {
        wp_register_style('wpCoopSheets', $myStyleUrl);
        wp_enqueue_style( 'wpCoopSheets');
    }
}
*/

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
