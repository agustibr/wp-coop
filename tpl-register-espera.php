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
		'user_login' => esc_attr( $_POST['user_login'] ),
		'first_name' => esc_attr( $_POST['first_name'] ),
		'last_name' => esc_attr( $_POST['last_name'] ),
		'nickname' => esc_attr( $_POST['nickname'] ),
		'user_email' => esc_attr( $_POST['email'] ),
		'user_url' => esc_attr( $_POST['website'] ),
		'telefon' => esc_attr( $_POST['telefon'] ),
		'address' => esc_attr( $_POST['address'] ),
		'description' => esc_attr( $_POST['description'] ),
		'role' => 'espera', //get_option( 'default_role' ),
	);

	if ( $userdata['user_login'] =="" ) {
		$error = __('<strong>Falta el nom d\'usuari</strong>, és necessari pel registre', 'wp-coop');
		$error_user_login = true;
	}

	elseif ( username_exists($userdata['user_login']) ) {
		$error = __('Ups, Aquest <strong>nom d\'usuari ja existeix!</strong> Si us plau tria un altre.', 'wp-coop');
		$error_user_login = true;
	}

	if ( !$userdata['user_pass'] ) {
		$error = __('<strong>Falta la contrasenya</strong>, és necessària pel registre.', 'wp-coop');
		$error_user_pass = true;
	}

	elseif ( !is_email($userdata['user_email'], true) ) {
		$error = __('L\'adreça de correu electrònic no és vàlida', 'wp-coop');
		$error_user_email = true;
	}
	elseif ( email_exists($userdata['user_email']) ) {
		$error = __('Ups, Aquest <strong>correu electrònic ja existeix!</strong> Si us plau tria un altre.', 'wp-coop');
		$error_user_email = true;
	}

	else{
		$new_user = wp_insert_user( $userdata );
		//wp_new_user_notification($new_user, $user_pass);

 		update_usermeta( $new_user, 'uf', $_POST['uf'] );
  		update_usermeta( $new_user, 'coope_desde', $_POST['coope_desde'] );
  		update_usermeta( $new_user, 'es_menor', $_POST['es_menor'] );
  		update_usermeta( $new_user, 'claus_local', $_POST['claus_local'] );
	}
}

   get_header(); ?>
   <?php get_sidebar('page'); ?>
		<div id="primary" class="grid_12">
			<div id="content" role="main">

				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">
						<?php  if ( !post_password_required() ) : ?>

							<?php while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; // end of the loop. ?>

						<!-- REGISTER FORM STARTS HERE -->

						 <?php if ( is_user_logged_in() && !current_user_can( 'create_users' ) ) : ?>



							<div class="alert-message block-message warning">
							<?php printf( __('Estas logejat com a <a href="%1$s" title="%2$s">%2$s</a>.  No necessites un altre usuari.', 'wp-coop'), get_author_posts_url( $curauth->ID ), $user_identity ); ?> <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php _e('Sortir d\'aquesta sessió', 'wp-coop'); ?>"><?php _e('Sortir &raquo;', 'wp-coop'); ?></a>
							</div><!-- .warning -->

							<?php elseif ( $new_user ) : ?>

							<div class="alert-message block-message success">
							<?php
							if ( current_user_can( 'create_users' ) )
								printf( __('S\'ha creat un nou usuari per a %1$s.', 'wp-coop'), $_POST['user_login'] );
							else
								printf( __('<strong>%1$s</strong>, gràcies per registrar-te.', 'wp-coop'), $_POST['user_login'] );
								if ( function_exists( 'sidebarlogin' ) ) sidebarlogin();
								//printf( __('<br/>Please check your email address. That\'s where you\'ll recieve your login password.<br/> (It might go into your spam folder)', 'wp-coop') );
							?>
							</div><!-- .success -->
						<?php else : ?>
						<?php if ( $error ) : ?>
							<div class="alert-message block-message error">
							<?php echo $error; ?>
							</div><!-- .error -->
						<?php endif; ?>

						<?php if ( current_user_can( 'create_users' ) && $registration ) : ?>
							<div class="alert-message block-message info">
								<?php _e('Els usuaris es poden registrar ells mateixos o pots fer-ho tu manualment desde aquí.', 'wp-coop'); ?>
							</div><!-- .info -->
						<?php elseif ( current_user_can( 'create_users' ) ) : ?>
							<div class="alert-message block-message info">
								<?php _e('Els usuaris NO es poden registrar ells mateixos , però ho pots fer manualment aquí.', 'wp-coop'); ?>
							</div><!-- .info -->
						<?php endif; ?>

						<?php if ( $registration || current_user_can( 'create_users' ) ) : ?>

							<form method="post" id="adduser" class="user-forms" action="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
								<fieldset>
									<legend><?php _e('Nom', 'wp-coop');?></legend>

									<div class="clearfix <?php if ( $error_user_login ) echo 'error';?>">
										<label for="user_login"><?php _e('Nom d\'usuari', 'wp-coop'); ?></label>
										<div class="input ">
											<div class="input-prepend">
												<span class="add-on" title="required">*</span>
												<input class="text-input" name="user_login" type="text" id="user_login" value="<?php if ( $error ) echo wp_specialchars( $_POST['user_login'], 1 ); ?>" />
												<span class="help-inline"><?php _e('El nom d\'usuari no pot canviar-se');?></span>
											</div>
										</div>
									</div><!-- .form-username -->

									<div class="clearfix <?php if ( $error_user_pass ) echo 'error';?>">
										<label for="user_pass"><?php _e('Clau d\'accés', 'wp-coop'); ?></label>
										<div class="input">
											<div class="input-prepend">
												<span class="add-on" title="required">*</span>
												<input class="text-input" name="user_pass" type="password" id="user_pass" value="<?php if ( $error ) echo wp_specialchars( $_POST['user_pass'], 1 ); ?>" />
											</div>
										</div>
									</div><!-- .user_pass -->

									<div class="clearfix">
										<label for="first_name"><?php _e('Nom', 'wp-coop'); ?></label>
										<div class="input">
											<input class="text-input" name="first_name" type="text" id="first_name" value="<?php if ( $error ) echo wp_specialchars( $_POST['first_name'], 1 ); ?>" />
										</div>
									</div><!-- .first_name -->

									<div class="clearfix">
										<label for="last_name"><?php _e('Cognom', 'wp-coop'); ?></label>
										<div class="input">
											<input class="text-input" name="last_name" type="text" id="last_name" value="<?php if ( $error ) echo wp_specialchars( $_POST['last_name'], 1 ); ?>" />
										</div>
									</div><!-- .last_name -->

									<div class="clearfix">
										<label for="nickname"><?php _e('Àlies', 'wp-coop'); ?></label>
										<div class="input">
											<input class="text-input" name="nickname" type="text" id="nickname" value="<?php if ( $error ) echo wp_specialchars( $_POST['nickname'], 1 ); ?>" />
										</div>
									</div><!-- .nickname -->
								</fieldset>
								<fieldset>
									<legend><?php _e('Informació de contacte', 'wp-coop'); ?></legend>

									<div class="clearfix <?php if ( $error_user_email ) echo 'error';?>">
										<label for="email"><?php _e('Correu electrònic', 'wp-coop'); ?></label>
										<div class="input">
											<div class="input-prepend">
												<span class="add-on" title="required">*</span>
												<input class="text-input" name="email" type="text" id="email" value="<?php if ( $error ) echo wp_specialchars( $_POST['email'], 1 ); ?>" />
											</div>
										</div>
									</div><!-- .form-email -->

									<div class="clearfix">
										<label for="telefon"><?php _e('Telèfon', 'wp-coop'); ?></label>
										<div class="input">
											<input class="text-input" name="telefon" type="text" id="telefon" value="<?php if ( $error ) echo wp_specialchars( $_POST['telefon'], 1 ); ?>" />
										</div>
									</div><!-- .form-telefon -->

									<div class="clearfix">
										<label for="address"><?php _e('Adreça', 'wp-coop'); ?></label>
										<div class="input">
											<input class="text-input" name="address" type="text" id="address" value="<?php if ( $error ) echo wp_specialchars( $_POST['address'], 1 ); ?>" />
										</div>
									</div><!-- .form-address -->

									<div class="clearfix">
										<label for="website"><?php _e('Web', 'wp-coop'); ?></label>
										<div class="input">
											<input class="text-input" name="website" type="text" id="website" value="<?php if ( $error ) echo wp_specialchars( $_POST['website'], 1 ); ?>" />
										</div>
									</div><!-- .form-website -->

								</fieldset>

								<fieldset>
									<legend><?php _e('Més sobre tu', 'wp-coop'); ?></legend>

									<div class="clearfix">
										<label for="description"><?php _e('Informació Extra', 'wp-coop'); ?></label>
										<div class="input">
											<textarea class="span5" name="description" id="description" rows="5" cols="30"><?php if ( $error ) echo wp_specialchars( $_POST['description'], 1 ); ?></textarea>
										</div>
									</div><!-- .form-description -->
								</fieldset>


								<div class="actions">
									<?php echo $referer; ?>
									<input name="adduser" type="submit" id="addusersub" class="btn large primary" value="<?php if ( current_user_can( 'create_users' ) ) _e('Crear Usuari Ruscaire!', 'wp-coop'); else _e('Registrat !', 'wp-coop'); ?>" />
									<?php wp_nonce_field( 'add-user' ) ?>
									<input name="action" type="hidden" id="action" value="adduser" />
								</div><!-- .form-submit -->

							</form><!-- #adduser -->

						<?php endif; ?>

						<?php endif; ?>

						<!-- REGISTER FORM ENDS HERE -->
						<?php endif; //if ( !post_password_required() ) ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
				<?php coop_pages_nav(); ?>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
