<?php
/**
 * Template Name: pagina Inici : Index
 *
 * @package wp-Coop
 * @subpackage Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

		<section id="primary" class="grid_12">
			<div id="content" role="main">

				<!-- Begin feature slider. -->
				<div id="slider-container" class="alert-message block-message info">

					<div id="slider">

					<?php $feature_query = array( 'post__in' => get_option( 'sticky_posts' ), 'showposts' => '5'); ?>

						<?php $loop = new WP_Query( $feature_query ); ?>

						<?php while ( $loop->have_posts() ) : $loop->the_post(); $do_not_duplicate[] = $post->ID; ?>

							<div class="feature media-grid grid_11">

								<?php get_the_image( array( 'meta_key' => array( 'Medium', 'Feature Image' , 'thumbnail' ), 'size' => 'medium' ) ); ?>
								<h4><?php the_title(); ?></h4>
								<div class="entry-summary">
									<?php the_excerpt(); ?>
									<br/>
									<a class="btn small" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e( 'Llegir més...', 'wp-coop' ); ?></a>
								</div>

							</div>

						<?php endwhile; ?>

					</div>

					<div class="slider-controls">
						<a class="slider-prev">Anterior</a>
						<a class="slider-pause">Pausa</a>
						<a class="slider-next">Següent</a>
					</div>

				</div>
				<!-- End feature slider. -->
				<div class="clear"></div>
				<!-- Start CPT Section -->
				<?php
				$home_cpts = array(
					'cistella',
					'recepta',
					'post',
					'page'
				);

				$count = 0;
				foreach ($home_cpts as $key => $home_cpt) {
					$post_type = $home_cpt;
					$args='&suppress_filters=true&posts_per_page=5&post_type='.$post_type.'&order=DESC&orderby=date';
					$cust_loop = new WP_Query($args);
					if ($cust_loop->have_posts()) :
						$cust_loop->the_post();
						$post_type = get_post_type( get_the_ID() );
						$post_type_object = get_post_type_object( $post_type );
						$post_type_slug = $post_type_object->rewrite['slug'];
						//$post_type_labels = get_post_type_labels( $post_type_object );
						//pre($post_type_object);
						$lbl = $post_type_object->label;
						$all_items = $post_type_object->labels->all_items;
						$view_item = $post_type_object->labels->view_item;
						 //$can_read_cpt="read";
						//if($post_type_slug!='') $can_read_cpt="read_{$post_type_slug}";
						//echo '-->'.$can_read_cpt;
						if( coop_user_can_read ( $post_type ) ) :
							$css = 'widget_home widget_home_'.$post_type;
							if ( $count % 2 ) $css .= ' omega ';
							else $css .= ' alpha';

							echo '<div class="grid_6 '.$css.'">
									<article>
										<h3><a href="'.$post_type_slug.'"/>'.$lbl.'</a></h3>
										<ul>';
							while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
							?>
								<li>
									<a class="post-title" href="<?php the_permalink(); ?>" title="<?php $view_item.': '.the_title(); ?>">
										<?php if(get_the_image()): ?>
											<span style="float:right;"><?php get_the_image(); ?></span>
										<?php endif; ?>
										<span><?php the_title(); ?></span>
										<span class="clear"></span>
									</a>
								</li>
							<?php
							endwhile;
							echo '
								<li class="last gentesque tooltip" title="">
									<strong><a href="'.$post_type_slug.'"/>'.$all_items.'</a></strong>
								</li>
							</ul>
							</article></div>';
							$count ++;
						endif;
					endif;
					wp_reset_query();

				}
				?>
				<!-- End CPT Section -->
				<div class="clear"></div>
			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
