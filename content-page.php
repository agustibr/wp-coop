<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage wp-Coop
 * @since Toolbox 1.0
 */
?>
<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
</header><!-- .entry-header -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'toolbox' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'toolbox' ), '<span class="edit-link">', '</span>' );?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
