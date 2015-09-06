<?php
/**
 * Checkout login form
 */

if ( is_user_logged_in() ) return;
if ( get_option('woocommerce_enable_signup_and_login_from_checkout') == "no" ) return;

?>

<?php woocommerce_login_form( array( 'message' => __('If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', ETHEME_DOMAIN), 'redirect' => get_permalink(woocommerce_get_page_id('checkout')) ) ); ?>