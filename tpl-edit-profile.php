<?php
/**
 * Template Name: Pàgina Editar Perfil
 *
 */
 
	/* Get user info. */
	global $current_user, $wp_roles;
	get_currentuserinfo();

	/* Load the registration file. */
	require_once( ABSPATH . WPINC . '/registration.php' );
	require_once( ABSPATH . 'wp-admin/includes' . '/template.php' ); // this is only for the selected() function

	/* If profile was saved, update profile. */
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

		/* Update user password. */
		if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
			if ( $_POST['pass1'] == $_POST['pass2'] )
				wp_update_user( array( 'ID' => $current_user->id, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
			else
				$error = __('The passwords you entered do not match.  Your password was not updated.', 'frontendprofile');
		}

		/* Update user information. */
		
		update_usermeta( $current_user->id, 'first_name', esc_attr( $_POST['first_name'] ) );
		
		update_usermeta( $current_user->id, 'last_name', esc_attr( $_POST['last_name'] ) );
		
		if ( !empty( $_POST['nickname'] ) )
			update_usermeta( $current_user->id, 'nickname', esc_attr( $_POST['nickname'] ) );
		
		update_usermeta( $current_user->id, 'display_name', esc_attr( $_POST['display_name'] ) );
		
		if ( !empty( $_POST['email'] ) )
			update_usermeta( $current_user->id, 'user_email', esc_attr( $_POST['email'] ) );
		
		if(strpos($_POST['website'], 'ttp://') || empty( $_POST['website'] ))
			update_usermeta( $current_user->id, 'user_url', esc_attr( $_POST['website'] ) );
		else
			update_usermeta( $current_user->id, 'user_url', 'http://' . esc_attr( $_POST['website'] ) );
		
		//update_usermeta( $current_user->id, 'aim', esc_attr( $_POST['aim'] ) );
		
		//update_usermeta( $current_user->id, 'yim', esc_attr( $_POST['yim'] ) );
		
		//update_usermeta( $current_user->id, 'jabber', esc_attr( $_POST['jabber'] ) );
		
		update_usermeta( $current_user->id, 'description', esc_attr( $_POST['description'] ) );
		
		// Extra Profile Information
		
		//update_usermeta( $current_user->id, 'twitter', esc_attr( $_POST['twitter'] ) );	
		
		//update_usermeta( $current_user->id, 'birth', esc_attr( $_POST['birth'] ) );	
		
		//update_usermeta( $current_user->id, 'hobbies', $_POST['hobbies'] );	
		
		//update_usermeta( $current_user->id, 'agree', esc_attr( $_POST['agree'] ) );	
			
		/* Redirect so the page will show updated info. */
		if ( !$error ) {
			wp_redirect( get_permalink() );
			exit;
		}
	}
	
	get_header(); ?>

		<div id="primary" class="grid_12">
			<div id="content" role="main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php  if ( !post_password_required() ) : ?>
		
