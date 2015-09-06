<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

// Increase loop count
$woocommerce_loop['loop']++;

$content_excerpt = $category->category_description;
$cat_link = get_term_link( $category->slug, 'product_cat' );
?>
<li class="product-category type-product product-grid-container-inner product<?php
    if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1)
        echo ' first';
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
		echo ' last';
?>">
<div class="product-item">

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>
	
	<div class="general-block-outer list-product-image product-thumb-alt">
		<div class="general-block">
			<a href="<?php echo $cat_link; ?>">
				<?php
					/**
					 * woocommerce_before_subcategory_title hook
					 *
					 * @hooked woocommerce_subcategory_thumbnail - 10
					 */
					do_action( 'woocommerce_before_subcategory_title', $category );
				?>

				<?php
					/**
					 * woocommerce_after_subcategory_title hook
					 */
					do_action( 'woocommerce_after_subcategory_title', $category );
				?>
			</a>
		</div>
	</div>
	
	<div class="title">
		<h3 class="title-container product-titles">
			<a href="<?php echo $cat_link; ?>"><?php
				echo $category->name;

				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
			?></a>
		</h3>
	</div>
	
	<div class="image mosaic-block bar">
		<?php if($content_excerpt != "") { 
			?><a href="<?php echo $cat_link; ?>" class="mosaic-overlay">
				<div class="details">
					<? php echo $content_excerpt ?>
				</div>
			</a><?php } ?>
		<a href="<?php echo $cat_link; ?>">
			<?php
				/**
				 * woocommerce_before_subcategory_title hook
				 *
				 * @hooked woocommerce_subcategory_thumbnail - 10
				 */
				do_action( 'woocommerce_before_subcategory_title', $category );
			?>

			<?php
				/**
				 * woocommerce_after_subcategory_title hook
				 */
				do_action( 'woocommerce_after_subcategory_title', $category );
			?>
		</a>
	</div>
	
	<div class="info">
		<?php if($content_excerpt != "") { ?><div class="details">
			<?php echo $content_excerpt ?>
		</div><?php } ?>
		
		<div class="float-right">
			<span class="button-small">
				<a href="<?php echo $cat_link; ?>" rel="nofollow"class="special button">
					<?php _e('View More...', 'circolare'); ?>
				</a>
			</span>
		</div>
	</div>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
</div>
</li>