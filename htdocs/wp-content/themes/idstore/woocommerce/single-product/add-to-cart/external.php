<?php
/**
 * External Add to Cart
 */
?>
<?php do_action('woocommerce_before_add_to_cart_button'); ?>

<p class="cart"><a href="<?php echo $product_url; ?>" rel="nofollow" class="button big active"><span><?php echo apply_filters('single_add_to_cart_text', $button_text, 'external'); ?></span></a></p>
<div class="clear"></div><hr />
<?php do_action('woocommerce_after_add_to_cart_button'); ?>