<!-- EDIT PROFILE STARTS HERE -->

			<?php if ( !is_user_logged_in() ) : ?>
				
				<p class="warning">
					<?php _e('You must be logged in to edit your profile.', 'frontendprofile'); ?>
				</p><!-- .warning -->

			<?php else : ?>

				<?php if ( $error ) echo '<p class="error">' . $error . '</p>'; ?>

				<form method="post" id="edituser" class="user-forms" action="<?php the_permalink(); ?>">
				
				<strong>Name</strong>
				
				<p class="first_name">
					<label for="first_name"><?php _e('First Name', 'frontendprofile'); ?></label>
					<input class="text-input" name="first_name" type="text" id="first_name" value="<?php the_author_meta( 'first_name', $current_user->id ); ?>" />
				</p><!-- .first_name -->
				
				<p class="last_name">
					<label for="last_name"><?php _e('Last Name', 'frontendprofile'); ?></label>
					<input class="text-input" name="last_name" type="text" id="last_name" value="<?php the_author_meta( 'last_name', $current_user->id ); ?>" />
				</p><!-- .last_name -->
				
				<p class="nickname">
					<label for="nickname"><?php _e('Nickname (required)', 'frontendprofile'); ?></label>
					<input class="text-input" name="nickname" type="text" id="nickname" value="<?php the_author_meta( 'nickname', $current_user->id ); ?>" />
				</p><!-- .nickname -->
				
				<p class="display_name">
					<label for="display_name"><?php _e('Display Name', 'frontendprofile'); ?></label>
					<select name="display_name" id="display_name">
					<?php
						$public_display = array();
						$public_display['display_nickname']  = $current_user->nickname;
						$public_display['display_username']  = $current_user->user_login;
						if ( !empty($current_user->first_name) )
							$public_display['display_firstname'] = $current_user->first_name;
						if ( !empty($current_user->last_name) )
							$public_display['display_lastname'] = $current_user->last_name;
						if ( !empty($current_user->first_name) && !empty($current_user->last_name) ) {
							$public_display['display_firstlast'] = $current_user->first_name . ' ' . $current_user->last_name;
							$public_display['display_lastfirst'] = $current_user->last_name . ' ' . $current_user->first_name;
						}
						if ( !in_array( $current_user->display_name, $public_display ) )// Only add this if it isn't duplicated elsewhere
							$public_display = array( 'display_displayname' => $current_user->display_name ) + $public_display;
						$public_display = array_map( 'trim', $public_display );
						foreach ( $public_display as $id => $item ) {
					?>
						<option id="<?php echo $id; ?>" value="<?php echo esc_attr($item); ?>"<?php selected( $current_user->display_name, $item ); ?>><?php echo $item; ?></option>
					<?php
						}
					?>
					</select>
				</p><!-- .display_name -->
				
				<strong>Contact Info</strong>
				
				<p class="form-email">
					<label for="email"><?php _e('E-mail (required)', 'frontendprofile'); ?></label>
					<input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->id ); ?>" />
				</p><!-- .form-email -->
				
				<p class="form-website">
					<label for="website"><?php _e('Website', 'frontendprofile'); ?></label>
					<input class="text-input" name="website" type="text" id="website" value="<?php the_author_meta( 'user_url', $current_user->id ); ?>" />
				</p><!-- .form-website -->
				<!--
				<p class="form-aim">
					<label for="aim"><?php _e('AIM', 'frontendprofile'); ?></label>
					<input class="text-input" name="aim" type="text" id="aim" value="<?php the_author_meta( 'aim', $current_user->id ); ?>" />
				</p>--><!-- .form-aim -->
				<!--
				<p class="form-yim">
					<label for="yim"><?php _e('Yahoo IM', 'frontendprofile'); ?></label>
					<input class="text-input" name="yim" type="text" id="yim" value="<?php the_author_meta( 'yim', $current_user->id ); ?>" />
				</p>--><!-- .form-yim -->
				<!--
				<p class="form-jabber">
					<label for="jabber"><?php _e('Jabber / Google Talk', 'frontendprofile'); ?></label>
					<input class="text-input" name="jabber" type="text" id="jabber" value="<?php the_author_meta( 'jabber', $current_user->id ); ?>" />
				</p>--><!-- .form-jabber -->
				
				<strong>About Yourself</strong>
				
				<p class="form-description">
					<label for="description"><?php _e('Biographical Info', 'frontendprofile'); ?></label>
					<textarea class="text-input" name="description" id="description" rows="5" cols="30"><?php echo the_author_meta( 'description', $current_user->id ); ?></textarea>
				</p><!-- .form-description -->
				
				<p class="form-password">
					<label for="pass1"><?php _e('New Password', 'frontendprofile'); ?> </label>
					<input class="text-input" name="pass1" type="password" id="pass1" />
				</p><!-- .form-password -->

				<p class="form-password">
					<label for="pass2"><?php _e('Repeat Password', 'frontendprofile'); ?></label>
					<input class="text-input" name="pass2" type="password" id="pass2" />
				</p><!-- .form-password -->
				
				<strong>Extra Profile Information</strong>
				<!--
				<p class="form-twitter">
					<label for="twitter"><?php _e('Twitter', 'frontendprofile'); ?></label>
					<input class="text-input" name="twitter" type="text" id="twitter" value="<?php the_author_meta( 'twitter', $current_user->id ); ?>" />
				</p>--><!-- .form-twitter -->
				<!--
				<p class="form-birth">
					<label for="birth"><?php _e('Year of birth', 'frontendprofile'); ?></label>
					<?php
					/*
						for($i=1900; $i<=2000; $i++)
							$years[]=$i;
						
						echo '<select name="birth">';
							echo '<option value="">' . __("Select Year", 'frontendprofile' ) . '</option>';
							foreach($years as $year){
								$the_year = get_the_author_meta( 'birth', $current_user->id );
								if($year == $the_year ) $selected = 'selected="slelected"';
								else $selected = '';
								echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
							}
						echo '</select>';
					*/?>
				</p>--><!-- .form-birth -->
				<!--
				<p class="form-hobbies">
					<label for="hobbies"><?php _e('What are your hobbies?', 'frontendprofile'); ?></label>
					<?php
					//	$hobbies = get_the_author_meta( 'hobbies', $current_user->id );
					?>
					<ul class="hobbies-type-list">
						<li><input value="videogames"           name="hobbies[]" <?php if (is_array($hobbies)) { if (in_array("videogames",           $hobbies)) { ?>checked="checked"<?php } }?> type="checkbox" /> <?php _e('Video Games',           'frontendprofile'); ?></li>
						<li><input value="sabotagingcapitalism" name="hobbies[]" <?php if (is_array($hobbies)) { if (in_array("sabotagingcapitalism", $hobbies)) { ?>checked="checked"<?php } }?> type="checkbox" /> <?php _e('Sabotaging Capitalism', 'frontendprofile'); ?></li>
						<li><input value="watchingtv"           name="hobbies[]" <?php if (is_array($hobbies)) { if (in_array("watchingtv",           $hobbies)) { ?>checked="checked"<?php } }?> type="checkbox" /> <?php _e('Watching TV',           'frontendprofile'); ?></li>
					</ul>
				</p>--><!-- .form-hobbies -->
				<!--
				<p class="form-agree">
					<label for="agree"><?php _e('Do you agree that WordPress is the greatest thing since bread came sliced?', 'frontendprofile'); ?></label>
					<?php $agree = get_the_author_meta( 'agree', $current_user->ID ); ?>
					<ul>
						<li><input value="yes" name="agree" <?php if ($agree == 'yes' ) { ?>checked="checked"<?php }?> type="radio" /> <?php _e('Yes', 'frontendprofile'); ?></li>
						<li><input value="no"  name="agree" <?php if ($agree == 'no'  ) { ?>checked="checked"<?php }?> type="radio" /> <?php _e('No',  'frontendprofile'); ?></li>
					</ul>
				</p>--><!-- .form-agree -->

				<p class="form-submit">
					<?php echo $referer; ?>
					<input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'frontendprofile'); ?>" />
					<?php wp_nonce_field( 'update-user' ) ?>
					<input name="action" type="hidden" id="action" value="update-user" />
				</p><!-- .form-submit -->

				</form><!-- #edituser -->

			<?php endif; ?>

<!-- EDIT PROFILE ENDS HERE -->
		
        				<?php endif; //if ( !post_password_required() ) ?>
						
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'toolbox' ), 'after' => '</div>' ) ); ?>
						<?php//edit_post_link( __( 'Edit', 'toolbox' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>