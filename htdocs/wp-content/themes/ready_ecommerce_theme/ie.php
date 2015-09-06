<?php
/**
* Attach CSS3PIE behavior to elements
* Add elements here that need PIE applied
*/
function ie_pie() {
   echo '
   <!--[if lt IE 9]>
	<style type="text/css" media="screen">
	#colophon {
		-pie-background:url('.trailingslashit(get_bloginfo('template_url')).'images/border_bottom.png) repeat-x #282828;
	}
	.product_to_cart a {
		-pie-background: url('.trailingslashit(get_bloginfo('template_url')).'images/basket.png) no-repeat 5px 6px, url('.trailingslashit(get_bloginfo('template_url')).'images/button_bg.png) 0px 0px;
	}
	.product_to_cart a:hover {
		-pie-background: url('.trailingslashit(get_bloginfo('template_url')).'images/basket.png) no-repeat 5px 6px, url('.trailingslashit(get_bloginfo('template_url')).'images/button_bg.png) 0px 28px;
	}
	hgroup h1, hgroup h2{
		float:left;
	}
	
	hgroup #searchform{
		float:left;
		display:block;
	}
	hgroup .toeWidget{
		width: 200px;
		float:left;
	}
	.price_lable, #product_price{
		-pie-background: url('.trailingslashit(get_bloginfo('template_url')).'images/price-label.png) no-repeat, url('.trailingslashit(get_bloginfo('template_url')).'images/price_bg.png) repeat-x;
	}
	#product_tabs .ui-state-active.ui-tabs-selected{
	-pie-background:url('.trailingslashit(get_bloginfo('template_url')).'images/tab_left.png) 0px 2px no-repeat, url('.trailingslashit(get_bloginfo('template_url')).'images/white.png) 20px 5px no-repeat;
	}
	.ui-tabs-nav{
		border-radius: 4px;
	}
	hgroup h1{
		width: 200px;
		height: 50px;
	font-size: 12px;
	}

	hgroup .cart_items{
		cursor: pointer;
	}
	</style>
<![endif]-->
';
}
add_action('wp_head', 'ie_pie', 8);
?>