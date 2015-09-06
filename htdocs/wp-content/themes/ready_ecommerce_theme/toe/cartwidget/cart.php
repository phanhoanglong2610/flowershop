<div class="toeWidget">
    <div id="cartButton"></div>
    <div class="toeWidgetTitle">
        <p>
            <a href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'user', 'action' => 'getShoppingCart'))?>">
                <?php lang::_e('Giỏ hàng')?>
            </a>
        </p>
    </div>
    <span class="cart_items">
        <?php  
        $count_items = 0;

        foreach($this->cart as $inCartId => $c) { 
            $count_items += $c['qty'];
        }

        if ($count_items > 1) {
            $txt = 'sản phẩm';
        } else {$txt = 'sản phẩm';}
        ?>
        <?php echo $count_items.' '.lang::_("$txt").' - '.frame::_()->getModule('currency')->display( frame::_()->getModule('checkout')->getTotal() ); ?> 
    </span>
    <div class="shopping_cart_list" style="display: none;">
        <div class="close"><a href="#">-X-</a></div>
        <?php

        $cart = frame::_()->getModule('user')->getModel('cart')->get();

        ?>
        <table class="cart-content">
            <thead>
                <tr>
                    <td>Hình</td>
                    <td>Tên sản phẩm</td>
                    <td>SL</td>
                </tr>
            </thead>
            <?php
            foreach ($cart as $key => $value) {
                ?>
                <tr>
                    <td>
                        <?php $img = frame::_()->getModule('products')->getView()->getProductImage($value['pid']);
                        $img = $img['thumb'] 
                        ?> 
                        <img src= "<?php echo $img['0'] ?>" style = "max-width: 30px;">
                    </td>
                    <td>
                        <?php echo $value['name']; ?>
                    </td>
                    <td>
                        <?php echo $value['qty']; ?>
                    </td>
                </tr>

                <?php }
                ?>
            </table>
            <div style="float:left; margin-right: 10px;">
            <input type="button"  value="<?php lang::_e('Xóa giỏ')?>" onclick="toeClearCart({reload: false}); return false;" />
        </div>
        <div class="blue_button" style="float:right;"><?php echo $this->checkoutLink; ?></div>
        <br clear="all" />

    </div>

</div>
<script type="text/javascript">
jQuery(".cart_items").toggle(function() {
        jQuery('#shop-card .shopping_cart_list').show("slow");
    }, function() {
        jQuery('#shop-card .shopping_cart_list').hide("slow");
    });
    
    jQuery("#cartButton").toggle(function() {
        jQuery('#shop-card .shopping_cart_list').show("slow");
    }, function() {
        jQuery('#shop-card .shopping_cart_list').hide("slow");
    });
    
    jQuery(".shopping_cart_list .close").click(function() {
        jQuery('#shop-card .shopping_cart_list').hide("slow");
    });
</script>