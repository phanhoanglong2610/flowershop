<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $post;
?>

<?php do_action('woocommerce_before_add_to_cart_form'); ?>

<?php if ( version_compare( WOOCOMMERCE_VERSION, '2.0', '<' ) ) { ?>

<script type="text/javascript">
    var product_variations_<?php echo $post->ID; ?> = <?php echo json_encode( $available_variations ) ?>;
</script>

<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>">
	<div class="variations" cellspacing="0">
			<hr>
			<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
				<div class="row-fluid">
					<div class="span12 clearfix">
						<div class="pull-left"><p for="<?php echo sanitize_title($name); ?>"><?php echo $woocommerce->attribute_label($name); ?></p></div>
						<div class="pull-right"><select id="<?php echo esc_attr( sanitize_title($name) ); ?>" name="attribute_<?php echo sanitize_title($name); ?>">
							<option value=""><?php echo __('Choose an option', 'woocommerce') ?>&hellip;</option>
							<?php
								if ( is_array( $options ) ) {

									if ( empty( $_POST ) )
										$selected_value = ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) ? $selected_attributes[ sanitize_title( $name ) ] : '';
									else
										$selected_value = isset( $_POST[ 'attribute_' . sanitize_title( $name ) ] ) ? $_POST[ 'attribute_' . sanitize_title( $name ) ] : '';

									// Get terms if this is a taxonomy - ordered
									if ( taxonomy_exists( sanitize_title( $name ) ) ) {

										$terms = get_terms( sanitize_title($name), array('menu_order' => 'ASC') );

										foreach ( $terms as $term ) {
											if ( ! in_array( $term->slug, $options ) ) continue;
											echo '<option value="' . $term->slug . '" ' . selected( $selected_value, $term->slug, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
										}
									} else {
										foreach ( $options as $option )
											echo '<option value="' . $option . '" ' . selected( $selected_value, $option, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $option ) . '</option>';
									}
								}
							?>
						</select> 
						</div>
					</div>
				</div>
	        <?php endforeach;?>
	        <hr>
	</div>

	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	<div class="single_variation_wrap" style="display:none;">
		
		<div class="single_variation"></div>
		

		<div class="clearfix">
			<div class="pull-left">
				<div class="variations_button">

					<input type="hidden" name="variation_id" value="" />
					<?php woocommerce_quantity_input(); ?>
					
				</div>
			</div>
			<div class="pull-right">
				<?php if ( sizeof($attributes) == $loop )
				echo '<a class="reset_variations" href="#reset" style="padding-right:25px">'.__('Clear Selection', 'woocommerce').'</a>'; ?> 
				<button type="submit" class="btn btn-large theme single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'woocommerce'), $product->product_type); ?></button>
			</div>	
		</div>
		<hr>
	</div>
	<div><input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" /></div>

	<?php do_action('woocommerce_after_add_to_cart_button'); ?>

</form>

<?php } else { ?>

<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<div class="variations" cellspacing="0">
			<hr>

	    	<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
				<div class="row-fluid">
					<div class="span12 clearfix">

					<div class="pull-left span6"><p for="<?php echo sanitize_title($name); ?>"><?php echo $woocommerce->attribute_label($name); ?></p></div>
					<div class="pull-left span6">
						<select id="<?php echo esc_attr( sanitize_title($name) ); ?>" name="attribute_<?php echo sanitize_title($name); ?>">
						<option value=""><?php echo __( 'Choose an option', 'woocommerce' ) ?>&hellip;</option>
						<?php
							if ( is_array( $options ) ) {

								if ( empty( $_POST ) )
									$selected_value = ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) ? $selected_attributes[ sanitize_title( $name ) ] : '';
								else
									$selected_value = isset( $_POST[ 'attribute_' . sanitize_title( $name ) ] ) ? $_POST[ 'attribute_' . sanitize_title( $name ) ] : '';

								// Get terms if this is a taxonomy - ordered
								if ( taxonomy_exists( sanitize_title( $name ) ) ) {

									
									if ( version_compare( WOOCOMMERCE_VERSION, '2.0', '<' ) ) {

										echo 'VERSION 2.0';
									  
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

										$terms = get_terms( sanitize_title( $name ), $args );

										foreach ( $terms as $term ) {
											if ( ! in_array( $term->slug, $options ) ) continue;
											echo '<option value="' . $term->slug . '" ' . selected( $selected_value, $term->slug, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
										}

									} else {
									  
									  	echo 'version';

									  	$terms = get_terms( sanitize_title($name), array('menu_order' => 'ASC') );

										foreach ( $terms as $term ) {
											if ( ! in_array( $term->slug, $options ) ) continue;
											echo '<option value="' . $term->slug . '" ' . selected( $selected_value, $term->slug, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
										}

									}

								} else {
									foreach ( $options as $option )
										echo '<option value="' . $option . '" ' . selected( $selected_value, $option, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $option ) . '</option>';
								}
							}
						?>
					</select> 
					</div>
					</div>

				</div>
	        <?php endforeach;?>
	        <hr>
	</div>

	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	<div class="single_variation_wrap" style="display:none;">
		
		<div class="single_variation"></div>

		<div class="clearfix">
			<div class="pull-left">
				<div class="variations_button">
					<input type="hidden" name="variation_id" value="" />
					<?php woocommerce_quantity_input(); ?>
					
				</div>
			</div>
			<div class="pull-right">
				<?php
					if ( sizeof($attributes) == $loop ) echo '<a class="btn btn-link reset_variations" href="#reset">' . __( 'Clear selection', 'woocommerce' ) . '</a>';
				?>
				<button type="submit" class="btn btn-large theme single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __( 'Add to cart', 'woocommerce' ), $product->product_type); ?></button>
			</div>
		</div>	
		
	<hr>
	</div>

	<div><input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" /></div>		
	
	<?php do_action('woocommerce_after_add_to_cart_button'); ?>

</form>
<?php } 
do_action('woocommerce_after_add_to_cart_form'); ?>