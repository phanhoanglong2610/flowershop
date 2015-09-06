jQuery(function() {
            if (window.PIE) {
                jQuery("#colophon, .tcf_submit, .tcf_submit:hover, #subscribe input[type='submit'], #subscribe input[type='submit']:hover, .product_to_cart a:hover, .product_to_cart a, .update_qty:hover, .update_qty, .checkoutLink a, .checkoutLink a:hover, input[type='button'], input[type='button']:hover, input[name='next'], input[name='next']:hover, #post_review, #post_review:hover, .price_lable, #product_price, 	#product_tabs .ui-state-active.ui-tabs-selected, #product_tabs .ui-state-active.ui-tabs-selected a, .ui-tabs-nav, hgroup .toeWidgetTitle").each(function() {
                    PIE.attach(this);
                });
            }
});
