<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

get_header('shop'); ?>

<!-- ============== -->
<!-- SINGLE SECTION -->
<!-- ============== -->

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>

	<section class="single">

		<div class="row">
			<header class="span12 prime">
				<h3><?php the_title(); ?></h3>
			</header>
		</div>
	
		<div class="row">
				
			<div class="span12">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

			<?php endwhile; // end of the loop. ?>	
			</div> 
			
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