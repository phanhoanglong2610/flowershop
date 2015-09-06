<?php
//if ( ! isset( $_GET['woo-shortcodes-nonce'] ) || ( $_GET['woo-shortcodes-nonce'] == '' ) ) die( 'Security check' );

// Get the path to the root.
$full_path = __FILE__;

$path_bits = explode( 'wp-content', $full_path );

$url = $path_bits[0];

// Require WordPress bootstrap.
require_once( $url . '/wp-load.php' );

// Nonce security check.    
$nonce = $_GET['woo-shortcodes-nonce'];
//if ( ! wp_verify_nonce( $nonce, 'wooframework-shortcode-generator' ) ) die( 'Security check' );

$woo_framework_version = get_option( 'woo_framework_version' );

$MIN_VERSION = '2.9';

$meetsMinVersion = version_compare($woo_framework_version, $MIN_VERSION) >= 0;

$woo_framework_path = dirname(__FILE__) .  '/../../';

$woo_framework_url = get_template_directory_uri() . '/shortcode/';

$woo_shortcode_css = $woo_framework_path . 'css/shortcodes.css';
                                  
$isWooTheme = file_exists($woo_shortcode_css);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<div id="woo-dialog">


<div id="woo-options-buttons" class="clear">
	<div class="alignleft">
	
	    <input type="button" id="woo-btn-cancel" class="button" name="cancel" value="Cancel" accesskey="C" />
	    
	</div>
	<div class="alignright">
	    <input type="button" id="woo-btn-insert" class="button-primary" name="insert" value="Insert" accesskey="I" />  
	</div>
	<div class="clear"></div><!--/.clear-->
</div><!--/#woo-options-buttons .clear-->

<div id="woo-options" class="alignleft">
    <h3><?php echo __( 'Customize the Shortcode', 'woothemes' ); ?></h3>
    
	<table id="woo-options-table">
	</table>

</div>
<div class="clear"></div>


<script type="text/javascript" src="<?php echo esc_url( $woo_framework_url . 'js/shortcode-generator/js/column-control.js' ); ?>"></script>
<script type="text/javascript" src="<?php echo esc_url( $woo_framework_url . 'js/shortcode-generator/js/tab-control.js' ); ?>"></script>


<script type="text/javascript" src="<?php echo esc_url( $woo_framework_url . 'js/shortcode-generator/js/dialog-js.php' ); ?>"></script>
</div>
</body>
</html>