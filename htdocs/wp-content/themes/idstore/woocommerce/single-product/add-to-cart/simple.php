<?php
/**
 * Simple Product Add to Cart
 */
 
global $woocommerce, $product;

if( $product->get_price() === '') return;
$ajax_addtocart = etheme_get_option('ajax_addtocart');
?>
<div class="addto-container">

    <?php if ( $product->is_in_stock() ) : ?>
    
    	<?php do_action('woocommerce_before_add_to_cart_form'); ?>
    	
    	<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" id="simple-product-form" class="cart" method="post" enctype='multipart/form-data'>
    
    	 	<?php do_action('woocommerce_before_add_to_cart_button'); ?>
    
    	 	<?php 
    	 		if ( ! $product->is_sold_individually() ) 
    	 			woocommerce_quantity_input( array( 'min_value' => 1, 'max_value' => $product->backorders_allowed() ? '' : $product->get_stock_quantity() ) ); 
    	 	?>
            <input type="hidden" name="simple-product-id" id="simple-product-id" value="<?php echo $product->id ?>"/>
    	 	<button type="submit" class="button big active <?php if($ajax_addtocart){?> etheme-simple-product <?php } ?>"><span><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', ETHEME_DOMAIN), $product->product_type); ?></span></button>
    
    	 	<?php do_action('woocommerce_after_add_to_cart_button'); ?>
    	 	
    	</form>
    	
    	<?php do_action('woocommerce_after_add_to_cart_form'); ?>
    	
    <?php endif; ?>
</div>
<div class="clear"></div>
<hr/>