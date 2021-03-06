<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Toolbox
 * @since Toolbox 0.1
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'toolbox' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="hfeed">
	<header id="branding" role="banner">
		<hgroup class="container_16">
			<h1 id="site-title" class="grid_16"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<span class="clear"></span>
			<h2 id="site-description" class="grid_5"><?php bloginfo( 'description' ); ?></h2>
			<div class="clear"></div>
		</hgroup>
		<div class="clear"></div>
		<div class="container_16">
			<nav class="grid_16" role="navigation">
				<h1 class="assistive-text section-heading"><?php _e( 'Main menu', 'toolbox' ); ?></h1>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'toolbox' ); ?>"><?php _e( 'Skip to content', 'toolbox' ); ?></a></div>

				<?php
				// menu for all users
				wp_nav_menu( array( 'theme_location' => 'primary') );

				// custom navigation for diferent roles
				if ( is_user_logged_in() ) :
					global $current_user;
					$currUserRole = ( $current_user->roles);
					$user_role = $currUserRole[0];
					unset($currUserRole);
					if ($user_role == 'administrator' || $user_role == 'ruscaire') wp_nav_menu( array( 'theme_location' => 'ruscaire', 'fallback_cb'=>false ) );
					if ($user_role == 'administrator' || $user_role == 'ruscaire' || $user_role == 'proveidor-arc_natura') wp_nav_menu( array( 'theme_location' => 'proveidor_arc' , 'fallback_cb'=>false) );
				endif;
				?>
				<div class="clear"></div>
			</nav>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</header><!-- #branding -->
	<div class="clear"></div>
	<div id="main" class="container_16">
	<div class="grid_16">
		<?php if ( function_exists( 'breadcrumb_trail' ) )
			$args = array(
			'before' => false,
			'after' => false,
			'front_page' => false,
			'show_home' => __('elRusc.org'),
			);
			breadcrumb_trail( $args ); ?>
	</div>
	<div class="clear"></div>
