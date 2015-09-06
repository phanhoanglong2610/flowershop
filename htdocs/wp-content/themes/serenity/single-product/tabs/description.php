<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce, $post;

if ( $post->post_content ) : ?>
	<div class="tab-pane panel entry-content" id="tab-description">

		<?php $heading = apply_filters('woocommerce_product_description_heading', __('Product Description', 'woocommerce')); ?>

		<h5><?php //echo $heading; ?></h5>

		<?php the_content(); ?>

	</div>
<?php endif; ?>