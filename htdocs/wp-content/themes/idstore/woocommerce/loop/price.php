<?php
/**
 * Loop Price
 */

global $product;
?>

<?php if ($price_html = $product->get_price_html()) : ?>
	<div class="price"><?php echo $price_html; ?></div>
<?php endif; ?>