<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

get_header('shop'); ?>

<!-- ============ -->
<!-- SHOP SECTION -->
<!-- ============ -->
	
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>
	<section class="product">

	<div class="row">
		<header class="span12 prime">
			<h3>
				<?php if ( is_search() ) : ?>
					<?php
						printf( __( 'Search Results: &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() );
						if ( get_query_var( 'paged' ) )
							printf( __( '&nbsp;&ndash; Page %s', 'woocommerce' ), get_query_var( 'paged' ) );
					?>
				<?php elseif ( is_tax() ) : ?>
					<?php echo single_term_title( "", false ); ?>
				<?php else : ?>
					<?php
						$shop_page = get_post( woocommerce_get_page_id( 'shop' ) );

						echo apply_filters( 'the_title', ( $shop_page_title = get_option( 'woocommerce_shop_page_title' ) ) ? $shop_page_title : $shop_page->post_title );
					?>
				<?php endif; ?>
			</h3>
		</header>
	</div>

	<div class="row">

		<?php 
			$sidebar = ot_get_option( 'hs_sidebarshop' ); 
			if ($sidebar == 1) { ?>
			<!-- Sidebar -->
			<div class="span4">
				<div class="sidebar">
					<?php if ( ! dynamic_sidebar( 'sidebar-3' ) ) : ?>
					
						<aside id="archives" class="widget">
							<h5>No widget in 'Shop Sidebar' panel</h5>
							Add some <a href="<?php bloginfo( 'url' ); ?>/wp-admin/widgets.php">here</a>
						</aside>
	
					<?php endif; // end sidebar widget area ?>
				</div>
			</div>
		<?php } ?> 

		<?php if ($sidebar == 'no_sidebar') { ?>
			<div class="span12">	
			<?php } else { ?>
			<div class="span8">
		<?php } ?>

			<?php do_action( 'woocommerce_archive_description' ); ?>

			<?php if ( is_tax() ) : ?>
				<?php do_action( 'woocommerce_taxonomy_archive_description' ); ?>
			<?php elseif ( ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
				<?php do_action( 'woocommerce_product_archive_description', $shop_page ); ?>
			<?php endif; ?>

			<?php if ( have_posts() ) : ?>

				<?php do_action('woocommerce_before_shop_loop'); ?>
				
				<div class="row-fluid">
					<div id="flexcarousel-cat" class="flexslider">
						<ul class="slides">
							<?php woocommerce_product_subcategories(); ?>	
						</ul>
					</div>
				</div>
				
				<div class="products row">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php woocommerce_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>

				</div>

				<?php do_action('woocommerce_after_shop_loop'); ?>

			<?php else : ?>

				<?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>

					<p><?php _e( 'No products found which match your selection.', 'woocommerce' ); ?></p>

				<?php endif; ?>

			<?php endif; ?>

			<div class="clear"></div>

			<?php
				/**
				 * woocommerce_pagination hook
				 *
				 * @hooked woocommerce_pagination - 10
				 * @hooked woocommerce_catalog_ordering - 20
				 */
				do_action( 'woocommerce_pagination' );
			?>
		</div>

		<?php if ($sidebar == 2) { ?>
			<!-- Sidebar -->
			<div class="span4">
				<div class="sidebar">
				<?php if ( ! dynamic_sidebar( 'sidebar-3' ) ) : ?>
					
					<aside id="archives" class="widget">
						<h5>No widget in 'Shop Sidebar' panel</h5>
						Add some <a href="<?php bloginfo( 'url' ); ?>/wp-admin/widgets.php">here</a>
					</aside>

				<?php endif; // end sidebar widget area ?>	
				</div>
			</div>
		<?php } ?>

		<?php
			/**
			 * woocommerce_sidebar hook
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			//do_action('woocommerce_sidebar');
		?>	
		

	</div>

	</section>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

<?php get_footer('shop'); ?>