<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to ready_ecommerce_comment() which is
 * located in the functions.php file.
 *
 * @package Ready_ecommerce
 * @since Ready_ecommerce 0.1
 */
?>
	<div id="comments" style="display:none">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php lang::_e( 'This post is password protected. Enter the password to view any comments.' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 id="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number() ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text section-heading"><?php lang::_e( 'Comment navigation' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( lang::_( '&larr; Older Comments' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( lang::_( 'Newer Comments &rarr;' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use ready_ecommerce_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define ready_ecommerce_comment() and that will be used instead.
				 * See ready_ecommerce_comment() in ready_ecommerce/functions.php for more.
				 */
				wp_list_comments( array( 'callback' => 'ready_ecommerce_comment' ) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text section-heading"><?php lang::_e( 'Comment navigation' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( lang::_( '&larr; Older Comments' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( lang::_( 'Newer Comments &rarr;' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are no comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php lang::_e( 'Comments are closed.' ); ?></p>
	<?php endif; ?>
                
        <?php if (get_post_type() == 'product') {
                    $comments_args = array(
                        // change the title of send button 
                        'title_reply'=>'<h2>Leave a review</h2>',
                        // remove "Text or HTML to be displayed after the set of comment fields"
                        'comment_notes_after' => '',
                        'id_submit' => 'post_review',
                        'label_submit' => lang::_('Post Review'),
                        // redefine your own textarea (the comment body)
                        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Review', 'noun' ) . '</label><br /><textarea id="comment" rows="10" name="comment" aria-required="true"></textarea></p>',
                    );
                } else {
                    $comments_args = array('id_submit' => 'post_review');
                }

            ?>        
                
	<?php //comment_form($comments_args); ?>

</div><!-- #comments -->
