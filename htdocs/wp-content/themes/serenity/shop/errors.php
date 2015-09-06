<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! $errors ) return;
?>
<div class="wrap">
<div class="woocommerce_error alert alert-danger">
	<?php foreach ( $errors as $error ) : ?>
		<div><?php echo $error; ?></div>
	<?php endforeach; ?>
</div>	
</div>