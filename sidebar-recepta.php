<?php
/**
 * The Sidebar for Pages.
 * @package wp-Coop
 */
?>
	<div id="secondary" class="widget-area grid_4" role="complementary">

		<aside id="search" class="widget widget_search">
			<?php get_search_form(); ?>
		</aside>
		<aside class="widget widget_categories_receptes">
			<h1 class="widget-title">Categories</h1>
			<nav>
				<?php
				$args = array(
					'smallest'                  => 1,
    				'largest'                   => 1,
    				'unit'                      => 'em',
			    	'format'                    => 'list',
			    	'taxonomy'                  => 'categoria_recepta',
			    	'echo'                      => true
			    ); ?>
			    <?php wp_tag_cloud( $args ); ?>
			</nav>
		</aside>
		<aside class="widget widget_rebost">
			<h1 class="widget-title">Rebost</h1>
			<nav>
				<?php
				$args = array(
				'smallest'                  => 8,
				'largest'                   => 16,
			    'unit'                      => 'pt',
			    'number'                    => 999,
			    'format'                    => 'flat',
			    'separator'                 => ', ',
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
			</nav>
		</aside>
		<aside class="widget widget_rebost_x_ingredients">
			<h1 class="widget-title">Receptes x Ingredients</h1>
			<nav>
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
			</nav>
		</aside>

		<?php
		if ( function_exists( 'sidebarlogin' ) ) :
			echo '<aside class="widget">';
			sidebarlogin();
			echo '</aside>';
		endif;
		?>

	</div><!-- #secondary .widget-area -->
