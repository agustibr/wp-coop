<?php
/**
 * Template Name: Cens Usuaris
 * 
 * @subpackage wp Coop
 * 
 */

get_header(); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js" type="text/javascript"></script> 
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/ui-lightness/jquery-ui.css" rel="stylesheet" type="text/css" />

		<div id="container" class="full-width">
			<div id="content" role="main">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="entry-content">
						<?php the_content(); ?>
						
						<?php /** CENS ******************************* */?>
						<?php
            global $wp_roles;
            echo '<div id="tabs"><ul>';
            foreach ( $wp_roles->role_names as $role => $role_name ) :
				if($role!='administrator') echo '<li><a href="#'.$role.'">'.$role_name.'</a></li>';
            endforeach;
            echo '</ul>';

            //echo '<div class="tab-content">';
            foreach ( $wp_roles->role_names as $role => $role_name ) :
					if($role!='administrator'):
						echo '<div id="'.$role.'">';
						// http://codex.wordpress.org/Function_Reference/get_users
						//$blogusers = get_users('blog_id=1&orderby=nicename&role=subscriber');
						$options = 'role='.$role;
						if($role=='ruscaire') $options = 'meta_key=uf&role='.$role;
                	$blogusers = get_users($options);
                ?>
                	<table class="zebra-striped">
                  	<thead>
	                    <tr>
	                    <th><?php echo _('Unitat Familiar');?></th>
	                    <th><?php echo _('Nom');?></th>
	                    <th><?php echo _('Email');?></th>
	                    <th><?php echo _('Telèfon');?></th>
	                    <th><?php echo _('Adreça');?></th>
	                    <th><?php echo _('A la coope desde ...');?></th>
	                    <th><?php echo _('És menor de 16 anys?');?></th>
	                    </tr>
	                  </thead>
	                <tbody>
	                <?php
	                foreach ($blogusers as $user) {
							echo '<tr>';
								echo '<td>'.get_the_author_meta('uf', $user->ID).'</td>';
								echo '<td><strong>'.get_the_author_meta('display_name', $user->ID).'</strong></td>';
								echo '<td><a href="mailto:' . $user->user_email .'">' . $user->user_email .'</a></td>';
								echo '<td>'.get_the_author_meta('telefon', $user->ID).'</td>';
								echo '<td>'.get_the_author_meta('address', $user->ID).'</td>';
								echo '<td>'.get_the_author_meta('coope_desde', $user->ID).'</td>';
								echo '<td>'.get_the_author_meta('es_menor', $user->ID).'</td>';
	                    //if(get_the_author_meta('description', $user->ID)) echo '<td>'.get_the_author_meta('description', $user->ID).'</td>'; 
	                    //echo '<li><a href="'.get_bloginfo('url').'/cens/' . $user->user_nicename .'">aaa</a></li>';
	               	echo '</tr>';
                	} ?>
						</tbody>
					</table>
				</div><!-- /role -->
			<?php 
			endif;
		endforeach; ?>
	</div> <!-- /#tabs -->
						<?php /** end CENS ******************************* */?>
						
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'coraline' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'coraline' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php if ( comments_open() ) comments_template( '', true ); ?>

			<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #content-container -->

<?php get_footer(); ?>
<script>
  jQuery(document).ready(function($) {
   $('#tabs').tabs();
  });
</script>
