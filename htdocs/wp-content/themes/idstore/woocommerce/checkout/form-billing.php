<?php
/**
 * Checkout Billing Information Form
 */
global $woocommerce;
?>

<?php if ( $woocommerce->cart->ship_to_billing_address_only() && $woocommerce->cart->needs_shipping() ) : ?>
	
	<h3><?php _e('Billing &amp; Shipping', ETHEME_DOMAIN); ?></h3>
	
<?php else : ?>

	<h3><?php _e('Billing Address', ETHEME_DOMAIN); ?></h3>

<?php endif; ?>

<?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>

<?php foreach ($checkout->checkout_fields['billing'] as $key => $field) : ?>
	
	<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>	
	
<?php endforeach; ?>

<?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>