<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage wp-coop
 * @since Toolbox 0.1
 */
?>
		<div class="clear"></div>
	</div><!-- #main -->

	

	
</div><!-- #page -->

<div id="footer" class="container_12" >
	<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
	<footer class="widget-area" role="complementary"><?php dynamic_sidebar( 'footer-1' ); ?></footer><!-- .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
	<footer class="widget-area" role="complementary"><?php dynamic_sidebar( 'footer-3' ); ?></footer><!-- .widget-area -->
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
	<footer class="widget-area" role="complementary"><?php dynamic_sidebar( 'footer-3' ); ?></footer><!-- .widget-area -->
	<?php endif; ?>
	<div class="clear"></div>

	<footer id="colophon" role="contentinfo" class="grid_12">
		<div id="site-generator">
			<?php do_action( 'toolbox_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'toolbox' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'toolbox' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'toolbox' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'toolbox' ), 'Toolbox', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
		</div>
	</footer><!-- #colophon -->
	<div class="clear"></div>
</div>

<?php wp_footer(); ?>

</body>
</html>
