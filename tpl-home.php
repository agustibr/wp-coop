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

							<div class="feature media-grid grid_5">

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

				<!-- Start CPT Section -->
				<?php
				$home_cpts = array(
					'cistella',
					'recepta',
					'post',
					'page'
				);

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
						//if ( current_user_can( $can_read_cpt ) ) :

							echo '<div class="grid_6 alpha">
									<article id="tabs-cistelles">
										<h3><a href="'.$post_type_slug.'"/>'.$lbl.'</a></h3>
										<ul>';
							while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
							?>
								<li>
									<a class="post-title" href="<?php the_permalink(); ?>" title="<?php $view_item.': '.the_title(); ?>">
										<span style="float:right;"><?php get_the_image(); ?></span>
										<span style="float:left;"><?php the_title(); ?></span>
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
						endif;
					endif;
					wp_reset_query();

				}
				/*?>
				<hr/><hr/><hr/><hr/><hr/>
				<p>rsdftyughluihjiojiopjiopj</p>
								<p>rsdftyughluihjiojiopjiopj</p>
				<div class="grid_6 alpha">
					<article id="tabs-cistelles">
						<h3>Cistelles</h3>
						<ul>
							<?php // setup the query
							$args='&suppress_filters=true&posts_per_page=5&post_type=cistella&order=DESC&orderby=date';
							$cust_loop = new WP_Query($args);
							if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
							?>
								<li>
									<a class="post-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a>
								</li>
							<?php endwhile;
							endif;
							wp_reset_query(); ?>

							<li class="last gentesque tooltip" title="View all movie reviews">
								<a href="cistelles/"><?php echo _('Més Cistelles');?></a>
							</li>

						</ul>
					</article> <!-- #cistelles -->
				</div>

				<div class="grid_6 omega">
					<article id="tabs-receptes">
						<h3><a href="receptes/">Receptes</a></h3>
						<ul class="unstyled">
							<?php // setup the query
							$args='&suppress_filters=true&posts_per_page=5&post_type=recepta&order=DESC&orderby=date';
							$cust_loop = new WP_Query($args);
							if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
							?>
								<li>
									<?php get_the_image(  ); ?>
									<h5><a class="post-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a></h5>
									<?php echo get_the_term_list( get_the_ID(), 'rebost', 'amb: ', ', ', '' ); ?>
								</li>
							<?php endwhile;
							endif;
							wp_reset_query(); ?>

							<li class="last gentesque tooltip" title="View all movie reviews">
								<a href="receptes/"><?php echo _('Més Receptes');?></a>
							</li>
						</ul>
					</article> <!-- #receptes -->
				</div>

				<div class="grid_6 alpha">
					<article id="tabs-posts">
						<h3>Actualitat</h3>
						<ul>
							<?php // setup the query
							$args='&suppress_filters=true&posts_per_page=5&post_type=post&order=DESC&orderby=date';
							$cust_loop = new WP_Query($args);
							if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
							?>
								<li>
									<a class="post-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a>
								</li>
							<?php endwhile;
							endif;
							wp_reset_query(); ?>

							<li class="last gentesque tooltip" title="View all movie reviews">
								<a href="actualitat/"><?php echo _('Més Actualitats');?></a>
							</li>

						</ul>
					</article> <!-- #receptes -->
				</div>

				<div class="grid_6 omega">
					<article id="tabs-pages">
						<h3>Pàgines</h3>
						<ul>
							<?php // setup the query
							$args='&suppress_filters=true&posts_per_page=5&post_type=page&order=DESC&orderby=date';
							$cust_loop = new WP_Query($args);
							if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
							?>
								<li>
									<a class="post-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a>
								</li>
							<?php endwhile;
							endif;
							wp_reset_query(); ?>

							<li class="last gentesque tooltip" title="View all movie reviews">
								<a href="receptes/"><?php echo _('Més Pàgines');?></a>
							</li>

						</ul>
					</article> <!-- #receptes -->
				</div>
				<?php */ ?>
			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
