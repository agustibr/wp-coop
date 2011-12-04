<?php
/**
 * Template Name: Pàgina amb tot l'Ample, sense barres laterals
 * Description: A full-width template with no sidebar
 *
 * @package WordPress
 * @subpackage wp-Coop
 * @since Toolbox 0.1
 */

get_header(); ?>

		<div id="primary" class="full-width grid_16">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>