<?php
/**
 * Order Tracking Form
 */
 
global $woocommerce, $post;
?>
<p class="info"><?php _e('To track your order please enter your Order ID in the box below and press return. This was given to you on your receipt and in the confirmation email you should have received.', ETHEME_DOMAIN); ?><span class="close-parent">close</span></p>
<form action="<?php echo esc_url( get_permalink($post->ID) ); ?>" method="post" class="login track-order-box">
	<div class="login-fields">
		<p class="form-row form-row-first login-head">
	            		<i class="icon-truck"></i>
	    				<span class="login-span-big">Want to know about your order status?</span>
	    				<span class="login-span-small">Please, enter further information</span>
	    			</p>
		<p class="form-row form-row-first"><label for="orderid"><?php _e('Enter your order ID', ETHEME_DOMAIN); ?></label> <input class="input-text" type="text" name="orderid" id="orderid" placeholder="<?php _e('Found in your order confirmation email.', ETHEME_DOMAIN); ?>" /></p>
		<p class="form-row form-row-last"><label for="order_email"><?php _e('Enter your billing E-mail address', ETHEME_DOMAIN); ?></label> <input class="input-text" type="text" name="order_email" id="order_email" placeholder="<?php _e('Email you used during checkout.', ETHEME_DOMAIN); ?>" /></p>
		<div class="clear"></div>
	</div>
	
	<p class="form-row"><input type="submit" class="button small arrow-right fl-r" name="track" value="<?php _e('Track"', ETHEME_DOMAIN); ?>" /></p>
	<?php $woocommerce->nonce_field('order_tracking') ?>
	
</form>