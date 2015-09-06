<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head>
 * @package humbleshop
 * @since serenityshop 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!-- Favicon -->
	<link rel="icon" href="<?php echo ot_get_option( 'hs_fav' ) ?>">

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<!--[if IE 7]>
		<link rel="stylesheet" href="css/ie7.css" />
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php do_action( 'before' ); ?>

	<?php if ( (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || (in_array( 'jigoshop/jigoshop.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ))) ) { ?>

	<!-- ====== -->
	<!-- TOPBAR -->
	<!-- ====== -->
	<div class="header-container">
	<div class="top-header clearfix">
	<div class="container welcome">
		<div class="row-fluid">
			<div class="pull-left greet">
			<?php echo ot_get_option( 'hs_Lng_Header_Welcome' ); ?> <?php if (is_user_logged_in()) { 
					global $current_user; get_currentuserinfo();
					echo $current_user->user_login;
					echo ', <a href="?p='.ot_get_option( 'hs_account' ).'">my account</a>.'; 
					} else { ?>
					<?php echo ot_get_option( 'hs_Lng_Header_Shopper' ); ?>, <a href="?p=<?php echo ot_get_option( 'hs_account' ); ?>"><?php echo ot_get_option( 'hs_Lng_Header_Login' ); ?>.</a>
					<?php } ?>
			</div>
			<div class="pull-right hscart tright">
				
				<!-- Cart Updates -->
				<div class="counter">
					<a href="javascript:void(0);"><i class="icon-basket"></i> <?php _e('Totals', 'woocommerce'); ?> </a> : <span class="theme"><?php global $woocommerce; echo $woocommerce->cart->get_cart_subtotal();?></span>
				</div>
				
				<!-- Bubble Cart Item -->
				<div class="cartbubble">
			
					<div class="arrow-box">

						<?php do_action( 'woocommerce_before_cart_contents' ); ?>

						<?php
							if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
							foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
								$_product = $values['data'];
								if ( $_product->exists() && $values['quantity'] > 0 ) {
						?>
							<!-- Item -->
							<div class="clearfix">
								<div class="pull-left">

									<?php
										echo $values['quantity'].' &times; ';

										if ( ! $_product->is_visible() || ( $_product instanceof WC_Product_Variation && ! $_product->parent_is_visible() ) )
											echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
										else
											printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

		                   				// Backorder notification
		                   				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
		                   					echo '<p class="backorder_notification">' . __('Available on backorder', 'woocommerce') . '</p>';
									?>
								
								</div>
								<div class="theme pull-right">
									<?php
										$product_price = get_option('woocommerce_display_cart_prices_excluding_tax') == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();
										echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
									?>

								</div>
							</div>
						<?php } } ?>

							<!-- Total -->
							<hr>
							<div class="clearfix">
								<?php _e('Total', 'woocommerce'); ?> <span class="theme pull-right"><?php global $woocommerce; echo $woocommerce->cart->get_cart_subtotal();?></span>
							</div>
							<hr />
							<div class="clearfix">
								<a href="javascript:void(0)" id="closeit"><?php echo ot_get_option( 'hs_Lng_Header_Close' ); ?></a>
								<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="btn theme btn-mini pull-right"><?php echo ot_get_option( 'hs_Lng_Header_Checkout' ); ?></a>
							</div>

						<?php } else { ?>

						<div class="clearfix tcenter">
							<?php _e('No products in the cart.', 'woocommerce'); ?> <br>
							<a href="javascript:void(0)" id="closeit">Close</a>
						</div>

						<?php }
						do_action( 'woocommerce_cart_contents' );
						?>

					</div>
					
				</div>
			</div>
		</div>	
	</div>
	</div>
	
	<?php } ?>

	<!-- ================= -->
	<!-- HEADER & BRANDING -->
	<!-- ================= -->
	
	<div class="container head">
		<div class="row">
			<div class="span12 clearfix">
				<div class="top row">
					
						<?php 
						if (ot_get_option( 'hs_logo' )) { ?>
  							<div class="span8 logo image">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
  									<img src="<?php echo ot_get_option( 'hs_logo' ); ?>" alt="" />
  								</a>
  							</div>
						<?php } else { ?>
							<div class="span8 logo text">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</div>
						<?php } ?>
					
					<div class="searchcart span4">
						<?php if ( (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || (in_array( 'jigoshop/jigoshop.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ))) ) { ?>
							<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) ); ?>" class="topsearch form-horizontal">
					            <div>
					                <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search', 'woocommerce' ); ?>" class="top-search" />
					                <button type="submit" id="searchsubmit" value="<?php echo esc_attr__( 'Search' ); ?>" class="btn"><i class="icon-search"></i></button>
					                <input type="hidden" name="post_type" value="product" />
					            </div>
					        </form>
						<?php } else { ?>
							<?php get_search_form(); ?>
						<?php } ?>	
					</div>
				</div>	
			</div>
		</div>
	</div>

	<!-- ================ -->
	<!-- MAIN NAV SECTION -->
	<!-- ================ -->
	
	<div class="container-menu">
	<nav class="container">
		<div class="row">		
			<div class="span12">
				<nav class="horizontal-nav full-width">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'items_wrap' => '<ul id="nav" class="nav">%3$s</ul>' ,'walker' => new My_Walker_Nav_Menu(), 'fallback_cb' => 'humbleshop_page_menu_args' ) ); ?>
				</nav>
			</div>
		</div>
	</nav>
	</div>
	</div>
	</div>
	
