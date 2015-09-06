<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */
global $woocommerce, $product;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<?php if ( comments_open() ) : ?><div id="reviews"><?php

	echo '<div id="comments">';

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$count = $product->get_rating_count();

		if ( $count > 0 ) {

			$average = $product->get_average_rating();

			echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

			echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';

			echo '<h4>'.sprintf( _n('%s review for %s', '%s reviews for %s', $count, 'woocommerce'), '<span itemprop="ratingCount" class="count">'.$count.'</span>', wptexturize($post->post_title) ).'</h4>';

			echo '</div>';

		} else {

			echo '<h4>'.__( 'Reviews', 'woocommerce' ).'</h4>';

		}

	} else {

		echo '<h4>'.__( 'Reviews', 'woocommerce' ).'</h4>';

	}

	$title_reply = '';

	if ( have_comments() ) :

		echo '<ol class="commentlist">';

		wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );

		echo '</ol>';

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'woocommerce' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'woocommerce' ) ); ?></div>
			</div>
		<?php endif;

		echo '<p class="add_review"><a href="#review_form" class="inline show_review_form button comments-button">' . __( 'Add Review', 'woocommerce' ) . '</a></p>';

		$title_reply = __( 'Add a review', 'woocommerce' );

	else :

		$title_reply = __( 'Be the first to review', 'woocommerce' ).' &ldquo;'.$post->post_title.'&rdquo;';

		echo '<p class="noreviews">'.__( 'There are no reviews yet, would you like to <a href="#review_form" class="inline show_review_form">submit yours</a>?', 'woocommerce' ).'</p>';

	endif;

	$commenter = wp_get_current_commenter();

	echo '</div><div id="review_form_wrapper"><div id="review_form" class="comment-form-container">';

	$comment_form = array(
		'title_reply' => $title_reply,
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => array(
			'author' => '<div class="comments-avatar" style="margin-top: 10px;"></div>
						<div class="comments-text other-fields" style="width: 70%;">
						<div class="one-half form-name float-left comment-form-author" style="margin-bottom: 20px;">
						<label for="author">' . __( 'Name', 'woocommerce' ) . '</label> ' . '<span class="required">*</span>
						<div class="general-field formfield-container">
						<input class="required" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" />
						</div>
						</div>',
			'email'  => '<div class="one-half last form-name float-right comment-form-email" style="margin-bottom: 20px;">
						<label for="email">' . __( 'Email', 'woocommerce' ) . '</label> ' . '<span class="required">*</span>
						<div class="general-field formfield-container">
						<input class="required" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" />
						</div>
						</div>
						</div>
						<div class="clear"></div>',
		),
		'label_submit' => __( 'Submit Review', 'woocommerce' ),
		'logged_in_as' => '',
		'comment_field' => ''
	);
	
	$comment_form['comment_field'] = '';
	
	if ( is_user_logged_in() )
	$comment_form['comment_field'] = '<div class="comments-avatar" style="margin-top: 0"></div>';

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
		$comment_form['comment_field'] .= '<div class="comment-form-rating form-name" style="margin: 0 0 20px 60px;"><label for="rating">' . __( 'Rating', 'woocommerce' ) .'</label><select name="rating" id="rating">
			<option value="">'.__( 'Rate&hellip;', 'woocommerce' ).'</option>
			<option value="5">'.__( 'Perfect', 'woocommerce' ).'</option>
			<option value="4">'.__( 'Good', 'woocommerce' ).'</option>
			<option value="3">'.__( 'Average', 'woocommerce' ).'</option>
			<option value="2">'.__( 'Not that bad', 'woocommerce' ).'</option>
			<option value="1">'.__( 'Very Poor', 'woocommerce' ).'</option>
		</select></div>';
	}

	$comment_form['comment_field'] .= '<div class="clear"></div><div class="general-field comments-text comment-form-comment" style="margin: 0 0 14px 60px; width: 70%;"><textarea class="required txtarea-comment" id="comment" name="comment" cols="20" rows="4" aria-required="true"></textarea></div><div class="clear"></div><div class="float-left" style="margin-left: 56px;">&nbsp;</div>' . $woocommerce->nonce_field('comment_rating', true, false);

	comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );

	echo '</div></div>';

?><div class="clear"></div></div>
<?php endif; ?>