<?php
/**
 * Template Name: Rebost per Ingredients : Index
 *
 *
 * @package wp-coop
 * @subpackage Template
 */

  get_header(); ?>
    <div id="primary">
      <div id="content" role="main">
        <article id="post-<?php the_ID();?>" <?php post_class(); ?>>
          <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
          </header><!-- .entry-header -->

          <div class="entry-content">
            <?php the_content(); ?>
          <?php $ingredients = get_terms('rebost', 'hide_empty=1'); ?>
          <ul>
            <?php foreach( $ingredients as $ingredient ) : ?>
              <li>
                <a href="<?php echo get_term_link( $ingredient->slug, 'rebost' ); ?>">
                  <?php echo $ingredient->name; ?>
                </a>
                <ul>
                  <?php
                    $wpq = array( 'post_type' => 'recepta', 'taxonomy' => 'rebost', 'term' => $ingredient->slug );
                    $ingredient_posts = new WP_Query ($wpq);
                  ?>
                  <?php foreach( $ingredient_posts->posts as $post ) : ?>
                    <li>
                      <a href="<?php echo get_permalink( $post->ID ); ?>">
                        <?php echo $post->post_title; ?>
                      </a>
                    </li>
                  <?php endforeach ?>
                </ul>
              </li>
            <?php endforeach ?>
          </ul>
        </div><!-- .entry-content -->
        </article><!-- #post-<?php the_ID(); ?> -->
      </div><!-- #content -->
    </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>