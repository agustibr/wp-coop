<?php
/**
 * The Template for displaying all single posts.
 *
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main" class="grid_12">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				if( coop_user_can_read( get_post_type() ) || get_post_type()== 'post' ) :
					get_template_part( 'content', 'single' );
					coop_content_nav( 'nav-below' );
					coop_btn_publish_new( get_post_type() );
					comments_template( '', true );
				else :
					get_template_part( 'content', 'nopermission' );
				endif;
				?>
			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
