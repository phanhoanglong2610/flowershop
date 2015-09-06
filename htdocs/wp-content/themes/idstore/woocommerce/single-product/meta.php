<?php
/**
 * Single Product Meta
 */

global $post, $product;
?>
<div class="product_meta">
	<?php echo $product->get_categories( ', ', ' <span class="posted_in">'.__('Category:', ETHEME_DOMAIN).' ', '.</span>'); ?>
	<br>
	<?php echo $product->get_tags( ', ', ' <span class="tagged_as">'.__('Tags:', ETHEME_DOMAIN).' ', '.</span>'); ?>

</div>