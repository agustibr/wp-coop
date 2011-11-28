<?php
/**
Change URL Slug from Author to Cens
abans 		=>	domini.cat/author
despres 	=>	domini.cat/cens
**/
function new_author_base() {
    global $wp_rewrite;
    $author_slug = 'cens';
    $wp_rewrite->author_base = $author_slug;
}
add_action('init', 'new_author_base');


/**
Funcio que dona capabilitats dinamicament segons si ets autor
i tens la capabilitat plural.
Si tens : 'edit_pages'  => true i ets l'autor
i ets   : post_author asigna 'edit_page' => true
**/
add_filter( 'map_meta_cap', 'coop_map_meta_cap', 10, 4 );

function coop_map_meta_cap( $caps, $cap, $user_id, $args ) {
    $the_post_type = get_post_type( $args[0] );
    /* If editing, deleting, or reading a custom post type, get the post and post type object. */
    if ( 'edit_'.$the_post_type == $cap || 'delete_'.$the_post_type == $cap || 'read_'.$the_post_type == $cap ) {
        $post = get_post( $args[0] );
        $post_type = get_post_type_object( $post->post_type );

        /* Set an empty array for the caps. */
        $caps = array();
    }

    /* If editing a custom post type, assign the required capability. */
    if ( 'edit_'.$the_post_type == $cap ) {
        if ( $user_id == $post->post_author )
            $caps[] = $post_type->cap->edit_posts;
        else
            $caps[] = $post_type->cap->edit_others_posts;
    }

    /* If deleting a custom post type, assign the required capability. */
    elseif ( 'delete_'.$the_post_type == $cap ) {
        if ( $user_id == $post->post_author )
            $caps[] = $post_type->cap->delete_posts;
        else
            $caps[] = $post_type->cap->delete_others_posts;
    }

    /* If reading a private custom post type, assign the required capability. */
    elseif ( 'read_'.$the_post_type == $cap ) {

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


/**
New Roles and Capabilities - Only run once!

I keep these handy, this is the right way to do them without a plugin. They set a single field (prefix_user_roles) in the options database, and you don't need a plugin to set them. Refer to the Codex page for a list of what capabilities are available and descriptions for what they do. You only need to uncomment one of these blocks, load any page and then comment them again! Here I'm creating a role that's got the capabilities I need:

@link: http://www.garyc40.com/2010/04/ultimate-guide-to-roles-and-capabilities/
**/

/*

remove_role('ruscaire');
add_role('ruscaire', 'Ruscaire', array(
    
    'read' => true, // True allows that capability, False specifically removes it.
    'publish_posts' => true,
    'edit_posts' => true,
    'delete_posts' => true,
    'edit_published_posts' => true,
    'read_private_posts' => true,

    //'publish_pages' => true,
    //'edit_pages' => true,
    //'delete_pages' => true,
    'read_private_pages' => true,

	'read_cistelles' => true,
	'publish_cistelles' => true,
	'edit_cistelles' => true,
	'edit_others_cistelles' => false,
	'delete_cistelles' => true,
	'delete_others_cistelles' => true,
	'read_private_cistelles' => true,
	'edit_published_cistelles' => true,

	'read_receptes' => true,
	'publish_receptes' => true,
	'edit_receptes' => true,
	'edit_others_receptes' => false,
	'delete_receptes' => true,
	'delete_others_receptes' => true,
	'read_private_receptes' => true,
	'edit_published_receptes' => true,
	    
    'edit_files' => true,
    'import' => false,
    'upload_files' => true,

));

//remove_role('proveidor-arc_natura');
add_role('proveidor-arc_natura', 'Proveidor - Arc de la Natura', array(
	
	'read' => true,
	
	'publish_receptes' => true,
	'edit_receptes' => true,

	'publish_cistelles' => true,
	'edit_cistelles' => true,
	'delete_cistelles' => true,
	'read_private_cistelles' => true,
	'read_cistelles' => true,
	'edit_published_cistelles' => true,
));


//remove_role('exruscaire');
add_role('exruscaire', 'Exruscaire', array(

    'read' => true,

    'publish_receptes' => true,
	'edit_receptes' => true,

));

//remove_role('espera');
add_role('espera', 'En llista Espera', array(
    'read' => true
));

*/
/**
add to admin caps for managing cpt !
$edit_role = get_role('administrator');
$edit_role->add_cap('publish_receptes');
$edit_role->add_cap('edit_receptes');
$edit_role->add_cap('edit_others_receptes');
**/
/** To remove one outright or remove one of the defaults: **/
//	remove_role('editor');
//	remove_role('author');
//	remove_role('contributor');


/**
It's sometimes handy to add/remove from an existing role rather than removing and re-adding one. Again, you only need to uncomment it, reload a page and then comment it again. This will store the role/capability properly in the options table. (This allows you, the developer to control them and removes the overhead of the bulky plugins that do the same thing.) Here I'm changing the author role to delete their published posts (the default), but allowing them the capability to edit their published posts (which isn't possible for this role by default)-- using *add_cap* or *remove_cap*.
**/
$edit_role = get_role('administrator');			// Select Role to edit
$edit_role->add_cap('publish_receptes');		// Add capability 
$edit_role->add_cap('edit_receptes');        // Add capability 
//	$edit_role->remove_cap('delete_cistella');	// Remove capability