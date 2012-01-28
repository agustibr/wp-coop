<?php
/**
 * Template Name: Cens Usuaris
 *
 * @subpackage wp-Coop
 *
 */

get_header(); ?>
	<div id="primary" class="grid_16">
		<div id="contento" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
					<?php /** CENS *******************************/
					global $wp_roles;
           			echo '<ul class="tabs" data-tabs="tabs">';
            		foreach ( $wp_roles->role_names as $role => $role_name ) :
            			$tab_class = '';
            			if($role =='ruscaire') $tab_class = 'class="active"';
						if($role!='administrator') echo '<li '.$tab_class.'><a href="#'.$role.'">'.$role_name.'</a></li>';
            		endforeach;
            		echo '</ul><div class="tab-content">';
					foreach ( $wp_roles->role_names as $role => $role_name ) :
						if($role!='administrator'):
							//$blogusers = get_users('blog_id=1&orderby=nicename&role=subscriber');
							$options = 'role='.$role;
							$tab_pane_class = "tab-pane";
							if($role=='ruscaire') :
								$options = 'meta_key=uf&role='.$role;
								$tab_pane_class = "tab-pane active";
							endif;
							echo '<div id="'.$role.'" class="'.$tab_pane_class.'" >';
                			$blogusers = get_users($options); ?>
		                	<table class="zebra-striped tablesorter">
	    		              	<thead>
		        		            <tr>
		            			        <?php if( ($role!='espera') && ($role!='proveidor-arc_natura') ) echo '<th>'._('Unitat Familiar').'</th>';?>
		                    			<th><?php echo _('Nom');?></th>
		                    			<th><?php echo _('Email');?></th>
		                   				<th><?php echo _('Telèfon');?></th>
		                    			<th><?php echo _('Adreça');?></th>
		                    			<?php if($role!='espera') echo '<th>'._('A la coope desde ...').'</th>';?>
		                    			<?php if($role=='exruscaire') echo '<th>'._('Fins a').'</th>'; ?>
		                    			<?php if( ($role!='espera') && ($role!='proveidor-arc_natura') ) echo '<th>'._('És menor de 16 anys?').'</th>';?>
		                    			<?php if($role!='espera') echo '<th>'._('Té claus del Local?').'</th>';?>
		                    			<?php if($role=='espera') echo '<th>'._('Data de registre').'</th>';?>
		                    		</tr>
		                		</thead>
		                		<tbody>
		                		<?php
		                		foreach ($blogusers as $user) {
								echo '<tr>';
									if( ($role!='espera') && ($role!='proveidor-arc_natura') ) echo '<td>U.F. '.get_the_author_meta('uf', $user->ID).'</td>';
									echo '<td><strong>'.get_the_author_meta('display_name', $user->ID).'</strong></td>';
									echo '<td><a href="mailto:' . $user->user_email .'">' . $user->user_email .'</a></td>';
									echo '<td>'.get_the_author_meta('telefon', $user->ID).'</td>';
									echo '<td>'.get_the_author_meta('address', $user->ID).'</td>';
									if($role!='espera') echo '<td>'.get_the_author_meta('coope_desde', $user->ID).'</td>';
									if($role=='exruscaire') echo '<td>'.get_the_author_meta('coope_fins', $user->ID).'</td>';
									if( ($role!='espera') && ($role!='proveidor-arc_natura') ) echo '<td>'.get_the_author_meta('es_menor', $user->ID).'</td>';
									if($role!='espera') echo '<td>'.get_the_author_meta('claus_local', $user->ID).'</td>';
									if($role=='espera') echo '<td>'.$user->user_registered.'</td>';
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
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
