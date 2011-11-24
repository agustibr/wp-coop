<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage wp-Coop
 * @since Toolbox 0.1
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>

				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', 'toolbox' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h1 class="widget-title"><?php _e( 'Meta', 'toolbox' ); ?></h1>
					<ul>
						<?php wp_register(); ?>
						<aside><?php wp_loginout(); ?></aside>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
		
		<?php
		if ( is_user_logged_in() ) {
			global $current_user;
			$currUserRole = ($current_user->data->wp_capabilities);
			$role = key($currUserRole);
			unset($currUserRole);
			if($role=='administrator') $role='ruscaire';
			if ( is_active_sidebar( 'sidebar-'. $role ) ) :
			 	echo '<div id="tertiary" class="widget-area sidebar-'. $role.'" role="complementary">';
				dynamic_sidebar( 'sidebar-'. $role );
				echo '</div>';
			endif;
		} else {
			echo '<div id="tertiary" class="widget-area sidebar-no_logged" role="complementary">';
			dynamic_sidebar( 'sidebar-no_logged');
			echo '</div>';
		}
		?>