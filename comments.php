<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to comments_template() which is
 * located in the wp-coop/php/web_comments.php file.
 *
 * @subpackage wp-Coop
 */
?>
<?php
function formTextareaComment(){
    $str = '
    <div id="form-section-comment" class="form-section clearfix">
        <label for="comment">'.__('Comentari', 'wp-coop').':</label>
        <div class="form-textarea input">
            <textarea class="" id="comment" name="comment" cols="45" rows="5" tabindex="6" style="width:100%;"></textarea>';
            /*<!-- <p class="help-block">
                <span>.// _e('Podeu fer servir aquestes etiquetes i atributs <abbr title="HyperText Markup Language">HTML</abbr>:', 'wp-coop') ?></span> <code><?php // echo allowed_tags(); ?></code>
            </p> --> */
    $str .='
        </div>
    </div>';
    echo $str;
}
?>
<section id="comments">
	<?php /* Run some checks for bots and password protected posts */ ?>
	<?php
    $req = get_option('require_name_email'); // Checks if fields are required.
    if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
        die ( 'Please do not load this page directly. Thanks!' );
    if ( ! empty($post->post_password) ) :
        if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) :
?>
    <div class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'your-theme') ?></div>
</section><!-- .comments -->
<?php
        return;
    endif;
endif;
?>
 
<?php /* See IF there are comments and do the comments stuff! */ ?>
<?php if ( have_comments() ) : ?>
 
<?php /* Count the number of comments and trackbacks (or pings) */
$ping_count = $comment_count = 0;
foreach ( $comments as $comment )
    get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
?>
 
<?php /* IF there are comments, show the comments */ ?>
<?php if ( ! empty($comments_by_type['comment']) ) : ?>
	<div id="comments-list" class="comments">
    	<h3><?php printf($comment_count > 1 ? __('<span>%d</span> Comentaris', 'wp-coop') : __('<span>Un</span> Comentari', 'wp-coop'), $comment_count) ?></h3>
 
<?php /* If there are enough comments, build the comment navigation  */ ?>
<?php 
	$total_pages = get_comment_pages_count(); 
	if ( $total_pages > 1 ) : ?>
		<div id="comments-nav-above" class="comments-navigation">
            <div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
        </div><!-- #comments-nav-above -->
<?php 
	endif; ?>                   
 
<?php /* An ordered list of our custom comments callback, custom_comments(), in functions.php   */ ?>
        <ul class="unstyled"> 
			<?php wp_list_comments('type=comment&callback=custom_comments'); ?>
        </ul>
 
		<?php /* If there are enough comments, build the comment navigation */ ?>
		<?php $total_pages = get_comment_pages_count(); 
		if ( $total_pages > 1 ) : ?>
        <div id="comments-nav-below" class="comments-navigation">
        	<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
         </div><!-- #comments-nav-below -->
    <?php endif; ?>                   
 
                </div><!-- #comments-list .comments -->
 
<?php endif; /* if ( $comment_count ) */ ?>
 
	<?php /* If there are trackbacks(pings), show the trackbacks  */ ?>
	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
		<div id="trackbacks-list" class="comments">
            <h3><?php printf($ping_count > 1 ? __('<span>%d</span> Trackbacks', 'your-theme') : __('<span>One</span> Trackback', 'your-theme'), $ping_count) ?></h3>
			<?php /* An ordered list of our custom trackbacks callback, custom_pings(), in functions.php   */ ?>
            <ul class="unstyled">
				<?php wp_list_comments('type=pings&callback=custom_pings'); ?>
            </ul>             
        </div><!-- #trackbacks-list .comments -->           
	<?php endif /* if ( $ping_count ) */ ?>
<?php endif /* if ( $comments ) */ ?>
 
