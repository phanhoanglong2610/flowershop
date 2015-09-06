<?php
/*
Plugin Name: Currently Active Visitors List
Plugin URI: http://codiator.com/real-time-tracking/currently-active-visitors/
Description: Displays active visitors list using a widget or shortcode.
Author: Ravinder Mann
Version: 1.0
Release Date: Sept 20 2013
Author URI: http://www.codiator.com
*/

global $wpdb;
$cav_shortcode_found=0;
/* Define named constants */
define('RAV_CAV_TABLE_SESSION',$wpdb->prefix . "rav_cav_session");
define('RAV_CAV_COOKIE',"rav_cav_visit");
define('RAV_CAV_LOGGED',"rav_cav_logged");
define('RAV_CAV_COOKIE_EXPIRY',time()+60*60*24);
define('RAV_CAV_ABS_PATH', plugin_dir_url( __FILE__));
define('RAV_CAV_JS_PATH', RAV_CAV_ABS_PATH.'js');
define('RAV_CAV_CSS_PATH', RAV_CAV_ABS_PATH.'css');
define('RAV_CAV_IMAGES_PATH', RAV_CAV_ABS_PATH.'images');
define ('RAV_CAV_AJAX_PATH',admin_url( 'admin-ajax.php' ));
$cav_web_protocol = is_ssl() ? 'https' : 'http';
define ('RAV_CAV_PROTOCOL',$cav_web_protocol);

/* Activation, Deactivation and Uninstall Hooks */
register_activation_hook(__FILE__,'rav_cav_activate');
register_deactivation_hook(__FILE__,'rav_cav_deactivate');
register_uninstall_hook(    __FILE__, 'rav_cav_uninstall' );

/* Enqueue required scripts and styles for frontend */
add_action('wp_enqueue_scripts', 'rav_cav_add_styles', 11);
add_action('wp_enqueue_scripts', 'rav_cav_add_scripts');

/* When new page loads */
add_action('template_redirect', 'rav_cav_page_loaded');

/* Ajax handlers for frontend and admin side */
add_action('wp_ajax_cav_action', 'cav_ajax_handler');
add_action('wp_ajax_nopriv_cav_action', 'cav_ajax_handler');
add_filter('cron_schedules', 'cav_add_halfhour');
add_action('cav_half_hourly_event_hook', 'cav_half_hourly');

include_once("include/widgets/widgets.php");
include_once("include/cav-shortcodes.php");

function rav_cav_add_scripts(){
global $wp_version; 
wp_enqueue_script('jquery');
}

function rav_cav_add_styles(){
global $wp_version;    
wp_enqueue_style('cav_custom_styles',RAV_CAV_CSS_PATH.'/cav_style.css');
wp_enqueue_style('cav_flag_styles',RAV_CAV_CSS_PATH.'/flags.css');  
}

/* Set tracking cookie */
function rav_cav_save_cookie($cav_visitor_id){
if (!isset($_COOKIE[RAV_CAV_COOKIE])){    
setcookie(RAV_CAV_COOKIE, $cav_visitor_id, RAV_CAV_COOKIE_EXPIRY);
}
}

/* Add a custom half hourly cron schedule through the cron_schedules filter */
function cav_add_halfhour( $schedules ) {
    $schedules['halfhourly'] = array(
        'interval' => 1800,
        'display' => __('Once every half hour')
    );
    return $schedules;
}

/* When a new page loads */
function rav_cav_page_loaded(){
global $wpdb, $wp_query;
$cav_post_object=$wp_query->post;    
//delete_transient(RAV_MAP_TRANSIENT);
wp_enqueue_script('cav_track_visits',RAV_CAV_JS_PATH.'/cav_track_visits.php',array('jquery'));
if (!isset($_COOKIE[RAV_CAV_COOKIE])){
$cav_visitor_id=substr(md5(microtime()),rand(0,26),10).rand(10000,100000);
rav_cav_save_cookie($cav_visitor_id);    
}else $cav_visitor_id=$_COOKIE[RAV_CAV_COOKIE];
$cav_post_id=get_the_ID();
$cav_currentl_url=get_permalink($cav_post_id);

/* Updated this class so it uses wp_remote_request instead of cURL */
require_once('geoplugin.class.php');
    $geoplugin = new rav_cav_geoPlugin();
    $geoplugin->locate();
    
     
wp_localize_script( 'cav_track_visits', 'cav_visits', array('cav_visitor_id'=>$cav_visitor_id, 'cav_plugin_path' => RAV_CAV_ABS_PATH, 'cav_ajaxurl' => RAV_CAV_AJAX_PATH, 'cav_nonce' => wp_create_nonce( 'cav_visit_nonce' ), 'cavcity' => $geoplugin->city, 'cavregion' => $geoplugin->region, 'cavcountry' => $geoplugin->countryName, 'cavcountrycode' =>  $geoplugin->countryCode));
    
}


