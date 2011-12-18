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
