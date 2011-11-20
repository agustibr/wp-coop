<?php
/**
 * Template Name: Pagina Registre Llista Espera
 *
 * @subpackage wp-Coop
 */
 
/* Load registration file. */
require_once( ABSPATH . WPINC . '/registration.php' );
 
/* Check if users can register. */
$registration = get_option( 'users_can_register' );
 
/* If user registered, input info. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'adduser' ) {
	//$user_pass = wp_generate_password();
	$userdata = array(
		'user_pass' => esc_attr( $_POST['user_pass'] ),
		'user_login' => esc_attr( $_POST['user_name'] ),
		'first_name' => esc_attr( $_POST['first_name'] ),
		'last_name' => esc_attr( $_POST['last_name'] ),
		'nickname' => esc_attr( $_POST['nickname'] ),
		'user_email' => esc_attr( $_POST['email'] ),
		'user_url' => esc_attr( $_POST['website'] ),
		'telefon' => esc_attr( $_POST['telefon'] ),
		'address' => esc_attr( $_POST['address'] ),
		'description' => esc_attr( $_POST['description'] ),
		//'role' => get_option( 'default_role' ),
		'role' => 'espera',
	);
 
	if ( !$userdata['user_login'] )
		$error = __('A username is required for registration.', 'wp-coop');
	elseif ( username_exists($userdata['user_login']) )
		$error = __('Sorry, that username already exists!', 'wp-coop');

	if ( !$userdata['user_pass'] )
		$error = __('A Password is required for registration.', 'wp-coop');
	
	elseif ( !is_email($userdata['user_email'], true) )
		$error = __('You must enter a valid email address.', 'wp-coop');
	elseif ( email_exists($userdata['user_email']) )
		$error = __('Sorry, that email address is already used!', 'wp-coop');
 
	else{
		$new_user = wp_insert_user( $userdata );
	}
}
 
 
 
   get_header(); ?>

		<div id="primary">
			<div id="content" role="main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						
						<!-- REGISTER FORM STARTS HERE -->
 
						<?php if ( is_user_logged_in() && !current_user_can( 'create_users' ) ) : ?>
 
							<p class="log-in-out alert">
							<?php printf( __('You are logged in as <a href="%1$s" title="%2$s">%2$s</a>.  You don\'t need another account.', 'wp-coop'), get_author_posts_url( $curauth->ID ), $user_identity ); ?> <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php _e('Log out of this account', 'wp-coop'); ?>"><?php _e('Logout &raquo;', 'wp-coop'); ?></a>
							</p><!-- .log-in-out .alert -->
	 
							<?php elseif ( $new_user ) : ?>
	 
							<p class="alert">
							<?php
							if ( current_user_can( 'create_users' ) )
								printf( __('A user account for %1$s has been created.', 'wp-coop'), $_POST['user-name'] );
							else 
								printf( __('Thank you for registering, %1$s.', 'wp-coop'), $_POST['user-name'] );
								printf( __('<br/>Please check your email address. That\'s where you\'ll recieve your login password.<br/> (It might go into your spam folder)', 'wp-coop') );
							?>
							</p><!-- .alert -->
						<?php else : ?>
						<?php if ( $error ) : ?>
							<p class="error">
							<?php echo $error; ?>
							</p><!-- .error -->
						<?php endif; ?>
 
						<?php if ( current_user_can( 'create_users' ) && $registration ) : ?>
							<p class="alert">
								<?php _e('Users can register themselves or you can manually create users here.', 'wp-coop'); ?>
							</p><!-- .alert -->
						<?php elseif ( current_user_can( 'create_users' ) ) : ?>
							<p class="alert">
								<?php _e('Users cannot currently register themselves, but you can manually create users here.', 'wp-coop'); ?>
							</p><!-- .alert -->
						<?php endif; ?>
 
						<?php if ( $registration || current_user_can( 'create_users' ) ) : ?>
 
							<form method="post" id="adduser" class="user-forms" action="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
								<strong>Name</strong>
				 
								<p class="form-username">
									<label for="user_name"><?php _e('Username (required)', 'wp-coop'); ?></label>
									<input class="text-input" name="user_name" type="text" id="user_name" value="<?php if ( $error ) echo wp_specialchars( $_POST['user_name'], 1 ); ?>" />
								</p><!-- .form-username -->
				 
								<p class="first_name">
									<label for="first_name"><?php _e('First Name', 'wp-coop'); ?></label>
									<input class="text-input" name="first_name" type="text" id="first_name" value="<?php if ( $error ) echo wp_specialchars( $_POST['first_name'], 1 ); ?>" />
								</p><!-- .first_name -->
				 
								<p class="last_name">
									<label for="last_name"><?php _e('Last Name', 'wp-coop'); ?></label>
									<input class="text-input" name="last_name" type="text" id="last_name" value="<?php if ( $error ) echo wp_specialchars( $_POST['last_name'], 1 ); ?>" />
								</p><!-- .last_name -->
				 
								<p class="nickname">
									<label for="nickname"><?php _e('Nickname', 'wp-coop'); ?></label>
									<input class="text-input" name="nickname" type="text" id="nickname" value="<?php if ( $error ) echo wp_specialchars( $_POST['nickname'], 1 ); ?>" />
								</p><!-- .nickname -->

								<p class="user_pass">
									<label for="user_pass"><?php _e('Clau d\'accés (required)', 'wp-coop'); ?></label>
									<input class="text-input" name="user_pass" type="password" id="user_pass" value="<?php if ( $error ) echo wp_specialchars( $_POST['user_pass'], 1 ); ?>" />
								</p><!-- .user_pass -->

								<strong>Contact Info</strong>
				 
								<p class="form-email">
									<label for="email"><?php _e('E-mail (required)', 'wp-coop'); ?></label>
									<input class="text-input" name="email" type="text" id="email" value="<?php if ( $error ) echo wp_specialchars( $_POST['email'], 1 ); ?>" />
								</p><!-- .form-email -->
				 
								<p class="form-website">
									<label for="website"><?php _e('Website', 'wp-coop'); ?></label>
									<input class="text-input" name="website" type="text" id="website" value="<?php if ( $error ) echo wp_specialchars( $_POST['website'], 1 ); ?>" />
								</p><!-- .form-website -->
				 
								<p class="form-telefon">
									<label for="telefon"><?php _e('Telèfon', 'wp-coop'); ?></label>
									<input class="text-input" name="telefon" type="text" id="telefon" value="<?php if ( $error ) echo wp_specialchars( $_POST['telefon'], 1 ); ?>" />
								</p><!-- .form-telefon -->
				 
								<p class="form-address">
									<label for="address"><?php _e('Adreça', 'wp-coop'); ?></label>
									<input class="text-input" name="address" type="text" id="address" value="<?php if ( $error ) echo wp_specialchars( $_POST['address'], 1 ); ?>" />
								</p><!-- .form-address -->

								<strong>About Yourself</strong>
				 
								<p class="form-description">
									<label for="description"><?php _e('Biographical Info', 'wp-coop'); ?></label>
									<textarea class="text-input" name="description" id="description" rows="5" cols="30"><?php if ( $error ) echo wp_specialchars( $_POST['description'], 1 ); ?></textarea>
								</p><!-- .form-description -->
				 
								<p class="form-submit">
									<?php echo $referer; ?>
									<input name="adduser" type="submit" id="addusersub" class="submit button" value="<?php if ( current_user_can( 'create_users' ) ) _e('Add User', 'wp-coop'); else _e('Register', 'wp-coop'); ?>" />
									<?php wp_nonce_field( 'add-user' ) ?>
									<input name="action" type="hidden" id="action" value="adduser" />
								</p><!-- .form-submit -->
							</form><!-- #adduser -->

						<?php endif; ?>
 
						<?php endif; ?>
 
						<!-- REGISTER FORM ENDS HERE -->
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'toolbox' ), 'after' => '</div>' ) ); ?>
						<?php//edit_post_link( __( 'Edit', 'toolbox' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>