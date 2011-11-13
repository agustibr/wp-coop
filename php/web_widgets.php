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


// Zones de wp_nav_menu()
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	unregister_nav_menu('primary');
	register_nav_menus(
		array( 'primary-menu' => __( 'Menu Principal' ), 'logged-in-menu' => __( 'Menu per Ruscaires' ), 'logged-out-menu' => __( 'Menu no logejats' )	)
	);
}

// Zones de dynamic_sidebar()
function remove_some_widgets(){

	// Unregsiter some of the TwentyTen sidebars
	//unregister_sidebar( 'sidebar' );
	//unregister_sidebar('sidebar-1');
	//unregister_sidebar('1');

}
add_action( 'widgets_init', 'remove_some_widgets', 11 );
function coop_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Lateral de Pàgina [zona 1]' ),
		'id' => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Lateral de Pàgina [zona 2]' ),
		'id' => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside><span class="clear"></span>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Peu de Pàgina 1', 'wp-coop' ),
		'id' => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s grid_4">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Peu de Pàgina 2', 'wp-coop' ),
		'id' => 'footer-2',
		'description' => __( 'An optional footer area', 'wp-coop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s grid_4">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Peu de Pàgina 3', 'wp-coop' ),
		'id' => 'footer-3',
		'description' => __( 'An optional footer area', 'wp-coop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s grid_4">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'init', 'coop_widgets_init' , 10);