<?php /* If comments are open, build the respond form */ ?>
<?php if ( 'open' == $post->comment_status ) : ?>
    <div id="respond">
    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <p id="login-req"><?php printf(__('Has d\'estar <a href="%s" title="Log in">loguejat</a> per escriure un comentari.', 'wp-coop'),
                    get_option('siteurl') . '/wp-login.php?redirect_to=' . get_permalink() ) ?></p>
	<?php else : ?>
		<div class="formcontainer">
			<?php if ( $user_ID ) : ?>
            <form id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="form-stacked">
                <fieldset>
                <legend><?php comment_form_title( __('Fes un comentari', 'wp-coop'), __('Post a Reply to %s', 'wp-coop') ); ?></legend>

                <?php
                global $user_login , $user_email , $wp_rewrite;
                get_currentuserinfo();
                $avatar_link = get_option('siteurl').'/'.$wp_rewrite->author_base.'/'.$user_login;
                $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $user_email, 36 ) );    
                ?>
                <table class="condensed">
                    <tbody>
                        <tr>
                            <td class="avatar"><?php echo '<span class="media-grid"><a href="'.$avatar_link.'">'.$avatar.'</a></span>';?></td>
                            <td>
                                <div class="comment-author vcard">
                                    <?php 
                                    printf(__('<span class="loggedin">Connectat com <a href="%1$s" title="Connectat com %2$s">%2$s</a>.</span> <!-- <span class="logout"><a href="%3$s" title="Log out of this account">Sortir?</a>--></span>', 'wp-coop'),
                                    get_option('siteurl') . '/wp-admin/profile.php',
                                    wp_specialchars($user_identity, true),
                                    wp_logout_url(get_permalink()) ) ?>
                                    <div class="clear"></div>
                                </div>
                                <?php formTextareaComment(); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
			<?php else : ?>
            <form id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="stacked clearfix">
                <fieldset>
                <legend><?php comment_form_title( __('Fes un comentari', 'wp-coop'), __('Post a Reply to %s', 'wp-coop') ); ?></legend>
                <div class="input">
                    <span class="help-block"><?php _e('L\'adreça electrònica no es publicarà.', 'wp-coop') ?> <?php if ($req) _e('Els camps necessaris estan marcats amb <span class="required">*</span>', 'wp-coop') ?></span>
                </div>
                <div class="clearfix">
                    <label for="author">
                        <?php _e('Nom', 'wp-coop') ?> <span class="required">*</span>
                    </label>
                    <div class="input">
                        <input id="author" name="author" type="text" value="<?php echo $comment_author ?>" size="30" maxlength="20" tabindex="3" />
                    </div>
                </div>
                <div class="clearfix">
                    <label for="email">
                        <?php _e('Correu electrònic', 'wp-coop') ?> <span class="required">*</span>
                    </label>
                    <div class="input">
                        <input id="email" name="email" type="text" value="<?php echo $comment_author_email ?>" size="30" maxlength="50" tabindex="4" />
                    </div>
                </div>

                <div class="clearfix">
                    <label for="url">
                        <?php _e('Lloc web', 'wp-coop') ?>
                    </label>
                    <div class="input">
                        <input id="url" name="url" type="text" value="<?php echo $comment_author_url ?>" size="30" maxlength="50" tabindex="5" />
                    </div>
                </div>
                <?php formTextareaComment(); ?>
            <?php endif /* if ( $user_ID ) */ ?>
                <?php do_action('comment_form', $post->ID); ?>
                <div class="actions">
                   	<input id="submit" class="btn success" name="submit" type="submit" value="<?php _e('Envia un comentari', 'wp-coop') ?>" tabindex="7" />
                    <span id="cancel-comment-reply" class=""><?php cancel_comment_reply_link('cancel·lar la resposta') ?></span>
                   	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
                </div>
                <?php comment_id_fields(); ?>  
                <?php /* Just … end everything. We're done here. Close it up. */ ?>  
                </fieldset>
            </form><!-- #commentform -->
        </div><!-- .formcontainer -->
    <?php endif /* if ( get_option('comment_registration') && !$user_ID ) */ ?>
    </div><!-- #respond -->
<?php 
else:
    _e('No es poden fer comentaris, :(', 'wp-coop');
endif; /* if ( 'open' == $post->comment_status ) */ ?>
</section><!-- #comments -->
