<?php
/**
 * Template Name: pagina Rebost
 *
 * @package wp-Coop
 */

get_header(); ?>

		<div id="primary"  class="grid_12">
			<div id="content" role="main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php 
						$args = array(
						'smallest'                  => 8, 
						'largest'                   => 22,
					    'unit'                      => 'pt', 
					    'number'                    => 45,  
					    'format'                    => 'flat',
					    'separator'                 => ' ',
					    'orderby'                   => 'name', 
					    'order'                     => 'ASC',
					    'exclude'                   => null, 
					    'include'                   => null, 
					    'topic_count_text_callback' => default_topic_count_text,
					    'link'                      => 'view', 
					    'taxonomy'                  => 'rebost', 
					    'echo'                      => true 
					    ); ?>
					    <?php wp_tag_cloud( $args ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
				

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>



