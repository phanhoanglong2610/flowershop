<?php 
function LiveLoadScriptsBefore() {
// Live Settings Style
wp_enqueue_style( 'live-settings', get_template_directory_uri() . '/functions/livesettings/css/live-settings.css' );
wp_enqueue_style( 'colorpicker-style', get_template_directory_uri() . '/functions/livesettings/css/colorpicker.css' );
}
if(!is_admin()){
    add_action('init', 'LiveLoadScriptsBefore');
}

function LiveLoadScriptsAfter() {
// Live Settings Script
wp_register_script( 'live-script', get_template_directory_uri() . '/functions/livesettings/js/live-settings.js');
wp_enqueue_script(  'live-script' );
}
if(!is_admin() and get_option('ready_live_settings') == 'on'){
    add_action('init', 'LiveLoadScriptsAfter');
}
?>