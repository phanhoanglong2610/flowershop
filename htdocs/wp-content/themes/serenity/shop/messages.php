<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! $messages ) return;
?>

<?php foreach ( $messages as $message ) : ?>
	<div class="wrap"><div class="woocommerce_message tleft alert alert-success"><?php echo $message; ?></div></div>
<?php endforeach; ?>
