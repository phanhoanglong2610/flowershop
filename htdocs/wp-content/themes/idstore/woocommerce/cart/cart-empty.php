<?php
/**
 * Empty Cart Page
 */
?>

<?php do_action('woocommerce_cart_is_empty'); ?>

<div class="empty-cart-block">
	<i class="icon-shopping-cart"></i>
	
	<?php etheme_option('empty_cart_content'); ?>	
	<p><a class="button arrow-left" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><span><?php _e('Return To Shop', ETHEME_DOMAIN) ?></span></a></p>
	
</div>