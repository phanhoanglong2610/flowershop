<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Ready_ecommerce
 * @since Ready_ecommerce 0.1
 */
?>
<div id="secondary" class="widget-area sidebar" role="complementary">
        <?php do_action( 'before_sidebar' ); ?>
        <?php if ( ! dynamic_sidebar( 'sidebar-5' ) ) : ?>

                <aside id="search" class="widget widget_search">
                        <?php get_search_form(); ?>
                </aside>

                <aside id="archives" class="widget">
                        <h1 class="widget-title"><?php _e( 'Archives', 'ready_ecommerce' ); ?></h1>
                        <ul>
                                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                        </ul>
                </aside>

                <aside id="meta" class="widget">
                        <h1 class="widget-title"><?php _e( 'Meta', 'ready_ecommerce' ); ?></h1>
                        <ul>
                                <?php wp_register(); ?>
                                <aside><?php wp_loginout(); ?></aside>
                                <?php wp_meta(); ?>
                        </ul>
                </aside>

        <?php endif; // end sidebar widget area ?>
</div><!-- #secondary .widget-area -->
<style type="text/css">
    #content {
        float: left;
        width: 759px;
    }
</style>