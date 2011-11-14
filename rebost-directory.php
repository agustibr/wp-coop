<?php
/**
 * Template Name: Rebost per Ingredients : Index
 *
 *
 * @package wp-coop
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>

	<div id="content" class="hfeed content">

		<?php do_atomic( 'before_content' ); // hybrid_before_content ?>

		<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

<h3>Receptes per Ingredients</h3>
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
  <?php do_atomic( 'after_content' ); // hybrid_after_content ?>
<?php get_footer(); // Loads the footer.php template. ?>