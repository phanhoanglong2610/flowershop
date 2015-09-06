<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
$rating = esc_attr( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) );
?>
<li itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment_container general-block-outer comments-avatar the-gravatar">
		<div class="general-block-list">
		<?php echo get_avatar( $GLOBALS['comment'], $size='50', $default= THEME_DIR . '/images/avatar.png' ); ?>
		</div>
	</div>
	
	<div class="comment-text general-block-outer comments-text">
		<div class="general-block">

		<?php if ( get_option('woocommerce_enable_review_rating') == 'yes' ) : ?>

			<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf(__( 'Rated %d out of 5', 'woocommerce' ), $rating) ?>">
				<span style="width:<?php echo ( intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ) / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) ); ?></strong> <?php _e( 'out of 5', 'woocommerce' ); ?></span>
			</div>

		<?php endif; ?>

		<?php if ($GLOBALS['comment']->comment_approved == '0') : ?>
			<p class="meta"><span class="active-color"><em><?php _e( 'Your comment is awaiting approval', 'woocommerce' ); ?></em></span></p>
		<?php else : ?>
			<span class="name"><strong itemprop="author"><?php comment_author(); ?></strong></span>
			<span class="time">
				 <?php

					if ( get_option('woocommerce_review_rating_verification_label') == 'yes' )
						if ( woocommerce_customer_bought_product( $GLOBALS['comment']->comment_author_email, $GLOBALS['comment']->user_id, $post->ID ) )
							echo '<em class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</em> ';

				?><time itemprop="datePublished" datetime="<?php echo get_comment_date('c'); ?>"><?php echo get_comment_date(__( get_option('date_format'), 'woocommerce' )); ?></time>
			</span>
		<?php endif; ?>

		<div itemprop="description" class="description"><?php comment_text(); ?></div>
		<div class="clear"></div>
		</div>
	</div>
	<br class="clear" />
	