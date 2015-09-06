<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$args = array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'posts_per_page' 		=> 4,
	'no_found_rows' 		=> 1,
	'orderby' 				=> 'rand',
	'post__in' 				=> $upsells
);

$products = new WP_Query( $args );

if ( $products->have_posts() ) : ?>
	<hr>
	<div class="upsells products clearfix">

		<h5><?php _e('YOU MAY ALSO LIKE&hellip;', 'woocommerce') ?></h5>

		<div class="wrap">
		<div class="products row-fluid">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'product-small' ); ?>

			<?php endwhile; // end of the loop. ?>

		</div>	
		</div>

	</div>

<?php endif;

wp_reset_postdata();