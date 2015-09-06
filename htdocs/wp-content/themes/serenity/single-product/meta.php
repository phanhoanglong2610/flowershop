<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post, $product;
?>
<div class="product_meta">
	<small>
		<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option('woocommerce_enable_sku') == 'yes' && $product->get_sku() ) : ?>
			<span itemprop="productID" class="sku"><?php _e('<strong>SKU</strong> <i class="icon-right-open-mini theme"></i>', 'woocommerce'); ?> <?php echo $product->get_sku(); ?></span>
		<?php endif; ?>
		<br>
		<?php echo $product->get_categories( ', ', ' <span class="posted_in">'.__('<strong>CATEGORY</strong> <i class="icon-right-open-mini theme"></i> ', 'woocommerce').' ', '</span>'); ?>
		<br>
		<?php echo $product->get_tags( ', ', ' <span class="tagged_as">'.__('<strong>TAGS</strong> <i class="icon-right-open-mini theme"></i>', 'woocommerce').' ', '</span>'); ?>
	</small>
</div>