/* Ajax handler */
function cav_ajax_handler(){ 
 global $wpdb;  

if(!isset($_POST['cavtype'])) $_POST['cavtype']=0;

if($_POST['cavtype']==1 || $_POST['cavtype']==2){ 
 header("Content-Length: 0");
 header("Connection: close");
 flush();
} 
 if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) ){
 if($_POST['cavtype']==1 || $_POST['cavtype']==2){        
  check_ajax_referer( 'cav_visit_nonce', 'cavnonce' ); 
  }
 
if($_POST['cavtype']==1){
if (!isset($_COOKIE[RAV_CAV_LOGGED])){       
$cav_return1 = $wpdb->insert( 
    RAV_CAV_TABLE_SESSION, 
    array( 
        'session_id' => $_POST['cavvid'], 
        'city' => $_POST['cavcity'], 
        'state' => $_POST['cavregion'], 
        'country' => $_POST['cavcountry'], 
        'country_code' => $_POST['cavcountrycode'], 
        'visitor_status' => 1,
        'start_timestamp' => time()
    ), 
    array( 
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%d'
    ) 
);

setcookie(RAV_CAV_LOGGED, "1", RAV_CAV_COOKIE_EXPIRY);
}

/*
$wpdb->insert( 
    RAV_CAV_TABLE, 
    array( 
        'session_id' => $_POST['cavvid'],
        'current_path' => stripslashes($_POST['cavcurl']),  
        'referrer' => stripslashes($_POST['cavreferrer']), 
        'post_id' => $_POST['cavpostid'],  
        'visit_timestamp' => time(), 
       ), 
    array( 
        '%s', 
        '%s',
        '%s',
        '%d',
        '%d',
   ) 
);
*/

$wpdb->query("update ".RAV_CAV_TABLE_SESSION." set visitor_status=1, end_timestamp=".time()." where session_id='".$_POST['cavvid']."'");     

}

if($_POST['cavtype']==2){
$wpdb->update( 
    RAV_CAV_TABLE_SESSION, 
    array( 'visitor_status' => 0, 'end_timestamp' => time() ), 
    array( 'session_id' => $_POST['cavvid'] ), 
    array( '%d','%s' ), 
    array( '%s' ) 
);    

}

if($_POST['cavtype']==5){
    
$cav_result5 = $wpdb->get_results( "SELECT city, state, country, country_code FROM ".RAV_CAV_TABLE_SESSION." where visitor_status=1 limit 0, ".strip_tags($_POST['cavmax']), ARRAY_A);
$cav_list_data="";
$cavflag=$_POST['cavflag'];  
$cavcity=$_POST['cavcity'];
$cavstate=$_POST['cavstate'];
$cavcountry=$_POST['cavcountry'];
 
if($cav_result5){
 $cav_list_data .= "<ul>";
 foreach($cav_result5 as $cav_session_record){
 if($cavflag) $flagClause="<img class='flag flag-".strtolower($cav_session_record['country_code'])."' src='".RAV_CAV_IMAGES_PATH."/blank.gif' />";   else $flagClause="";
 $cityClause=$stateClause=$countryClause="";
 if($cavcity) $cityClause=$cav_session_record['city'].", ";
 if($cavstate) $stateClause=$cav_session_record['state'].", ";
 if($cavcountry) $countryClause=$cav_session_record['country'].", ";
 $cavalldata=rtrim($cityClause.$stateClause.$countryClause, ", ");
 $cav_list_data .="<li>$flagClause $cavalldata</li>";
 }
 $cav_list_data .= "</ul>";  
}   
print $cav_list_data;    
}

 
die();      
} /* end ajax check */


}

/* Outputs list */
function cavshowlist($cav_list_options,$cav_return,$cav_list_id,$cav_visit_nonce=""){
$cav_return .='<script type="text/javascript">/* <![CDATA[ */ ';
ob_start();
include("cavlistcode.php");
$cav_return .=ob_get_clean();
$cav_return .= ' /* ]]> */  </script>';
return $cav_return;  
}

/* Set visitor status to offline who are inactive for last half an hour. */
function cav_half_hourly(){
global $wpdb;
$wpdb->query("update ".RAV_CAV_TABLE_SESSION." set visitor_status=0 where (end_timestamp='' || end_timestamp <= ".(time()-1800).") and visitor_status=1");     
}

/* Activate the plugin */
function rav_cav_activate(){
if (!current_user_can( 'activate_plugins' )) return;
    
$sql1="CREATE TABLE ".RAV_CAV_TABLE_SESSION." (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `country_code` varchar(25) NOT NULL,
  `visitor_status` tinyint(4) NOT NULL,
  `start_timestamp` varchar(25) NOT NULL,
  `end_timestamp` varchar(25) NOT NULL,
   PRIMARY KEY (`session_id`),
   UNIQUE KEY `id` (`id`)
)";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($sql1);

/* Schedule a cron job, if not already scheduled, to set visitor status to offline who are inactive for more than half hour */
if (!wp_next_scheduled('cav_half_hourly_event_hook')){
wp_schedule_event((current_time('timestamp')+10), 'halfhourly', 'cav_half_hourly_event_hook');
}

}

/* Deactivate the plugin */    
function rav_cav_deactivate(){
if (!current_user_can( 'activate_plugins' )) return;

/* Clears the cron job if plugin is deactivated */
wp_clear_scheduled_hook('cav_half_hourly_event_hook');
}

/* Uninstall the plugin */
function rav_cav_uninstall(){
global $wpdb;
if (!current_user_can( 'activate_plugins' )) return;
/* if ( __FILE__ != WP_UNINSTALL_PLUGIN ) return; */
$wpdb->query("DROP TABLE IF EXISTS ".RAV_CAV_TABLE_SESSION);
}

?>