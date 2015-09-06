<?php
/**
 * Single Product Image
 */

global $post, $woocommerce;

$product_layout = etheme_get_option('single_product_layout');
$zoom = etheme_get_option('zoom_efect');
$mainHeight = 600;
$mainWidth = 440;

$imgId = get_post_thumbnail_id();
$crop = (get_option('woocommerce_single_image_crop') == 1) ? true : false;

if($zoom != 'disable'){
	wp_enqueue_style("zoom",get_template_directory_uri().'/css/zoom.css');
	wp_enqueue_script('mousewheel', get_template_directory_uri().'/js/jquery.mousewheel.js');
	wp_enqueue_script('touch', get_template_directory_uri().'/js/touch.js');
	wp_enqueue_script('zoom', get_template_directory_uri().'/js/zoom.js');
}

?>
<div class="span5 product_image <?php if($zoom != 'disabled') echo 'zoom-enabled'; ?>" data-img="<?php echo etheme_get_image( $imgId, $mainWidth, $mainHeight, $crop ) ?>" data-original="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>">
    <h1 class="product-title2"><?php the_title(); ?></h1>
    
	<?php if ( has_post_thumbnail() ) : ?>
        <div class="main-image" style="position:relative;">
        	<?php etheme_wc_product_labels(); ?>
            <a itemprop="image" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" id="zoom1" class="zoom" title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>" <?php if($zoom == 'disable'): ?>onclick="hideLightbox()"<?php endif; ?>>
                <img class="attachment-shop_single wp-post-image" src="<?php echo etheme_get_image( $imgId, $mainWidth, $mainHeight, $crop ) ?>"  alt="<?php the_title(); ?>" />
            </a>
		<?php if(etheme_get_option('gallery_lightbox')): ?>
			<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="lightbox-btn" rel="lightbox<?php if($zoom == 'disable'): ?>[gal]<?php endif; ?>" data-original-title="" data-placement="left">&nbsp;</a>
		<?php endif; ?>
        </div>
	<?php else : ?>
	
		<img width="<?php echo $mainWidth ?>" height="<?php echo $mainHeight ?>" src="<?php echo woocommerce_placeholder_img_src(); ?>" alt="Placeholder" />
	
	<?php endif; ?>
	<?php do_action('woocommerce_product_thumbnails'); ?>
    <div class="clear"></div>
</div>