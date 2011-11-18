<?php
/**
 * The template for displaying 401 (no permission)
 *
 * Learn more: http://codex.wordpress.org/Function_Reference/get_template_part
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">Please Login !</h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		Only for registered users
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		
	</footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->