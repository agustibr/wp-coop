<?php 
function update_contact_methods( $contactmethods ) {

  // Remove annoying and unwanted default fields  
  unset($contactmethods['aim']);  
  unset($contactmethods['jabber']);  
  unset($contactmethods['yim']);  

  // Add new fields  
  $contactmethods['uf'] = _('Unitat Familiar');
  $contactmethods['coope_desde'] = _('A la coope desde ...');  
  $contactmethods['telefon'] = _('Telèfon');  
  $contactmethods['address'] = _('Addreça');
  $contactmethods['es_menor'] = _('És menor de 16 anys?');
  return $contactmethods;
}

add_filter('user_contactmethods','update_contact_methods');

/*
<div class="author-box">
   <div class="author-pic"><?php echo get_avatar( get_the_author_email(), '80' ); ?></div>
   <div class="author-name"><?php the_author_meta( "display_name" ); ?></div>
   <div class="author-bio"><?php the_author_meta( "user_description" ); ?></div>
</div>
*/
