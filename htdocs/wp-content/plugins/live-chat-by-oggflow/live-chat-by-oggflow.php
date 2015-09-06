<?php
/*
Plugin Name: Live Chat by OggFlow
Plugin URI: http://www.oggflow.com
Description: OggFlow is a powerful live chat and customer service suite that includes customizable live chat, email ticketing, social media feeds, and team collaboration.
Version: 1.1.1
Author: OggFlow
Author URI: http://www.oggflow.com/
*/

$plugurldir = get_option('siteurl').'/'.PLUGINDIR.'/live-chat-by-oggflow/';
$oggchat_domain = 'LiveChatByOggFlow';
load_plugin_textdomain($oggflow_domain, 'wp-content/plugins/live-chat-by-oggflow');
add_action('init', 'oggflow_init');
add_action('wp_footer', 'oggflow_insert');
add_action('admin_notices', 'oggflow_notice');
add_filter('plugin_action_links', 'oggflow_plugin_actions', 10, 2);

define('OGGFLOW_DASHBOARD_URL', "https://oggflow.icoa.com/");
define('OGGFLOW_SMALL_LOGO',$plugurldir.'/ofsq.png');

function oggflow_init() {
    if(function_exists('current_user_can') && current_user_can('manage_options')) {
        add_action('admin_menu', 'oggflow_add_settings_page');
        add_action('admin_menu', 'oggflow_create_menu');
    }
}


function OGGFLOW_dashboard() {

    echo '<div id="dashboarddiv"><iframe id="dashboardiframe" src="'.OGGFLOW_DASHBOARD_URL.'" height=700 width=98% scrolling="yes"></iframe></div>      <a href="'.OGGFLOW_DASHBOARD_URL.'" target="_newWindow" onClick="javascript:document.getElementById(\'dashboarddiv\').innerHTML=\'\'; ">Open OggFlow in a new window</a>.
      ';
}

function oggflow_insert() {
    global $current_user;

    if(get_option('oggflowID')) {
        get_currentuserinfo();
        echo("\n\n<!-- OggFlow Tab Button --><link id=\"oggfeedbackcss\" type=\"text/css\" rel=\"stylesheet\" href=\"https://oggfeedback.icoa.com/oggfeedbackcss/".get_option('oggflowID')."\"/>");
  
        echo("\n<script type=\"text/javascript\" language=\"javascript\" src=\"https://oggfeedback.icoa.com/oggfeedback/oggfeedback.nocache.js\" async></script>\n");
       
    }
}

function oggflow_notice() {
    if(!get_option('oggflowID')) echo('<div class="error"><p><strong>'.sprintf(__('Your Live Chat by OggFlow Plugin is disabled. Please go to the <a href="%s">plugin settings</a> to enter a valid chat widget key.  Find your chat widget key by logging into www.oggflow.com and clicking on Live Chat, then Chat Widgets in the left hand navigation.  Your chat widget key is located on the General Settings tab.  New to OggFlow.com?  <a href="http://www.oggflow.com">Sign up for Free!</a>' ), admin_url('options-general.php?page=live-chat-by-oggflow')).'</strong></p></div>');
}

function oggflow_plugin_actions($links, $file) {
    static $this_plugin;
    if(!$this_plugin) $this_plugin = plugin_basename(__FILE__);
    if($file == $this_plugin && function_exists('admin_url')) {
        $settings_link = '<a href="'.admin_url('options-general.php?page=live-chat-by-oggflow').'">'.__('Settings', $oggflow_domain).'</a>';
        array_unshift($links, $settings_link);
    }
    return($links);
}

