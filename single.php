<?php
/**
 * The Template for displaying all single posts.
 *
 */

get_header(); ?>

		<div id="primary" class="grid_12">
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php toolbox_content_nav( 'nav-above' ); ?>
				
				<?php 
				$post_type = get_post_type( get_the_ID() );
				$post_type_obj = get_post_type_object( $post_type );
				$post_type_slug = $post_type_obj->rewrite['slug'];
				if ($post_type == 'cistella') {
					$can_read_cpt="read_{$post_type_slug}";
					if ( current_user_can( $can_read_cpt ) )  get_template_part( 'content', 'single' );
					else get_template_part( 'content', 'nopermission' ); 
				} else {
					get_template_part( 'content', 'single' );
				}
				
				?>
				<?php toolbox_content_nav( 'nav-below' ); ?>

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php
global $wp_post_types;
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
?>