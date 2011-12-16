<?php
/**
@link: http://themeshaper.com/wordpress-theme-comments-template-tutorial/
**/
// Custom callback to list comments in the your-theme style
function custom_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
    $GLOBALS['comment_depth'] = $depth;
  ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
        <table class="condensed">
            <tbody>
                <tr>
                    <td class="avatar"><?php commenter_avatar() ?></td>
                    <td>
                        <div class="comment-author vcard">
                            <?php commenter_link() ?>
                            <div class="comment-meta">
                            <?php printf(__('%1$s a les %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Enllaç permanent a aquest comentari">&infin;</a>', 'wp-coop'),
                                    get_comment_date(),
                                    get_comment_time(),
                                    '#comment-' . get_comment_ID() );
                                    edit_comment_link(__('Editar comentari', 'wp-coop'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="comment-content ">
                            <?php comment_text() ?>
                            <?php // echo the comment reply link
                            if($args['type'] == 'all' || get_comment_type() == 'comment') :
                                comment_reply_link(array_merge($args, array(
                                    'reply_text' => __('Respon','wp-coop'),
                                    'login_text' => __('Entra per respondre.','wp-coop'),
                                    'depth' => $depth,
                                    'before' => '<small class="comment-reply-link btn success small">',
                                    'after' => '</small>'
                                )));
                            endif;
                            ?>
                            
                        </div>
                        
                            <?php 
                            if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='label'>El teu comentari està en espera de moderació.</span>\n", 'wp-coop') ?>
                    </td>
                </tr>
            </tbody>
        </table>
        
        
<?php } // end custom_comments

// Custom callback to list pings
function custom_pings($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
            	<blockquote>
                
    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'your-theme') ?>
            	<p class="comment-content">
                	<?php comment_text() ?>
            	</p>
            	<small class="comment-author">
                <?php printf(__('By %1$s on %2$s at %3$s', 'your-theme'),
                        get_comment_author_link(),
                        get_comment_date(),
                        get_comment_time() );
                        edit_comment_link(__('Edit', 'your-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?>
                </small>
            <blockquote>
          </li>
<?php } // end custom_pings ?>

<?php

// Produces an avatar image with the hCard-compliant photo class
function commenter_link() {
    $info_user = get_user_by('email', get_comment_author_email() );
    if ($info_user) {
        global $wp_rewrite;
        $info_user_url = get_option('siteurl').'/'.$wp_rewrite->author_base.'/'.$info_user->user_login;
        $info_user_role = '';
        foreach ($info_user->wp_capabilities as $key => $value) {
            $lbl_class='';
            if($key == 'ruscaire') $lbl_class='new';
            if($key == 'proveidor-arc_natura') $lbl_class='notice';
            $info_user_role .= '<span class="label '.$lbl_class.'">'.$key.'</span>';
        }
        $commenter = '<a href="'.$info_user_url.'">'.$info_user->display_name.' '.$info_user_role.'</a>';
        
    } else {
        $commenter = get_comment_author_link();
        if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
            $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
        } else {
            $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
        }
    }
    echo '<span class="fn n">' . $commenter . '</span>';
} // end commenter_link
?>

<?php
// Produces an avatar image
function commenter_avatar() {
    $avatar_email = get_comment_author_email();
    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 36 ) );
    $info_user = get_user_by('email', get_comment_author_email() );
    if ($info_user) {
        global $wp_rewrite;
        $info_user_url = get_option('siteurl').'/'.$wp_rewrite->author_base.'/'.$info_user->user_login;
        $commenter = '<a href="'.$info_user_url.'">'.$avatar . '</a>';
    } else {
        $commenter ='';
    }
    
    echo '<span class="media-grid">' . $commenter . '</span>';
} // end commenter_avatar
?>