<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'selftitled'));

	if ( post_password_required() ) { 
	
		__('This post is password protected. Enter the password to view comments.', 'selftitled');
		
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	
	<h2 id="comments"><?php comments_number(__('No Responses', 'selftitled'), __('One Response', 'selftitled'), __('% Responses', 'selftitled'));?></h2>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>

	<ol class="commentlist">
		<?php wp_list_comments('type=comment&avatar_size=35'); ?>
	</ol>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- <p class="no_comments"><?php _e('Comments are closed.', 'selftitled'); ?></p> -->
	<?php endif; ?>
	
<?php endif; ?>

<?php

$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$args = array(
	'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<p class="comment-form-author">' .'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />' .  '<label for="author">' . __( 'Name', 'selftitled' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .'</p>',
		'email' => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /><label for="email">' . __( 'Email', 'selftitled' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '</p>',
		'url' => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"/> <label for="url">' . __( 'Website', 'selftitled' ) . '</label></p>' ) ) );
?>

<?php comment_form($args)?>