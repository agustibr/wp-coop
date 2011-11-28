<?php
/**
 * The template for displaying Search Results pages.
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
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'toolbox' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

				<?php toolbox_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php 
					while ( have_posts() ) : the_post();
						$post_type = get_post_type( get_the_ID() );
						$post_type_object = get_post_type_object( $post_type );
						$post_type_slug = $post_type_object->rewrite['slug'];
						if ($post_type == 'cistella') {
							$can_read_cpt="read_{$post_type_slug}";
							if ( current_user_can( $can_read_cpt ) )  get_template_part( 'content', get_post_format() );
							//else get_template_part( 'content', 'nopermission' ); 
						} else {
							get_template_part( 'content', 'search' );
						}
					endwhile; ?>

				<?php toolbox_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'toolbox' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'toolbox' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>