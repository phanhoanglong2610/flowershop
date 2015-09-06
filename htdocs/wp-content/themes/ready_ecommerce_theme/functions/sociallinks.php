<?php
/*
Plugin Name: Social Links
Plugin URI: http://blog.maybe5.com/?page_id=94
Description: Social Links is a sidebar widget that displays icon links to your profile pages on other social networking sites.
Author: Kareem Sultan
Version: 1.0.11
Author URI: http://blog.maybe5.com

/*  Copyright 2008  Kareem Sultan  (email : kareemsultan@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

http://www.gnu.org/licenses/gpl.txt

*/
		
//TO DO use these definitions instead
define('SOCIAL_LINKS_VERSION', '1.0.11');
define('SOCIAL_LINKS_DB_VERSION', '1.1');

define('KEY_SITE_ID',0);
define('KEY_IMAGE',1);
define('KEY_URL_TEMPLATE',2);
define('KEY_INSTRUCTION',3);
define('KEY_DISPLAY_NAME',4);
  
 $plugindir = get_template_directory_uri();

 $definitions = array(
	 array(0,'facebook.png','%userid%','Enter your complete Facebook profile URL','Facebook'),
	 array(1,'myspace.png','%userid%','Enter your complete MySpace URL.','MySpace'),
	 array(2,'linkedin.png','%userid%','Enter your complete LinkedIn URL.','LinkedIn'),
         array(3,'picasa.png','http://picasaweb.google.com/%userid%','Enter your Picasa(Google) username.','Picasa Web Album'),
	 array(4,'flickr.png','http://flickr.com/photos/%userid%','Enter your flickr username','Flickr'),
	 array(5,'youtube.png','http://www.youtube.com/%userid%','Enter your YouTube username','YouTube'),
	 array(6,'twitter.png','http://twitter.com/%userid%','Enter your Twitter username','Twitter'),
	 array(7,'pownce.png','http://pownce.com/%userid%','Enter your Pownce username','Pownce'),
	 array(8,'plurk.png','http://www.plurk.com/user/%userid%','Enter your Plurk username','Plurk'),
	 array(9,'digg.png','http://www.digg.com/users/%userid%','Enter your Digg username.','Digg'),
	 array(10,'delicious.png','http://delicious.com/%userid%','Enter your Delicious username','Delicious'),
	 array(11,'blogmarks.png','http://blogmarks.net/user/%userid%','Enter your BlogMarks username.','BlogMarks'),
	 array(12,'stumbleupon.png','http://%userid%.stumbleupon.com','Enter your Stumble Upon username','Stumble Upon'),
         array(13,'lastfm.png','http://www.last.fm/user/%userid%','Enter your Last.fm username','Last.fm'),
	 array(14,'amazon.png','%userid%','Enter your complete Amazon Wishlist URL','Amazon Wishlist'),
	 array(15,'blog.png','%userid%','Enter the complete blog URL.','Blog'),
	 array(16,'jeqq.png','http://www.jeqq.com/user/view/profile/%userid%','Enter your Jeqq username','Jeqq'),
         array(17,'dapx.png','%userid%','Enter your complete Dapx URL.','Dapx'),
	 array(18,'xing.jpg','%userid%','Enter your complete Xing URL.','Xing'),
	 array(19,'sixent.png','http://%userid%.sixent.com/','Enter your Sixent username','Sixent'),
	 array(20,'technorati.jpg','http://technorati.com/people/technorati/%userid%/','Enter your Technorati username.','Technorati'),
	 array(21,'friendfeed.png','http://friendfeed.com/%userid%','Enter your FriendFeed username.','FriendFeed')
   );
//Administration page
 $message = '';
 $messageClass = '';
 

/**
 * Social Links Class for Follow Us block
 */
