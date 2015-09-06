<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $post;
?>

<?php do_action('woocommerce_before_add_to_cart_form'); ?>
<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<div class="variations">
		<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>

		<div class="styled-select general-field details-options">
			<select id="<?php echo esc_attr( sanitize_title($name) ); ?>" class="styled options" name="attribute_<?php echo sanitize_title($name); ?>">
				<option value=""><?php echo __( 'Choose', 'circolare' ) ?> <?php echo $woocommerce->attribute_label( $name ); ?>&hellip;</option>
				<?php
					if ( is_array( $options ) ) {

						if ( empty( $_POST ) )
							$selected_value = ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) ? $selected_attributes[ sanitize_title( $name ) ] : '';
						else
							$selected_value = isset( $_POST[ 'attribute_' . sanitize_title( $name ) ] ) ? $_POST[ 'attribute_' . sanitize_title( $name ) ] : '';

						// Get terms if this is a taxonomy - ordered
						if ( taxonomy_exists( $name ) ) {

							$orderby = $woocommerce->attribute_orderby( $name );

							switch ( $orderby ) {
								case 'name' :
									$args = array( 'orderby' => 'name', 'hide_empty' => false, 'menu_order' => false );
								break;
								case 'id' :
									$args = array( 'orderby' => 'id', 'order' => 'ASC', 'menu_order' => false );
								break;
								case 'menu_order' :
									$args = array( 'menu_order' => 'ASC' );
								break;
									}

							$terms = get_terms( $name, $args );

							foreach ( $terms as $term ) {
								if ( ! in_array( $term->slug, $options ) )
									continue;

								echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( $selected_value, $term->slug, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
							}
						} else {

							foreach ( $options as $option ) {
								echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
							}

						}
					}
				?>
			</select>
		</div>
		<?php endforeach;?>
	</div>
	
	<?php
		if ( sizeof($attributes) == $loop )
		echo '<p class="clear_selection"><a class="reset_variations regular" href="#reset">' . __( 'Clear selection', 'woocommerce' ) . '</a></p>';
	?>
	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	<div class="single_variation_wrap" style="display:none;">
		<div class="single_variation"></div>
		<div class="variations_button">
			<input type="hidden" name="variation_id" value="" />
			<div class="float-left general-field">
			<?php woocommerce_quantity_input(); ?>
			</div>
			
			<div class="float-left">
			<button type="submit" class="single_add_to_cart_button red-submit-button button alt"><?php echo apply_filters('single_add_to_cart_text', __( 'Add to cart', 'woocommerce' ), $product->product_type); ?></button>
			</div>
			
			<div class="clear"></div>
		</div>
	</div>
	<div><input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" /></div>

	<?php do_action('woocommerce_after_add_to_cart_button'); ?>

</form>
<?php do_action('woocommerce_after_add_to_cart_form'); ?>
