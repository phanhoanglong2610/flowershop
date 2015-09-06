<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package humbleshop
 * @since humbleshop 1.0
 */
?>

<!-- =============== -->
<!-- SIDEBAR SECTION -->
<!-- =============== -->

<div class="sidebar">
	<?php do_action( 'before_sidebar' ); ?>
	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

		<aside id="search" class="widget widget_search">
			<?php //get_search_form(); ?>
		</aside>

		<aside id="archives" class="widget">
			<p class="title"><?php _e( 'Archives', 'humbleshop' ); ?></p>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</aside>

		<aside id="meta" class="widget">
			<p class="title"><?php _e( 'Meta', 'humbleshop' ); ?></p>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</aside>

	<?php endif; // end sidebar widget area ?>
</div>