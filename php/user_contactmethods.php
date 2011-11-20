<?php
$current_user = wp_get_current_user();
$user_id = $current_user->ID;

function update_contact_methods( $contactmethods ) {
  // Remove annoying and unwanted default fields  
  unset($contactmethods['aim']);  
  unset($contactmethods['jabber']);  
  unset($contactmethods['yim']);

  // Add new fields  
  //$contactmethods['uf'] = _('Unitat Familiar');
  //$contactmethods['coope_desde'] = _('A la coope desde ...');  
  $contactmethods['telefon'] = _('Telèfon');  
  $contactmethods['address'] = _('Adreça');
  //$contactmethods['es_menor'] = _('És menor de 16 anys?');
  //$contactmethods['claus_local'] = _('Té una còpia de les claus del local?');
  return $contactmethods;
}

add_filter('user_contactmethods','update_contact_methods',10);

/*
<div class="author-box">
   <div class="author-pic"><?php echo get_avatar( get_the_author_email(), '80' ); ?></div>
   <div class="author-name"><?php the_author_meta( "display_name" ); ?></div>
   <div class="author-bio"><?php the_author_meta( "user_description" ); ?></div>
</div>
*/
/*
add_action( 'show_user_profile', 'show_extra_profile_fields', 10 );
add_action( 'edit_user_profile', 'show_extra_profile_fields', 10 );
 
function show_extra_profile_fields( $user ) { ?>
  <input type="text" name="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" />
<?php }
*/


add_action( 'show_user_profile', 'show_extra_profile_fields', 10 );
add_action( 'edit_user_profile', 'show_extra_profile_fields', 10 );

function show_extra_profile_fields( $user ) { ?>
  <h3><?php _e('Informació a la cooperativa', 'wp-coop'); ?></h3>
  <table class="form-table">
    <tr>
      <th><label for="coope_desde"><?php _e('A la coope desde ...', 'wp-coop'); ?></label></th>
      <td>
        <?php
        
        for($i=2009; $i<=2012; $i++)
          $years[]=$i;
        
        echo '<select name="coope_desde">';
          echo '<option value="">' . __("Selecciona any", 'wp-coop' ) . '</option>';
          foreach($years as $year){
            $selected = '';
            if( $year == get_the_author_meta( 'coope_desde', $user->ID ) )
              $selected = 'selected="selected"';
            echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
          }
        echo '</select>';
        ?>
        <span class="description"><?php _e('Please selecciona any d\'arribada', 'wp-coop'); ?></span>
      </td>
    </tr>

    <tr>
      <th><label for="uf"><?php _e('Unitat Familiar', 'wp-coop'); ?></label></th>
      <td>
        <?php
        
        for($i=1; $i<=35; $i++)
          $ufs[]=$i;
        
        echo '<select name="uf">';
          echo '<option value="">' . __("Selecciona UF", 'wp-coop' ) . '</option>';
          foreach($ufs as $uf){
            $selected = '';
            if( $uf == get_the_author_meta( 'uf', $user->ID ) )
              $selected = 'selected="slelected"';
            echo '<option value="' . $uf . '" ' . $selected . '>' . $uf . '</option>';
          }
        echo '</select>';
        ?>
        <span class="description"><?php _e('A quina uf pertanys?', 'wp-coop'); ?></span>
      </td>
    </tr>

    <?php
    /*
    <tr>
      <th><label for="uf"><?php _e('Unitat Familiar', 'wp-coop'); ?></label></th>

      <td>
        <input type="text" name="uf" id="uf" value="<?php echo esc_attr( get_the_author_meta( 'uf', $user->ID ) ); ?>" class="regular-text" /><br />
        <span class="description"><?php _e('A quina uf pertanys?.', 'wp-coop'); ?></span>
      </td>
    </tr>

    <tr>
      <th><label for="hobbies"><?php _e('What are your hobbies?', 'frontendprofile'); ?></label></th>
      <td>
      <?php $hobbies = get_the_author_meta( 'hobbies', $user->ID ); ?>
        <ul>
          <li><input value="videogames"           name="hobbies[]" <?php if (is_array($hobbies)) { if (in_array("videogames",           $hobbies)) { ?>checked="checked"<?php } }?> type="checkbox" /> <?php _e('Video Games',           'frontendprofile'); ?></li>
          <li><input value="sabotagingcapitalism" name="hobbies[]" <?php if (is_array($hobbies)) { if (in_array("sabotagingcapitalism", $hobbies)) { ?>checked="checked"<?php } }?> type="checkbox" /> <?php _e('Sabotaging Capitalism', 'frontendprofile'); ?></li>
          <li><input value="watchingtv"           name="hobbies[]" <?php if (is_array($hobbies)) { if (in_array("watchingtv",           $hobbies)) { ?>checked="checked"<?php } }?> type="checkbox" /> <?php _e('Watching TV',           'frontendprofile'); ?></li>
        </ul>
      </td>     
    </tr>
    */
    ?>
    <tr>
      <th><label for="es_menor"><?php _e('És menor de 16 anys?', 'wp-coop'); ?></label></th>
      <td>
      <?php $es_menor = get_the_author_meta( 'es_menor', $user->ID ); ?>
        <ul>
          <li><input value="yes" name="es_menor" <?php if ($es_menor == 'yes' ) { ?>checked="checked"<?php }?> type="radio" /> <?php _e('Si', 'wp-coop'); ?></li>
          <li><input value="no"  name="es_menor" <?php if ($es_menor == 'no'  ) { ?>checked="checked"<?php }?> type="radio" /> <?php _e('No',  'wp-coop'); ?></li>
        </ul>
      </td>     
    </tr>

    <tr>
      <th><label for="claus_local"><?php _e('Té una còpia de les claus del local', 'wp-coop'); ?></label></th>
      <td>
      <?php $claus_local = get_the_author_meta( 'claus_local', $user->ID ); ?>
        <ul>
          <li><input value="yes" name="claus_local" <?php if ($claus_local == 'yes' ) { ?>checked="checked"<?php }?> type="radio" /> <?php _e('Si', 'wp-coop'); ?></li>
          <li><input value="no"  name="claus_local" <?php if ($claus_local == 'no'  ) { ?>checked="checked"<?php }?> type="radio" /> <?php _e('No',  'wp-coop'); ?></li>
        </ul>
      </td>     
    </tr>
  </table>
  <h3><?php _e('Informació Exruscires', 'wp-coop'); ?></h3>
  <table class="form-table">
    <tr>
      <th><label for="coope_fins"><?php _e('Va deixar la coope...', 'wp-coop'); ?></label></th>
      <td>
        <input type="text" name="coope_fins" id="coope_fins" value="<?php echo esc_attr( get_the_author_meta( 'coope_fins', $user->ID ) ); ?>" class="regular-text" /><br />
        <span class="description"><?php _e('En quina data va deixar de ser Ruscaire?.', 'wp-coop'); ?></span>
      </td>
    </tr>
  </table>
<?php }

add_action( 'personal_options_update', 'save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_profile_fields' );

function save_extra_profile_fields( $user_id ) {
  if ( !current_user_can( 'edit_user', $user_id ) ) return false;

  update_usermeta( $user_id, 'uf', $_POST['uf'] );
  update_usermeta( $user_id, 'coope_desde', $_POST['coope_desde'] );
  update_usermeta( $user_id, 'es_menor', $_POST['es_menor'] );
  update_usermeta( $user_id, 'claus_local', $_POST['claus_local'] );
  update_usermeta( $user_id, 'coope_fins', $_POST['coope_fins'] );
}
