<script type="text/javascript">
// <!--
function toeApplyCoupon() {
    jQuery(this).sendForm({
        msgElID: 'toeCouponsCheckoutMsg',
        data: {coupon: jQuery('#toeCoupon').val(), mod: 'coupons', action: 'applyCoupon', reqType: 'ajax'},
        onSuccess: function(res) {
            if(res.data.totalHtml) {
                updateCart(new Array(), res.data.totalHtml);
            }
            if(!res.error) {
                jQuery('#toeCoupon').val('');
            }
        }
    });
}
function toeShouCouponsDescription(link) {
    var linkPos = jQuery(link).position();
    subScreen.show(<?php echo $this->couponsDescription?>, linkPos.left, linkPos.top);
}
// -->
</script>
<h4 class="cuponTitle"><?php lang::_e('Enter coupon number:')?></h4>
<?php echo html::text('coupon', array('attrs' => 'id="toeCoupon"'))?>
<?php echo html::button(array('value' => lang::_('OK'), 'attrs' => 'onclick="toeApplyCoupon(); return false;" class="tcf_submit couponBtn"'))?>
<div id="toeCouponsCheckoutMsg"></div>
<!-- <a href="#" onclick="toeShouCouponsDescription(this); return false;"><?php lang::_e('Where I can get It?')?></a> -->