<?php
// http://wp.smashingmagazine.com/2011/10/07/definitive-guide-wordpress-hooks/

function authorNotification($post_id) {
   global $wpdb;
   $post = get_post($post_id);
   $author = get_userdata($post->post_author);

   $message = "
      Hi ".$author->display_name.",
      Your post, ".$post->post_title." has just been published. Well done!
   ";
   wp_mail($author->user_email, "Your article is online", $message);
}
//add_action('publish_post', 'authorNotification');