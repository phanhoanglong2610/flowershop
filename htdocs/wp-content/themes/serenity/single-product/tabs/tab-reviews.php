<?php
/**
 * Reviews tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( comments_open() ) : ?>
	<li class="reviews_tab"><a href="#tab-reviews"><i class="icon-layout theme"></i> <?php _e('Reviews', 'woocommerce'); ?><small><?php echo comments_number(' [0]', ' [1]', ' [%]'); ?></small></a></li>
<?php endif; ?>