<?php
/**
 * Single Product Quantity Inputs
 */
?>
<div class="qty-block" id="product-quantity">
    <label><?php _e('Qty:', ETHEME_DOMAIN); ?></label>
    <div class="quantity">
        <input name="<?php echo $input_name; ?>" value="<?php echo $input_value; ?>" size="4" title="Qty" class="input-text qty text" maxlength="12" />
    </div>
</div>