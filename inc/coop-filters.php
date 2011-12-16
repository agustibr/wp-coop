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
