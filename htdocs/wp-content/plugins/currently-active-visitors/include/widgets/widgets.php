<?php
include_once("cav-list-widget.php");

add_action('admin_print_scripts-widgets.php', 'cav_load_widget_scripts');
add_action('admin_print_styles-widgets.php', 'cav_load_widget_style');

function cav_load_widget_scripts($hook){
global $wp_version;    
if ( 3.5 <= $wp_version ) wp_enqueue_script('wp-color-picker', array('jquery'));
wp_enqueue_script('cav-color-picker-settings', RAV_CAV_JS_PATH . '/colorpicker.js');
wp_enqueue_script('cav-load-color-picker',RAV_CAV_JS_PATH.'/cav_load_color_picker.js',array('jquery'));
wp_enqueue_script('jquery-migrate',RAV_CAV_JS_PATH.'/jquery-migrate-1.2.1.min.js',array('jquery'));
}

function cav_load_widget_style(){
global $wp_version;    
if ( 3.5 <= $wp_version ) wp_enqueue_style( 'wp-color-picker' ); 
else wp_enqueue_style( 'cav-color-picker-settings', RAV_CAV_CSS_PATH . '/colorpicker.css' );
}

?>