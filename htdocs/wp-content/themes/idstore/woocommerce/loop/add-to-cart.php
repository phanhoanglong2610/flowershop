<?php
/**
 * Loop Add to Cart
 */
 
global $product; 

if( $product->get_price() === '' && $product->product_type != 'external' ) return;
?>

<?php if ( ! $product->is_in_stock() ) : ?>
		
	<div class="btn-cont"><a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ); ?>" class="button"><span><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Read More', ETHEME_DOMAIN ) ); ?></span></a></div>

<?php else : ?>
	
	<?php 
	
		switch ( $product->product_type ) {
			case "variable" :
				$link 	= apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
				$label 	= apply_filters( 'variable_add_to_cart_text', __('Select options', ETHEME_DOMAIN) );
			break;
			case "grouped" :
				$link 	= apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
				$label 	= apply_filters( 'grouped_add_to_cart_text', __('View options', ETHEME_DOMAIN) );
			break;
			case "external" :
				$link 	= apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
				$label 	= apply_filters( 'external_add_to_cart_text', __('Read More', ETHEME_DOMAIN) );
			break;
			default :
				$link 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
				$label 	= apply_filters( 'add_to_cart_text', __('Add to cart', ETHEME_DOMAIN) );
			break;
		}
	
		printf('<div class="btn-cont"><a href="%s" rel="nofollow" data-product_id="%s" class="button etheme_add_to_cart_button product_type_%s"><span>%s</span></a></div>', $link, $product->id, $product->product_type, $label);

	?>

<?php endif; ?>