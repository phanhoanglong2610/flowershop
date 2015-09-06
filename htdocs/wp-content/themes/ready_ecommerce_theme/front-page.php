<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ready_ecommerce
 * @since Ready_ecommerce 0.1
 */

get_header();
 ?>
		<div id="primary">
		<div id="main_widget">
		<?php
		if (!function_exists('is_plugin_active')):
			require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
		endif;
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			dynamic_sidebar( 'sidebar-1' );
		} elseif (is_plugin_active('ready-ecommerce/ecommerce.php')){
			// Makes sure the plugin is defined before trying to use it
			
				the_widget('toeFPWidget', $instance = array('view' => 1, 'title'=> 'Featured Products'));
				the_widget('toeBCWidget', $instance = array('view' => 1, 'title'=> 'Categories'),'');
		} else {
			the_widget('WP_Widget_Search');
			the_widget('WP_Widget_Categories');
			the_widget('WP_Widget_Meta');
			the_widget('WP_Widget_Pages');
		}
		?>
		</div><!-- #content_slider .widget-area -->
		</div><!-- #primary -->

<?php /*get_sidebar();*/ ?>
<?php get_footer(); ?>