<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage wp-Coop
 * @since Toolbox 0.1
 */
?>
		<div class="clear"></div>
		<?php
		if ( function_exists( 'loop_pagination' ) )
			// more info: http://codex.wordpress.org/Function_Reference/paginate_links
			$args = array(
				'before' => '<div class="pagination">', // Begin loop_pagination() arguments.
				'after' => '</div>',
				'show_all' => true,
				'type'=> 'list',
			);
			loop_pagination( $args ); ?>
	</div><!-- #main -->
	<div class="clear"></div>
	<footer id="colophon" role="contentinfo">
		<div id="site-generator">
			<?php do_action( 'toolbox_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'toolbox' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'toolbox' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'toolbox' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'toolbox' ), 'Toolbox', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>