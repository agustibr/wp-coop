<?php

// http://foolswisdom.com/wp-activate-theme-actio/

global $pagenow;
if (is_admin() && $pagenow  === 'themes.php' && isset( $_GET['activated'])) {

  // on theme activation make sure there's a Home page
  // create it if there isn't and set the Home page menu order to -1
  // set WordPress to have the front page display the Home page as a static page
  $default_pages = array('Inici','RegistreRuscaire','LListaEspera','Cens');
  $existing_pages = get_pages();
  $temp = array();

  foreach ($existing_pages as $page) {
    $temp[] = $page->post_title;
  }

  $pages_to_create = array_diff($default_pages, $temp);

  foreach ($pages_to_create as $new_page_title) {

    // create post object
    $add_default_pages = array(
      'post_title' => $new_page_title,
      'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consequat, orci ac laoreet cursus, dolor sem luctus lorem, eget consequat magna felis a magna. Aliquam scelerisque condimentum ante, eget facilisis tortor lobortis in. In interdum venenatis justo eget consequat. Morbi commodo rhoncus mi nec pharetra. Aliquam erat volutpat. Mauris non lorem eu dolor hendrerit dapibus. Mauris mollis nisl quis sapien posuere consectetur. Nullam in sapien at nisi ornare bibendum at ut lectus. Pellentesque ut magna mauris. Nam viverra suscipit ligula, sed accumsan enim placerat nec. Cras vitae metus vel dolor ultrices sagittis. Duis venenatis augue sed risus laoreet congue ac ac leo. Donec fermentum accumsan libero sit amet iaculis. Duis tristique dictum enim, ac fringilla risus bibendum in. Nunc ornare, quam sit amet ultricies gravida, tortor mi malesuada urna, quis commodo dui nibh in lacus. Nunc vel tortor mi. Pellentesque vel urna a arcu adipiscing imperdiet vitae sit amet neque. Integer eu lectus et nunc dictum sagittis. Curabitur commodo vulputate fringilla. Sed eleifend, arcu convallis adipiscing congue, dui turpis commodo magna, et vehicula sapien turpis sit amet nisi.',
      'post_status' => 'publish',
      'post_type' => 'page'
    );

    // insert the post into the database
    $result = wp_insert_post($add_default_pages);
  }

  $home = get_page_by_title('Inici');
  update_option('show_on_front', 'page');
  update_option('page_on_front', $home->ID);

  $home_menu_order = array(
    'ID' => $home->ID,
    'menu_order' => -1
  );
  wp_update_post($home_menu_order);

  // set the permalink structure
  if (get_option('permalink_structure') !== '/%year%/%postname%/') {
    update_option('permalink_structure', '/%year%/%postname%/');
  }

  $wp_rewrite->init();
  $wp_rewrite->flush_rules();

  // ROLES :
  add_role('ruscaire', 'Ruscaire', array(

    'read' => true, // True allows that capability, False specifically removes it.
    'publish_posts' => true,
    'edit_posts' => true,
    'delete_posts' => true,
    'edit_published_posts' => true,
    'read_private_posts' => true,

    //'publish_pages' => true,
    //'edit_pages' => true,
    //'delete_pages' => true,
    'read_private_pages' => true,

    'read_cistelles' => true,
    'publish_cistelles' => true,
    'edit_cistelles' => true,
    'edit_others_cistelles' => false,
    'delete_cistelles' => true,
    'delete_others_cistelles' => true,
    'read_private_cistelles' => true,
    'edit_published_cistelles' => true,

    'read_receptes' => true,
    'publish_receptes' => true,
    'edit_receptes' => true,
    'edit_others_receptes' => false,
    'delete_receptes' => true,
    'delete_others_receptes' => true,
    'read_private_receptes' => true,
    'edit_published_receptes' => true,

    'edit_files' => true,
    //'import' => false,
    'upload_files' => true,
  ));

  add_role('proveidor-arc_natura', 'Proveidor - Arc de la Natura', array(

    'read' => true,

    'read_receptes' => true,
    'publish_receptes' => true,
    'edit_receptes' => true,

    'publish_cistelles' => true,
    'edit_cistelles' => true,
    'delete_cistelles' => true,
    'read_private_cistelles' => true,
    'read_cistelles' => true,
    'edit_published_cistelles' => true,
  ));


  add_role('exruscaire', 'Exruscaire', array(

    'read' => true,

    'publish_receptes' => true,
    'edit_receptes' => true,

  ));

  add_role('espera', 'En llista Espera', array(
    'read' => true
  ));

  //add to admin caps for managing cpt !
  $edit_role = get_role('administrator');
  $edit_role->add_cap('publish_receptes');
  $edit_role->add_cap('edit_receptes');
  $edit_role->add_cap('edit_others_receptes');
  $edit_role->add_cap('read_cistelles');
  $edit_role->add_cap('publish_cistelles');
  $edit_role->add_cap('edit_cistelles');
  $edit_role->add_cap('edit_others_cistelles');

  /// To remove one outright or remove one of the defaults:
  remove_role('editor');
  remove_role('author');
  remove_role('contributor');

}
