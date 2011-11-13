<?php
/**
New Roles and Capabilities - Only run once!

I keep these handy, this is the right way to do them without a plugin. They set a single field (prefix_user_roles) in the options database, and you don't need a plugin to set them. Refer to the Codex page for a list of what capabilities are available and descriptions for what they do. You only need to uncomment one of these blocks, load any page and then comment them again! Here I'm creating a role that's got the capabilities I need:
*/
/* Capabilities */

// To add the new role, using 'international' as the short name and
// 'International Blogger' as the displayed name in the User list and edit page:
/**/
add_role('ruscaire', 'Ruscaire', array(
    'read' => true, // True allows that capability, False specifically removes it.
    'edit_posts' => true,
    'delete_posts' => true,
    'edit_published_posts' => true,
    'publish_posts' => true,
    
    'edit_receptes' => true,
    'delete_receptes' => true,
    'edit_published_receptes' => true,
    'publish_receptes' => true,
    
    'edit_files' => true,
    'import' => true,
    'upload_files' => true //last in array needs no comma!
));

add_role('exruscaire', 'Exruscaire', array(
    'read' => true
));

add_role('espera', 'En llista Espera', array(
    'read' => true
));

// To remove one outright or remove one of the defaults:
/* 
remove_role('editor');
remove_role('author');
remove_role('contributor');
remove_role('subscriber');

*/
/**
It's sometimes handy to add/remove from an existing role rather than removing and re-adding one. Again, you only need to uncomment it, reload a page and then comment it again. This will store the role/capability properly in the options table. (This allows you, the developer to control them and removes the overhead of the bulky plugins that do the same thing.) Here I'm changing the author role to delete their published posts (the default), but allowing them the capability to edit their published posts (which isn't possible for this role by default)-- using *add_cap* or *remove_cap*.
**/
/*
$edit_role = get_role('ruscaire');
$edit_role->add_cap('read_private_posts');
$edit_role->add_cap('read_private_pages');
*/
//$edit_role->remove_cap('delete_published_posts');


// Change URL Slug from Author to Cens
/**/
function new_author_base() {
    global $wp_rewrite;
    $author_slug = 'cens';
    $wp_rewrite->author_base = $author_slug;
}
add_action('init', 'new_author_base');

//only run once
