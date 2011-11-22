<?php
/**
 * Template Name: pagina Inici : Index
 *
 * @package wp-Coop
 * @subpackage Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<!-- Begin feature slider. -->
				<div id="slider-container" class="alert-message block-message info">

					<div id="slider">

					<?php $feature_query = array( 'post__in' => get_option( 'sticky_posts' ), 'showposts' => '5'); ?>

						<?php $loop = new WP_Query( $feature_query ); ?>

						<?php while ( $loop->have_posts() ) : $loop->the_post(); $do_not_duplicate[] = $post->ID; ?>

							<div class="feature media-grid">

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

				<article id="tabs-cistelles" class="grid_4">
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

				<article id="tabs-receptes" class="grid_4">
					<h3>Receptes</h3>
					<ul>
						<?php // setup the query
						$args='&suppress_filters=true&posts_per_page=5&post_type=recepta&order=DESC&orderby=date';								
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
							<a href="receptes/"><?php echo _('Més Receptes');?></a>
						</li>
   
					</ul>
				</article> <!-- #receptes -->

				<article id="tabs-posts" class="grid_4">
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
							<a href="receptes/"><?php echo _('Més Actualitats');?></a>
						</li>
   
					</ul>
				</article> <!-- #receptes -->

				<article id="tabs-pages" class="grid_4">
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

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
