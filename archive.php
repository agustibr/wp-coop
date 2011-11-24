<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage wp-Coop
 * @since Toolbox 0.1
 */

get_header(); ?>

		<section id="primary" class="grid_12">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
						if ( is_post_type_archive( array('cistella','recepta') ) ) {
					    	post_type_archive_title();
						} else {
							if ( is_day() ) :
								printf( __( 'Daily Archives: %s', 'toolbox' ), '<span>' . get_the_date() . '</span>' );
							elseif ( is_month() ) :
								printf( __( 'Monthly Archives: %s', 'toolbox' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
							elseif ( is_year() ) :
								printf( __( 'Yearly Archives: %s', 'toolbox' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
							else :
								_e( 'Archives', 'wp-coop' );
							endif;
						}
						?>
					</h1>
				</header>

				<?php rewind_posts(); ?>

				<?php toolbox_content_nav( 'nav-above' ); ?>
				<div class="clear"></div>
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						$post_type = get_post_type( get_the_ID() );
						$post_type_object = get_post_type_object( $post_type );
						$post_type_slug = $post_type_object->rewrite['slug'];
						//$post_type_labels = get_post_type_labels( $post_type_object );
						if ($post_type == 'cistella') {
							$can_read_cpt="read_{$post_type_slug}";
							if ( current_user_can( $can_read_cpt ) )  get_template_part( 'content', get_post_format() );
							else get_template_part( 'content', 'nopermission' ); 
						} else {
							get_template_part( 'content', get_post_format() );
						}
						
					?>

				<?php endwhile; ?>

				<?php toolbox_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'toolbox' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'toolbox' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>