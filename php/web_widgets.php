<?php

// Widget que mosta la setmana actual
// [ Setmana:34 ]
function widget_num_setmana($args) {
    extract($args);
?>
        <?php echo $before_widget; ?>
            <?php echo $before_title
                . _('Setmana').': '.date('W')
                . $after_title; ?>
        <?php echo $after_widget; ?>
<?php
}
register_sidebar_widget(_('Num. de Setmana'), 'widget_num_setmana');


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
add_action( 'after_setup_theme', 'toolbox_setup' );

function toolbox_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar 1', 'toolbox' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	//per cada Rol creo un sidebar
	global $wp_roles;
	foreach ( $wp_roles->role_names as $role => $name ) :
		if($role!='administrator'):
			register_sidebar( array(
				'name' => __( 'Sidebar ' . $name , 'toolbox' ),
				'id' => 'sidebar-'  . $role,
				'description' => __( 'Lateral pel rol ' . $name, 'toolbox' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => "</aside>",
				'before_title' => '<h1 class="widget-title">',
				'after_title' => '</h1>',
			) );
		endif;
	endforeach;
	
	register_sidebar( array(
		'name' => __( 'Sidebar No Logejats', 'toolbox' ),
		'id' => 'sidebar-no_logged',
		'description' => __( 'Lateral pels No Logejats', 'toolbox' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'init', 'toolbox_widgets_init' );

