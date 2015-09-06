<?php
/**
 * Review Order
 */
 
global $woocommerce;

$available_methods = $woocommerce->shipping->get_available_shipping_methods();
?>
<div id="order_review">
	
	<table class="checkout_cart table">
		<thead>
			<tr>
				<th class="product-name"><?php _e('Product', ETHEME_DOMAIN); ?></th>
				<th class="product-quantity"><?php _e('Qty', ETHEME_DOMAIN); ?></th>
				<th class="product-total"><?php _e('Totals', ETHEME_DOMAIN); ?></th>
			</tr>
		</thead>

		<tbody>
			<?php
				if (sizeof($woocommerce->cart->get_cart())>0) : 
					foreach ($woocommerce->cart->get_cart() as $item_id => $values) :
						$_product = $values['data'];
						if ($_product->exists() && $values['quantity']>0) :
							echo '
								<tr class = "' . esc_attr( apply_filters('woocommerce_checkout_table_item_class', 'checkout_table_item', $values, $item_id ) ) . '">
									<td class="product-name">'.$_product->get_title().$woocommerce->cart->get_item_data( $values ).'</td>
									<td class="product-quantity">'.$values['quantity'].'</td>
									<td class="product-total">' . apply_filters( 'woocommerce_checkout_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $item_id ) . '</td>
								</tr>';
						endif;
					endforeach; 
				endif;

				do_action( 'woocommerce_cart_contents_review_order' );
			?>
		</tbody>
	</table>
	<table class="fl-r wc-checkout-totals">
	
		<tr class="cart-subtotal">
			<th colspan="2"><strong><?php _e('Cart Subtotal', ETHEME_DOMAIN); ?></strong></th>
			<td><?php echo $woocommerce->cart->get_cart_subtotal(); ?></td>
		</tr>
		
		<?php if ($woocommerce->cart->get_discounts_before_tax()) : ?>
		
		<tr class="discount">
			<th colspan="2"><?php _e('Cart Discount', ETHEME_DOMAIN); ?></th>
			<td>-<?php echo $woocommerce->cart->get_discounts_before_tax(); ?></td>
		</tr>
		
		<?php endif; ?>
		
			<?php if ( $woocommerce->cart->needs_shipping() && $woocommerce->cart->show_shipping() ) : ?>

				<?php do_action('woocommerce_review_order_before_shipping'); ?>

				<tr class="shipping">
					<th class="shipping-methods" colspan="3"><?php _e( 'Shipping', ETHEME_DOMAIN ); ?> <?php woocommerce_get_template( 'cart/shipping-methods.php', array( 'available_methods' => $available_methods ) ); ?></th>
				</tr>

				<?php do_action('woocommerce_review_order_after_shipping'); ?>

			<?php endif; ?>
		
		<?php 
			if ($woocommerce->cart->get_cart_tax()) :
				
				$taxes = $woocommerce->cart->get_formatted_taxes();
				
				if (sizeof($taxes)>0) :
				
					$has_compound_tax = false;
					
					foreach ($taxes as $key => $tax) : if ($woocommerce->cart->tax->is_compound( $key )) : $has_compound_tax = true; continue; endif;

						?>
						<tr class="tax-rate tax-rate-<?php echo $key; ?>">
							<th colspan="2"><?php 
								if ( get_option('woocommerce_prices_include_tax') == 'yes' ) 
									_e('incl.&nbsp;', ETHEME_DOMAIN); 
								echo $woocommerce->cart->tax->get_rate_label( $key ); 
							?></th>
							<td><?php echo $tax; ?></td>
						</tr>
						<?php
						
					endforeach;
					
					if ($has_compound_tax && !$woocommerce->cart->prices_include_tax) :
						?>
						<tr class="order-subtotal">
							<th colspan="2"><strong><?php _e('Order Subtotal', ETHEME_DOMAIN); ?></strong></th>
							<td><?php echo $woocommerce->cart->get_cart_subtotal( true ); ?></td>
						</tr>
						<?php
					endif;
					
					foreach ($taxes as $key => $tax) : if (!$woocommerce->cart->tax->is_compound( $key )) continue;

						?>
						<tr class="tax-rate tax-rate-<?php echo $key; ?>">
							<th colspan="2"><?php 
								if ( get_option('woocommerce_prices_include_tax') == 'yes' ) 
									_e('incl.&nbsp;', ETHEME_DOMAIN); 
								echo $woocommerce->cart->tax->get_rate_label( $key ); 
							?></th>
							<td><?php echo $tax; ?></td>
						</tr>
						<?php
						
					endforeach;
				
				else :
				
					?>
					<tr class="tax">
						<th colspan="2"><?php echo $woocommerce->countries->tax_or_vat(); ?></th>
						<td><?php echo $woocommerce->cart->get_cart_tax(); ?></td>
					</tr>
					<?php
				
				endif;	
			elseif ( get_option( 'woocommerce_display_cart_taxes_if_zero' ) == 'yes' ) :
			?>

				<tr class="tax">
					<th colspan="2"><?php echo $woocommerce->countries->tax_or_vat(); ?></th>
					<td><?php _ex( 'N/A', 'Relating to tax', ETHEME_DOMAIN ); ?></td>
				</tr>

			<?php
			endif;
		?>

		<?php if ($woocommerce->cart->get_discounts_after_tax()) : ?>
		
		<tr class="discount">
			<th colspan="2"><?php _e('Order Discount', ETHEME_DOMAIN); ?></th>
			<td>-<?php echo $woocommerce->cart->get_discounts_after_tax(); ?></td>
		</tr>
		
		<?php endif; ?>
		
		<?php do_action('woocommerce_before_order_total'); ?>
		
		<tr class="total">
			<th colspan="2"><strong><?php _e('Order Total', ETHEME_DOMAIN); ?></strong></th>
			<td><strong><?php echo $woocommerce->cart->get_total(); ?></strong></td>
		</tr>
		
		<?php do_action('woocommerce_after_order_total'); ?>
		
	</table>
    
    <div class="clear"></div>
    	
	<div id="payment">
		<?php if ($woocommerce->cart->needs_payment()) : ?>
		<ul class="payment_methods methods">
			<?php 
				$available_gateways = $woocommerce->payment_gateways->get_available_payment_gateways();
				if ($available_gateways) : 
					// Chosen Method
					if (sizeof($available_gateways)) :
						$default_gateway = get_option('woocommerce_default_gateway');
						if (isset($_SESSION['_chosen_payment_method']) && isset($available_gateways[$_SESSION['_chosen_payment_method']])) :
							$available_gateways[$_SESSION['_chosen_payment_method']]->set_current();
						elseif (isset($available_gateways[$default_gateway])) :
							$available_gateways[$default_gateway]->set_current();
						else :
							current($available_gateways)->set_current();
						endif;
					endif;
					foreach ($available_gateways as $gateway ) :
						?>
						<li>
						<input type="radio" id="payment_method_<?php echo $gateway->id; ?>" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php if ($gateway->chosen) echo 'checked="checked"'; ?> />
						<label for="payment_method_<?php echo $gateway->id; ?>"><?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?></label> 
							<?php
								if ( $gateway->has_fields() || $gateway->get_description() ) : 
									echo '<div class="payment_box payment_method_'.$gateway->id.'" style="display:none;">';
									$gateway->payment_fields();
									echo '</div>';
								endif;
							?>
						</li>
						<?php
					endforeach;
				else :
				
					if ( !$woocommerce->customer->get_country() ) :
						echo '<p>'.__('Please fill in your details above to see available payment methods.', ETHEME_DOMAIN).'</p>';
					else :
						echo '<p>'.__('Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', ETHEME_DOMAIN).'</p>';
					endif;
					
				endif;
			?>
		</ul>
		<?php endif; ?>

		<div class="form-row place-order">
		
			<noscript><?php _e('Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', ETHEME_DOMAIN); ?><br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php _e('Update totals', ETHEME_DOMAIN); ?>" /></noscript>
		
			<?php $woocommerce->nonce_field('process_checkout')?>
			
			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>
			
			<?php if (woocommerce_get_page_id('terms')>0) : ?>
			<p class="form-row terms">
				<label for="terms" class="checkbox"><?php _e('I accept the', ETHEME_DOMAIN); ?> <a href="<?php echo esc_url( get_permalink(woocommerce_get_page_id('terms')) ); ?>" target="_blank"><?php _e('terms &amp; conditions', ETHEME_DOMAIN); ?></a></label>
				<input type="checkbox" class="input-checkbox" name="terms" <?php if (isset($_POST['terms'])) echo 'checked="checked"'; ?> id="terms" />
			</p>
			<?php endif; ?>
			
			<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="<?php echo apply_filters('woocommerce_order_button_text', __('Place order', ETHEME_DOMAIN)); ?>" />
			
			
			<?php do_action( 'woocommerce_review_order_after_submit' ); ?>
			
		</div>
		
		<div class="clear"></div>

	</div>
	
</div>