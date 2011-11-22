<?php
/**
 * Template Name: pagina amb tots els enllaços
 *
 * @package wp-Coop
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php $args = array(
						'title_li' => false,
						'title_before' => '<h2>',
						'title_after' => '</h2>',
						'category_before' => false,
						'category_after' => false,
						'categorize' => true,
						'show_description' => true,
						'between' => '<br />',
						'show_images' => true,
						'show_rating' => true,
					); ?>
					<?php wp_list_bookmarks( $args ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
				

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>



