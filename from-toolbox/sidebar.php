<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage wp-Coop
 * @since Toolbox 0.1
 */
?>
		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		<div id="secondary" class="widget-area grid_4 pull_12 omega" role="complementary"><?php dynamic_sidebar( 'sidebar-3' ); ?></div><!-- #secondary .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
		<div id="tertiary" class="widget-area grid_4 pull_12 omega" role="complementary"><?php dynamic_sidebar( 'sidebar-4' ); ?></div><!-- #tertiary .widget-area -->
		<?php endif; ?>
