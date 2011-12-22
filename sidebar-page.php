<?php
/**
 * The Sidebar for Pages.
 * @package wp-Coop
 */
?>
	<div id="secondary" class="widget-area grid_4" role="complementary">

		<aside class="widget widget_pages">
			<?php
			if ($post->post_parent) {
				$ancestors=get_post_ancestors($post->ID);
				$root=count($ancestors)-1;
				$parent = $ancestors[$root];
			} else {
        		$parent = $post->ID;
			}
			?>
			<h1 class="widget-title"><a href="<?php echo get_permalink( $parent )?>"><?php echo get_the_title($parent); ?></a></h1>
			<nav>
				<ul>
					<?php wp_list_pages( "title_li=&child_of=$parent&sort_column=menu_order"); ?>
				</ul>
			</nav>
		</aside>

		<aside id="search" class="widget widget_search">
			<?php get_search_form(); ?>
		</aside>

		<aside class="widget widget_pages">
			<h1 class="widget-title"><?php _e('Pages');?></h1>
			<nav>
				<ul>
					<?php wp_list_pages( "title_li=&depth=1&sort_column=menu_order"); ?>
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
