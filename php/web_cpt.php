<?php


add_action('init', 'codex_custom_init');
function codex_custom_init() 
{
  $labels_recepta = array(
    'name' => _x('Receptes', 'post type general name'),
    'singular_name' => _x('Recepta', 'post type singular name'),
    'add_new' => _x('Afegir nova', 'recepta'),
    'add_new_item' => __('Afegir nova Recepta'),
    'edit_item' => __('Editar Recepta'),
    'new_item' => __('Nova Recepta'),
    'all_items' => __('Totes les Receptes'),
    'view_item' => __('Veure Recepta'),
    'search_items' => __('Cercar Receptes'),
    'not_found' =>  __('No s\'han trobat Receptes '),
    'not_found_in_trash' => __('No hi ha Receptes a la paperera'), 
    'parent_item_colon' => '',
    'menu_name' => 'Receptes'

  );
  $args_recepta = array(
    'labels' => $labels_recepta,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'receptes' ),
    'map_meta_cap'    =>  true,
    //'capability_type' => 'recepta',
    /*'capabilities' => array(
				'publish_posts' => 'publish_receptes',
				'edit_posts' => 'edit_receptes',
				'edit_others_posts' => 'edit_others_receptes',
				'delete_posts' => 'delete_receptes',
				'delete_others_posts' => 'delete_others_receptes',
				'read_private_posts' => 'read_private_receptes',
				'edit_post' => 'edit_recepta',
				'delete_post' => 'delete_recepta',
				'read_post' => 'read_recepta',
			),*/
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 4,
    'menu_icon'       =>  'http://elrusc.org/wp-content/icons/recepta_16.png',
    'supports' => array('title','editor','author','comments')
  ); 
  register_post_type('recepta',$args_recepta);

	$labels_cistella = array(
    'name' => _x('Cistelles', 'post type general name'),
    'singular_name' => _x('Cistella', 'post type singular name'),
    'add_new' => _x('Afegir nova', 'cistella'),
    'add_new_item' => __('Afegir nova Cistella'),
    'edit_item' => __('Editar Cistella'),
    'new_item' => __('Nova Cistella'),
    'all_items' => __('Totes les Cistella'),
    'view_item' => __('Veure Cistella'),
    'search_items' => __('Cercar Cistelles'),
    'not_found' =>  __('No s\'han trobat Cistelles '),
    'not_found_in_trash' => __('No hi ha Cistelles a la paperera'), 
    'parent_item_colon' => '',
    'menu_name' => 'Cistelles'

  );
  $args_cistella = array(
    'labels' => $labels_cistella,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'cistelles' ),
    'map_meta_cap'    =>  true,
    'capability_type' => array( 'cistella','cistelles'),
	//'capability_type' =>  'cistella',
    /*'capabilities' => array(
				'publish_posts' => 'publish_cistelles',
				'edit_posts' => 'edit_cistelles',
				'edit_others_posts' => 'edit_others_cistelles',
				'delete_posts' => 'delete_cistelles',
				'delete_others_posts' => 'delete_others_cistelles',
				'read' => 'read_cistelles',
				'read_private_posts' => 'read_private_cistelles',
				/*'edit_post' => 'edit_cistella',
				'delete_post' => 'delete_cistella',
				'read_post' => 'read_cistella',*/
		/*	),*/
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 4,
    'menu_icon'       =>  'http://elrusc.org/wp-content/icons/document_16.png',
    'supports' => array('title','editor','author','comments')
  ); 
  register_post_type('cistella',$args_cistella);
}

//add filter to ensure the text Recepta, or recepta, is displayed when user updates a recepta 
add_filter('post_updated_messages', 'codex_cpt_updated_messages');
function codex_cpt_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['recepta'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Recepta actualitzada. <a href="%s">Veure Recepta</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Recepta actualitzada.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Recepta restaurada to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Recepta publicada. <a href="%s">Veure recepta</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Recepta desada.'),
    8 => sprintf( __('Recepta enviada. <a target="_blank" href="%s">Previsualitza la Recepta</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Recepta programada per: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Previsualitza la Recepta</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Borrador de la Recepta actualitzat. <a target="_blank" href="%s">Previsualitza la Recepta</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

$messages['cistella'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Cistella actualitzada. <a href="%s">Veure Cistella</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Cistella actualitzada.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Cistella restaurada to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Cistella publicada. <a href="%s">Veure Cistella</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Cistela desada.'),
    8 => sprintf( __('Cistela enviada. <a target="_blank" href="%s">Previsualitza la Cistela</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Cistela programada per: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Previsualitza la Cistela</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Borrador de la Cistela actualitzat. <a target="_blank" href="%s">Previsualitza la Cistela</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}


//hook into the init action and call create_receptes_taxonomies when it fires
//$ingredients_rebost="";
add_action( 'init', 'create_recepta_taxonomies', 0 );
//add_action( 'init', 'get_recepta_rebost',1);
function get_recepta_rebost(){
 // $ingredients_rebost = get_terms('rebost', array('hide_empty' => false));
}
//create  taxonomies, for the post type "recepta"
function create_recepta_taxonomies() 
{
  // Add new taxonomy
  $labels = array(
    'name' => _x( 'Rebost', 'taxonomy general name' ),
    'singular_name' => _x( 'Ingredient', 'taxonomy singular name' ),
    'search_items' =>  __( 'Cercar Ingredients' ),
    'all_items' => __( 'Rebost' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar Ingredient' ), 
    'update_item' => __( 'Actualitzar Ingredient' ),
    'add_new_item' => __( 'Afegir Ingredient' ),
    'new_item_name' => __( 'Nom de l\'ingredient' ),
    'menu_name' => __( 'Rebost' ),
  ); 	

  register_taxonomy('rebost',array('recepta'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'rebost' ),
  ));
}



add_filter( 'map_meta_cap', 'coop_map_meta_cap', 10, 4 );

function coop_map_meta_cap( $caps, $cap, $user_id, $args ) {
//echo 'coop_map_meta_cap';
	/* If editing, deleting, or reading a movie, get the post and post type object. */
	if ( 'edit_cistella' == $cap || 'delete_cistella' == $cap || 'read_cistella' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a movie, assign the required capability. */
	if ( 'edit_cistella' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a movie, assign the required capability. */
	elseif ( 'delete_cistella' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private movie, assign the required capability. */
	elseif ( 'read_cistella' == $cap ) {

		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}