function oggflow_add_settings_page() {
    function oggflow_settings_page() {
        global $oggflow_domain, $plugurldir; ?>
<div class="wrap">
        <?php screen_icon() ?>
    <h2><?php _e('Live Chat by OggFlow', $oggflow_domain) ?></h2>
    <div class="metabox-holder meta-box-sortables ui-sortable pointer">
        <div class="postbox" style="float:left;width:30em;margin-right:10px">
            <h3 class="hndle"><span><?php _e('OggFlow Settings', $oggflow_domain) ?></span></h3> 
            <div class="inside" style="padding: 0 10px">
                <form id="saveSettings" method="post" action="options.php">
                    <p style="text-align:center"><?php wp_nonce_field('update-options') ?><a href="http://www.oggflow.com/" title="<?php _e('Simply Beautiful live chat and help desk software that supports ticketing, social media, and 3rd party integrations', $oggflow_domain) ?>"><img src="<?php echo($plugurldir) ?>oggflow.png" height="86" width="230" alt="<?php _e('Live Chat by OggFlow', $oggflow_domain) ?>" /></a></p>

                    <p><label for="oggflowID"><?php printf(__('Enter your %1$sIf you don\'t have an account, click here to learn more about OggFlow%2$sOggFlow%3$s chat widget key below to activate the plugin.  If you don\'t have your key, enter the email address you signed up with and click Generate Key.', $oggflow_domain), '<strong><a href="http://www.oggflow.com/" title="', '">', '</a></strong>') ?></label><br />
			<input type="text" name="oggflowID" id="oggflowID" placeholder="Your Chat Widget Key" value="<?php echo(get_option('oggflowID')) ?>" style="width:100%" />
                    <p class="submit" style="padding:0"><input type="hidden" name="action" value="update" />
                        <input type="hidden" name="page_options" value="oggflowID" />
                        <input type="button" name="oggflowGenerate" id="oggflowGenerate" value="<?php _e('Generate Key', $oggflow_domain) ?>" class="button-primary" style="margin:3px;"/> 
			<input type="submit" name="oggflowSubmit" id="oggflowSubmit" value="<?php _e('Save Settings', $oggflow_domain) ?>" class="button-primary" /> 
			</p>
                 <small class="nonessential"><?php _e('<br>Your Chat Widget Key is located at OggFlow.com under Live Chat --> Chat Widgets --> Your Domain.', $oggflow_domain) ?></small></p>
                   </form>
            </div>
        </div>
        <div class="postbox" style="float:left;width:38em">
            <h3 class="hndle"><span id="noAccountSpan"><?php _e('No Account?  Sign up now for free!', $oggflow_domain) ?></span></h3>
            <div id="register" class="inside" style="padding: -20px 10px">			
		<p><?php printf(__('OggFlow is a powerful live chat and customer service suite that includes email ticketing, social media feeds, 
			team collaboration, and Gmail integration all in one familiar interface.  
			Please visit %1$sLive Chat and Live Help Software for your website%2$sOggFlow.com%3$s to 
					learn more.', $oggflow_domain), '<a href="http://www.oggflow.com/" title="', '">', '</a>') ?></p>
			<b>Sign Up For Free Now!</b><br>
			<input type="hidden" name="oggflowDomain" id="oggflowDomain" value="<?php echo(get_option('home')) ?>" />
			
			<input type="text" name="oggflowEmail" id="oggflowEmail" value="<?php echo(get_option('admin_email')) ?>" style="width:50%;margin:3px;" />
			<input type="text" name="oggflowName" id="oggflowName" value="<?php echo(get_option('user_nicename')) ?>" placeholder="Your Name" style="width:50%;margin:3px;" />
			<input type="password" name="oggflowPassword" id="oggflowPassword" value="" placeholder="Your Password" style="width:50%;margin:3px;" />
			<br><input type="button" name="oggflowRegister" id="oggflowRegister" value="Register" class="button-primary" style="margin:3px;" /> 
			
			<br><small class="nonessential">Once you sign up, you can login with your email and password using the OggFlow link
			in your WordPress admin site or at OggFlow.com.  Accept 
			chats right from there or configure your Jabber/Gtalk/SMS settings in the Chat Widget settings at OggFlow.com.</small>
                 
               
            </div>
	    <div id="registerComplete" class="inside" style="padding: -20px 10px;display:none;">
		  Answer chats, create tickets, and configure advanced settings at OggFlow.com.  You can set up SMS or Jabber (Gtalk) notifications
			in your Chat Widget --> Agent Settings.

<br><br>
Visit us at <a href="http://www.oggflow.com">oggflow.com</a> to learn more about how OggFlow can help you provide great service and improve company communication.
	    </div>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function($) {

var wid= $('#oggflowID').val();
if (wid=='') 
{
	 $('#oggflowID').val($('#oggflowEmail').val());
}
else
{
	$( "#register" ).hide();
	$( "#registerComplete" ).show();
	$( "#noAccountSpan" ).html("Remember to Login to OggFlow ");

}
$(document).on("click", "#oggflowGenerate", function () {

 var email= $('#oggflowID').val();
 var url = 'https://oggflow.icoa.com/oggFlowJsonSignup?email='+email+'&callback=?';

 $.ajax({
   type: 'GET',
    url: url,
    async: false,
    jsonpCallback: 'jsonCallback',
    contentType: "application/json",
    dataType: 'jsonp',
    success: function(json) {
       if (json.status=='success') {
		$('#oggflowID').val(json.wid);
		$( "#saveSettings" ).submit();
	}
	else {
		alert("Invalid Email.  You can sign up for free to the right.");
	}
    },
    error: function(e) {
       
    }
 });
});

$(document).on("click", "#oggflowRegister", function () {

 var email= $('#oggflowEmail').val();
 var name= $('#oggflowName').val();
 var password= $('#oggflowPassword').val();
 var domain=$('#oggflowDomain').val();

 var url = 'https://oggflow.icoa.com/oggFlowJsonSignup?domain='+domain+'&name='+name+'&email='+email+'&pwd='+password+'&callback=?';
 $.ajax({
   type: 'GET',
    url: url,
    async: false,
    jsonpCallback: 'jsonCallback',
    contentType: "application/json",
    dataType: 'jsonp',
    success: function(json) {
       if (json.status=='success') {
	$('#oggflowID').val(json.wid);
		
		alert("Thanks for signing up!");

	$( "#saveSettings" ).submit();
		
	}
	else {
		alert(json.msg);
	}
    },
    error: function(e) {
      
    }
 });



});

});
</script>

    <?php }
    add_submenu_page('options-general.php', __('OggFlow Settings', $oggflow_domain), __('OggFlow Settings', $oggflow_domain), 'manage_options', 'live-chat-by-oggflow', 'oggflow_settings_page');
}

function oggflow_create_menu() {
    //create new top-level menu
    add_menu_page('Account Configuration', 'OggFlow', 'administrator', 'OGGFLOW_dashboard', 'OGGFLOW_dashboard', OGGFLOW_SMALL_LOGO);
    add_submenu_page('OGGFLOW_dashboard', 'Dashboard', 'Dashboard', 'administrator', 'OGGFLOW_dashboard', 'OGGFLOW_dashboard');
}
?>
