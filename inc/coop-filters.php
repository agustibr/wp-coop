<?php
// Remove Private and Protected Prefix. This function removes the "Privite:" prefix from posts and pages marked private.
add_filter('the_title', 'the_title_trim');
function the_title_trim($title) {
	$title = attribute_escape($title);
	$findthese = array(
    	'#Protegit:#',
    	'#Privat:#'
	);
	$replacewith = array(
    	'<span class="icon-lock"></span>', // What to replace "Protected:" with
    	'' // What to replace "Private:" with
	);
	$title = preg_replace($findthese, $replacewith, $title);
	return $title;
}

/**
 * Retrieve protected post password form content.
 */
add_filter( 'the_password_form', 'custom_password_form' );
function custom_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $output = '
    <form class="protected-post-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post">
        <fieldset>
            <legend>' . __( "Aquesta entrada està protegida.", "wp-coop" ) . '</legend>
            <div class="clearfix">
                <label for="' . $label . '"><br/><br/>' . __( "Password:" ) . ' </label>
                <div class="input">
                    <span class="help-block">' . __( "Per veure-la, introduïu la vostra contrasenya:", "wp-coop" ) . '</span>
                    <input name="post_password" id="' . $label . '" type="password" size="20" />
                </div>
                <div class="actions">
                    <input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" class="btn primary"/>
                </div>
            </div>
        </fieldset>
    </form>
    ';
    return $output;
}

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
