<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to humbleshop_comment() which is
 * located in the functions.php file.
 *
 * @package humbleshop
 * @since tendershop 1.0
 */
?>

<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
?>

	<!-- Comments -->

	<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h5 class="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'humbleshop' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h5>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'humbleshop' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'humbleshop' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'humbleshop' ) ); ?></div>
		</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

		<div class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use humbleshop_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define humbleshop_comment() and that will be used instead.
				 * See humbleshop_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'humbleshop_comment' ) );
			?>
		</div><!-- .commentlist -->
		<hr>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'humbleshop' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'humbleshop' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'humbleshop' ) ); ?></div>
		</nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments tcenter"><?php _e( 'Comments are closed.', 'humbleshop' ); ?></p>
	<?php endif; ?>

	<?php if ( comments_open() ) : ?>
 		
		<div id="respond">
		 
		<div class="clearfix">
			<div class="pull-left"><h5><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h5></div>
			<div class="pull-right"><small><?php cancel_comment_reply_link(); ?></small></div>
		</div>
		 
		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p class="alert"> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php echo ot_get_option( 'hs_Lng_Comment_alert' ); ?></a> </p>
		<?php else : ?>
		 
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="form-horizontal">
		 
		<?php if ( is_user_logged_in() ) : ?>
		 
			<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out<i class="icon-right-open-mini"></i></a></p>
			 
			<?php else : //this is where we setup the comment input forums ?>
			 
			<div class="control-group">
				<label for="author" class="control-label"><?php echo ot_get_option( 'hs_Lng_Comment_Name' ); ?> <?php if ($req) echo "*"; ?></label>
				<div class="controls">
				<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" class="inputum" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> placeholder="John Doe"/>	
				</div>
			</div>

			<div class="control-group">
				<label for="email" class="control-label"><?php echo ot_get_option( 'hs_Lng_Comment_Mail' ); ?> <?php if ($req) echo "*"; ?></label>
				<div class="controls">
				<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" class="inputum" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> placeholder="hello@johndoe.com"/>	
				</div>
			</div>
			 
			<div class="control-group">
				<label for="url" class="control-label"><?php echo ot_get_option( 'hs_Lng_Comment_Website' ); ?> </label>
			 	<div class="controls">
			 	<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" class="inputum" size="22" tabindex="3" placeholder="www.yoursiteadress.com"/>		
			 	</div>
			 </div>
			 
			<?php endif; ?>
			 
			<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
			
			<div class="control-group">
				<label for="comment" class="control-label"><?php echo ot_get_option( 'hs_Lng_Comment_Message' ); ?> <?php if ($req) echo "*"; ?></label>
			 	<div class="controls">
			 	<textarea name="comment" id="comment" class="inputum" cols="100%" rows="5" tabindex="4"></textarea>
			 	</div>
			</div> 
			
			<div class="control-group">
				<div class="controls">
					<input name="submit" type="submit" id="submit" tabindex="5" value="Submit" class="btn"/>
					<?php comment_id_fields(); ?>
				</div>
			</div>	

			<?php do_action('comment_form', $post->ID); ?>
			 
			</form>
		 
		<?php endif; // If registration required and not logged in ?>
		</div>
	 
	<?php endif; // if you delete this the sky will fall on your head ?>

</div><!-- #comments .comments-area -->
