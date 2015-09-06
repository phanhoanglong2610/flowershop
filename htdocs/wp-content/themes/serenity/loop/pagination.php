<?php
/**
 * Pagination
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $wp_query;
?>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>

<div class="navigation clearfix">
	<div class="nav-next pull-right"><?php next_posts_link( __( '<div class="btn theme">Next <span class="meta-nav">&rarr;</span></div>', 'woocommerce' ) ); ?></div>
	<div class="nav-previous pull-left"><?php previous_posts_link( __( '<div class="btn theme"><span class="meta-nav">&larr;</span> Previous</div>', 'woocommerce' ) ); ?></div>
</div>

<?php endif; ?>