<?php
/** wp-coop Functions.php **/
define('CoopTheme_PATH', dirname(__FILE__));

require_once locate_template('inc/coop-settings.php'); // Configuracio i Definicio de variables globals del Wp
require_once locate_template('inc/coop-activation.php');  // activation

// camps dinfo per usuaris (UF, Coope desde, Menor d edat)
require_once locate_template('inc/coop-userinfo.php');

// S'encarrega de enviar 1 mail a la llista de mail quan hi ha un nou post
require_once locate_template('inc/coop-notifications.php');

// inclou accions (js, css, favicon)
require_once locate_template('inc/coop-actions.php');

// inclou filtres (protected form)
require_once locate_template('inc/coop-filters.php');

// inclou Custom Post types i Taxonomies
require_once locate_template('inc/coop-cpt.php');

// inclou Funcions i Templates per als Comentaris
require_once locate_template('inc/coop-comments.php');

// inclou Coop Widgets
require_once locate_template('inc/coop-widgets.php');


/**** END INCLUDES ****/

function toolbox_content_nav( $nav_id ) {
    // funcio pont per plantilles del tema pare
    coop_content_nav( $nav_id );
}

function coop_content_nav( $nav_id ) {
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

function coop_btn_publish_new( $post_type ) {
    $post_type_obj = get_post_type_object( $post_type );
    $cap_publish = $post_type_obj->cap->publish_posts;
    $lbl_singular = $post_type_obj->labels->singular_name;
    if( current_user_can( $cap_publish ) ) echo '<a href="'.get_bloginfo('url').'/wp-admin/post-new.php?post_type='.$post_type.'" class="btn small success">+ '.__('Afegir', 'wp-coop').' '.$lbl_singular.'</a>';
}

function coop_user_can_read ( $post_type ) {
    switch ($post_type) {
        case 'post':
        case 'recepta':
            return true;
            break;

        default:
            $post_type_obj = get_post_type_object( $post_type );
            $cap_read = $post_type_obj->cap->read_posts;
            if( current_user_can( $cap_read ) ) return true;
            break;
    }
}


function print_roles (){
    global $wp_post_types, $wp_roles;
//print '--<pre>';print_r( $wp_post_types );print '</pre>--';
// Tons of information about all the different post types on the site
//Paste anywhere on a theme template file outside the loop.
?>

<?php  echo '<br /><br /><h3>Roles</h3>';
    foreach ( $wp_roles->role_names as $role => $name ) :
        echo '<br /> <br />';
        echo '<pre> Role displayed in Admin as ' . $name ;
        echo  '     Database entry: '  . $role . '</pre>';

        echo '<h5> Capabilities assigned to the role of ' . $name. '</h5>';
        // print_r( $caps);
        echo '<pre>';
        $rolename = get_role($role);
        $caps = $rolename->capabilities;
            foreach ($caps as $capability => $value):
                echo  $capability . ' '.  $value . "\n" ;
            endforeach;
        echo '</pre>';
    endforeach;

//Show the role display name and the name used in the database for each role on the site.
//Show the capabilities assigned to that role
//Paste anywhere on a theme template file outside the loop.
//Thanks to Greenshady: http://wordpress.org/support/topic/get-a-users-role-by-user-id
// Thanks to:  http://sillybean.net/wordpress/creating-roles/
}


function pre($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