class SocialLinks {
    /**
     * construct Social Link object
     * @global string $plugindir
     */
    function SocialLinks() {
        global $plugindir;
        if (is_admin()) {
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script('jquery-ui-droppable');
            wp_enqueue_script('jquery-ui-draggable');
            wp_enqueue_script('social-links', $plugindir . '/js/sociallinks.js',array('jquery'));
            wp_enqueue_style('social-links-style',$plugindir . '/css/sociallinks.css');
        }
        //Add action to load sub menu
        add_action('admin_menu', array(&$this,'social_links_admin_menu'));
        //Add ajax callback action called from client side javascript
        add_action('wp_ajax_social_links_add_network', array(&$this,'addNetwork'));
        add_action('wp_ajax_social_links_delete_network', array(&$this, 'deleteNetwork'));
        add_action('wp_ajax_social_links_sort_networks', array(&$this, 'saveSortOrder'));

        register_sidebar_widget('Social Links', 'widget_social_links');
        register_widget_control('Social Links', 'widget_social_links_control');
    }
    /**
     *
     * @global type $wpdb 
     */
    function social_links_install(){
        global $wpdb;
        $table_name = $wpdb->prefix . "social_links";
        if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {
            $sql = "CREATE TABLE " . $table_name . " (
                       id mediumint(9) NOT NULL AUTO_INCREMENT,
                       network_id int not null,
                       user_info VARCHAR(55) NOT NULL,
                       sort_order int not null DEFAULT 0,
                       UNIQUE KEY id (id)
                    );";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            add_option("SOCIAL_LINKS_DB_VERSION", SOCIAL_LINKS_DB_VERSION);
        }
    }
    /**
     *  Displays the icons in the sidebar
     */
    function widget_social_links($args) {
        global $definitions;
        extract($args);

        $options = get_option('widget_social_links');
        $title = empty($options['title']) ? 'Social Links' : $options['title'];
        $width =  empty($options['width']) ? 20 : $options['width'];

        echo $before_widget;
        echo $before_title . $title . $after_title ;

        echo "<div id='socialLinksContainer' style='width:$width"."px;'>";
        echo $this->generateSocialLinksInnerHTML();
        echo '</div>';
        echo $after_widget;
    }

    /**
     * Config Panel
     */
    function widget_social_links_control() {
            global $definitions;
            $options = get_option('widget_social_links');

            if ( $_POST['social-links-submit'] ) {
                // Clean up control form submission options
                $newoptions['title'] = strip_tags(stripslashes($_POST['social-links-title']));
                $newoptions['width'] = strip_tags(stripslashes($_POST['social-links-width']));

                if ( $options != $newoptions ) {
                        $options = $newoptions;
                        update_option('widget_social_links', $options);
                }
            }

            $title = empty($options['title']) ? 'Social Links' : $options['title'];
            $width = empty($options['width']) ? 100 : $options['width'];

            ?>

                    <table>
                            <tr><td>
                                    <label for="social-links-title">Widget title: <input type="text" id="social-links-title" name="social-links-title" value="<?php echo $title; ?>" /></label>
                            </td></tr>
                            <tr><td>
                                    <label for="social-links-width">Width: <input type="text" id="social-links-width" name="social-links-width" style="width:25px;" value="<?php echo $width; ?>" /> pixels</label>
                            </td></tr>
                    </table>
                    <input type="hidden" name="social-links-submit" id="social-links-submit" value="1" />

            <?php
    }//End of widget_social_links_control

    /**
     * Add Social Network Link
     * @global array $definitions 
     */
    function addNetwork(){
        // read submitted information
        global $definitions;
        if (isset($_POST['siteID']) && is_numeric($_POST['siteID'])) {
            $siteID = $_POST['siteID'];
        } else {
            $result = __('Invalid Social Network', 'ready_ecommerce');
            $response = array('result' => $result, 'html' => $innerHTML);
            echo json_encode($response);
            die();
        }
        
        $data = $_POST['value'];

        $result = $this->insertNetwork($siteID, $data);
        if($result == 1) {
              $result = __('Link added', 'ready_ecommerce');
        } else {
              $result = __('There was a problem adding the link. Refresh the page and try again', 'ready_ecommerce');
        }
        $innerHTML = $this->generateSocialLinksPreviewInnerHTML('');
        $response = array('result' => $result, 'html' => $innerHTML);
        echo json_encode($response);
        die();
    }
    /**
     * Delete Social Network Link
     * @global type $wpdb
     */	
    function deleteNetwork(){
        global $wpdb;
        if (isset($_POST['link_id']) && is_numeric($_POST['link_id'])) {
            $linkId = $_POST['link_id'];
        } else {
            die();
        }
        $table_name = $wpdb->prefix . "social_links";
        $sql = 'DELETE FROM ' .  $table_name . ' WHERE `id` = '.$linkId;
        $result = $wpdb->query($wpdb->prepare($sql));

        if ($result == 1) {
                $result = __('Removed link', 'ready_ecommerce');
        } else {
                $result = __('There was a problem deleting the link. Refresh the page and try again', 'ready_ecommerce');
        }
        echo $result;
        die();
    }
    /**
     * Insert Social Link data to database
     * @global type $wpdb
     * @param type $id
     * @param type $value
     * @return type 
    */
     function insertNetwork($id, $value){
        global $wpdb;
        $table_name = $wpdb->prefix . "social_links";
        $sql = 'INSERT INTO ' .  $table_name . ' (network_id,user_info,sort_order) VALUES ("'.$id.'","'.$value.'",1000)';
        $result = $wpdb->query($wpdb->prepare($sql));
        return $result;
     }
     /**
      * Get All the social links
      * @global type $wpdb
      * @return type 
      */
     function getSocialLinks(){
            global $wpdb;
            $table_name = $wpdb->prefix . "social_links";
            $sql = 'SELECT * FROM ' .  $table_name . ' ORDER BY `sort_order`';
            $results = $wpdb->get_results($sql,ARRAY_N);
            return $results;
     }
     /**
      *
      * @global array $definitions
      * @global string $plugindir
      * @return string 
      */
     function generateSocialLinksInnerHTML(){
            global $definitions;
            global $plugindir;

            $options = get_option('widget_social_links');

            $rows = $this->getSocialLinks();
            if(count($rows)==0)
                    return;	 	
            foreach ($rows as $row) {
                    $linkInfoArray = $definitions[$row[1]];
                    $url = str_replace("%userid%",$row[2],$linkInfoArray[KEY_URL_TEMPLATE]);
                    $innerHTML = $innerHTML . "<a target='_blank' id='link_$row[0]' href='$url'><img width='25' height='25' style='padding:5px;' src='$plugindir/images/social_links/".$linkInfoArray[KEY_IMAGE]."' alt='".$linkInfoArray[KEY_DISPLAY_NAME]."'/></a>";
                    if($row != $rows[count($rows)-1]){
                            $innerHTML = $innerHTML."\n";
                    }
            }

            return $innerHTML;
     }
     /**
      *
      * @global array $definitions
      * @global string $plugindir
      * @param type $delimiter
      * @return string 
      */   
     function generateSocialLinksPreviewInnerHTML($delimiter){
            global $definitions;
            global $plugindir;

            $rows = $this->getSocialLinks();
            if(count($rows)==0)
                    return;

            foreach ($rows as $row) {
                $linkInfoArray = $definitions[$row[1]];
                $url = str_replace("%userid%",$row[2],$linkInfoArray[KEY_URL_TEMPLATE]);
                $innerHTML = $innerHTML . "<span id='link_$row[0]' title='$url'><img style='margin:2px' src='$plugindir/images/social_links/".$linkInfoArray[KEY_IMAGE]."' alt='".$linkInfoArray[KEY_DISPLAY_NAME]."'/></span>";
                if($row != $rows[count($rows)-1]){
                        $innerHTML = $innerHTML.$delimiter;
                }
            }

            return $innerHTML;
     }
     /**
      *
      */
     function social_links_admin_menu(){
          add_submenu_page('theme_settings','Follow Us Settings', 'Social Links', 'edit_theme_options', 'follow-us', array(&$this,'widget_social_links_settings'));
     }
     /**
      *
      * @global array $definitions
      * @global type $message
      * @global type $messageClass
      * @global string $plugindir 
      */
     function widget_social_links_settings(){
        if (isset($_POST['saveorder'])){
                $this->saveSortOrder();
        }

        global $definitions;
        global $message;
        global $messageClass;
        global $plugindir;

        $visibility = 'hidden';
        if(!empty($messageClass))
                $visibility = 'visible';

        ?>
        <div class="wrap">
            <h2><?php _e('Social Links','ready_ecommerce') ?></h2>
                <div id="sl_message" class="<?php echo $messageClass;  ?>" style="visibility:<?php echo $visibility;  ?>;">
                    <?php echo $message;  ?>
                </div>
                <div id="select_network">
                        <h3><?php _e('Add New Social Link','ready_ecommerce') ?></h3>
                        <select id="networkDropdown">
                                <option value=""><?php _e('Select network...','ready_ecommerce'); ?></option>
                                <?php
                                    foreach ($definitions as $key => $linkInfoArray){
                                            echo '<option value="'.$linkInfoArray[0].'" instruction="'.$linkInfoArray[3].'">'.$linkInfoArray[4].'</option>';
                                    }
                                ?>
                        </select>

                        <label id="instruction"></label>
                        <br/>
                        <input type="text" id="addSettingInput" value="" />
                        <input type="button" id="addButton" value="Add" disabled=true />
                        <br/>
                </div> 
                <div id="preview">
                    <div id="social_links_preview">
                            <h3><?php _e('Preview','ready_ecommerce') ?></h3>
                            <div id="displayDiv">
                                    <?php echo $this->generateSocialLinksPreviewInnerHTML("\n");  ?>
                            </div>
                    </div>
                    <div id="trash">
                        <img src="<?php echo $plugindir ?>/images/social_links/trash.jpg"/>
                    </div>
                    <div style="clear: both;"> </div>
                    <img class="ajax-loader" src="<?php echo $plugindir?>/images/social_links/ajax-loader.gif" />
                </div>
              <div>
                <p>
                  <?php _e('For Facebook, MySpace, LinkedIn, Blog: Enter your complete profile URL <br />
                    For Picasa, Flickr, YouTube, Twitter, Pownce, Plurk, Digg, Delicious, BlogMarks, Stumble Upon, Last.FM, Amazon, Jeqq, Dapx, Xing, Sixent, Technorati, FriendFeed: Enter your username.<br />
        
                    To add a new link select the network from the drop down, fill in the appropriate information and press enter.<br/>
                  To change the order they appear, rearrange the icons in the preview and click "Save Order". <br/>
                  To delete a link, simply drag it to the trash can.', 'ready_ecommerce'); ?>
                </p>
              </div>
        </div>	
    <?php
    }//End of widget_social_links_settings
    /**
     * Sort the order of social links
     * @global type $wpdb
     * @global type $message
     * @global type $messageClass 
     */
    function saveSortOrder(){
	global $wpdb;
	$sortDataOrder = !empty($_POST['links']) ? $_POST['links'] : '';
	if(!empty($sortDataOrder)){
            $table_name = $wpdb->prefix . "social_links";
            foreach($sortDataOrder as $order => $id){
                    $sql = 'UPDATE ' .  $table_name . ' SET `sort_order` ='.$order.' WHERE `id` ='.$id;
                    $result = $wpdb->query($wpdb->prepare($sql));
            }
            $message = __("Saved links' order", 'ready_ecommerce');
         } else {
            $message = __("No items to save",'ready_ecommerce');
         }
         echo $message;
         die();
    }
		
}//End of SocialLinks class

?>