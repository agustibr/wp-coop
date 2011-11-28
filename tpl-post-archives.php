<?php
/*
Template Name: Pagina Arxiu Actualitat
*/
?>
<?php get_header(); ?>
	<div id="primary" class="grid_12">
			<div id="content" role="main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<h3><?php _e('30 Entrades Recents', 'wp-coop') ?></h3>
																		  
					    <ul>											  
					        <?php query_posts('showposts=30'); ?>		  
					        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					            <?php $wp_query->is_home = false; ?>	  
					            <li <?php post_class('list_arxiu');?>><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a> - <?php the_time(get_option('date_format')); ?> - <?php echo $post->comment_count ?> <?php _e('comentaris', 'wp-coop') ?></li>
					        <?php endwhile; endif; ?>					  
					    </ul>											  
																		  
					    <h3><?php _e('Categories', 'wp-coop') ?></h3>	  
																		  
					    <ul>											  
					        <?php wp_list_categories('title_li=&hierarchical=1&show_count=0') ?>	
					    </ul>											  
					     												  
					    <h3><?php _e('Arxiu Mensual', 'wp-coop') ?></h3>
																		  
					    <ul>											  
					        <?php wp_get_archives('type=monthly&show_post_count=0') ?>	
					    </ul>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
				

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>