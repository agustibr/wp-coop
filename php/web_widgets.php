<?php

// Widget que mosta la setmana actual
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

// esborrem configuracions del tema pare (toolbox)
function remove_toolbox_setup(){
	//unregister_sidebar( 'sidebar-1' );
	unregister_sidebar( 'sidebar-2' );
	remove_theme_support( 'post-formats');
	remove_theme_support( 'automatic-feed-links'); 
}
add_action( 'init', 'remove_toolbox_setup', 11);

// creem configuracions del tema (menus, sidebars...)
function coop_setup() {

	register_nav_menus( array(
		'primary' => __( 'Menú Public', 'wp-coop' ),
		'ruscaire' => __( 'Menú Ruscaires', 'wp-coop' ),
		'proveidor_arc' => __( 'Menú Arc Natura', 'wp-coop' ),
	) );


	register_sidebar( array(
		'name' => __( 'Sidebar 1', 'wp-coop' ),
		'id' => 'sidebar-1',
		'description' => __( 'Lateral sempre present', 'wp-coop' ),
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
				'name' => __( 'Sidebar ' . $name , 'wp-coop' ),
				'id' => 'sidebar-'  . $role,
				'description' => __( 'Lateral pel rol ' . $name, 'wp-coop' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => "</aside>",
				'before_title' => '<h1 class="widget-title">',
				'after_title' => '</h1>',
			) );
		endif;
	endforeach;
	
	register_sidebar( array(
		'name' => __( 'Sidebar No Logejats', 'wp-coop' ),
		'id' => 'sidebar-no_logged',
		'description' => __( 'Lateral pels No Logejats', 'wp-coop' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

}
add_action( 'after_setup_theme', 'coop_setup' );