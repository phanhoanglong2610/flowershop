<?php
/**
 * Template Name: Custom Registration Page
 */
require_once(ABSPATH . WPINC . '/registration.php');
global $wpdb, $user_ID;
//Check whether the user is already logged in
if (!$user_ID) {
    if($_POST){
        //We shall SQL escape all inputs
        $username = $wpdb->escape($_REQUEST['username']);
        if(empty($username)) {
            echo "<span class='error'>".__( "User name should not be empty.", ETHEME_DOMAIN )."</span>";
            exit();
        }
        $email = $wpdb->escape($_REQUEST['email']);
        if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email)) {
            echo "<span class='error'>".__( "Please enter a valid email.", ETHEME_DOMAIN )."</span>";
            exit();
        }
        $pass = $wpdb->escape($_REQUEST['pass']);
        $pass2 = $wpdb->escape($_REQUEST['pass2']);
        if(empty($pass) || strlen($pass) < 5) {
            echo "<span class='error'>".__( "Password should have more than 5 symbols", ETHEME_DOMAIN )."</span>";
            exit();
        }
        if($pass != $pass2) {
            echo "<span class='error'>".__( "The passwords do not match", ETHEME_DOMAIN )."</span>";
            exit();
        }
        
        $status = wp_create_user( $username, $pass, $email );
        if ( is_wp_error($status) )
            echo "<span class='error'>".__( "Username already exists. Please try another one.", ETHEME_DOMAIN )."</span>";
        else {
            $from = get_bloginfo('name');
            $from_email = get_bloginfo('admin_email');
            $headers = 'From: '.$from . " <". $from_email .">\r\n";
            $subject = "Registration successful";
            $msg = "\nYour login details:\nUsername: $username\nPassword: Your chosen password";
            wp_mail( $email, $subject, $msg, $headers );
            echo "<span class='success'>".__( "Please check your email for login details.", ETHEME_DOMAIN )."</span>";
        }
        exit();
    } else {
        $blog_layout = etheme_get_option('blog_layout');
        $blog_sidebar = etheme_get_option('blog_sidebar');
        $blog_sidebar_responsive = etheme_get_option('blog_sidebar_responsive');
        get_header();
        ?>
        <div class="container">
            <div class="row">
	            <?php blog_breadcrumbs(); ?>
                <div class="span12 grid_content with-sidebar-<?php echo $blog_sidebar ?>">			
                   <?php
                    if(get_option('users_can_register')) {
                        ?>
                        <h1 class="page-title"><?php the_title(); ?></h1>
                        <div id="result"></div> 
                        
                        <form id="wp_signup_form" action="" method="post" class="register">
                            <div class="login-fields">
                                <p class="form-row form-row-first register-head">
                                    <i class="icon-user"></i>
                                    <span class="register-span-big"><?php _e('New Customer?', ETHEME_DOMAIN); ?></span>
                                    <span class="register-span-small"><?php _e('Please, register your account to continue.', ETHEME_DOMAIN); ?></span>
                                </p>
                    			<p class="form-row form-row-first">
                                    <label><?php _e( "Enter your full name", ETHEME_DOMAIN ) ?> <span class="required">*</span></label>
                    				<input type="text" name="username" class="text" value="" />
                    			</p>
                    			<p class="form-row">
                                    <label><?php _e( "Enter your E-mail address", ETHEME_DOMAIN ) ?> <span class="required">*</span></label>
                    				<input type="text" name="email" class="text" value="" />
                    			</p>
                    			<p class="form-row">
                                    <label><?php _e( "Enter your password", ETHEME_DOMAIN ) ?> <span class="required">*</span></label>
                    				<input type="password" name="pass" class="text" value="" />
                    			</p>
                    			<p class="form-row form-row-last">
                                    <label><?php _e( "Re-enter your password", ETHEME_DOMAIN ) ?> <span class="required">*</span></label>
                    				<input type="password" name="pass2" class="text" value="" />
                    			</p>
                    			<div class="clear"></div>
                			</div>
                			<p class="form-row">
                				<button class="button fl-r submitbtn" type="submit"><span><?php _e( "Register", ETHEME_DOMAIN ) ?></span></button>
                                <div class="clear"></div>
                			</p>
                        </form>
                        <script type="text/javascript">
                            jQuery(".submitbtn").click(function() {
                                jQuery('#result').html('<img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" class="loader" />').fadeIn();
                                var input_data = jQuery('#wp_signup_form').serialize();
                                jQuery.ajax({
                                    type: "POST",
                                    url: "<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>",
                                    data: input_data,
                                    success: function(msg){
                                        jQuery('.loader').remove();
                                        jQuery('<div>').html(msg).appendTo('div#result').hide().fadeIn('slow');
                                        jQuery('#wp_signup_form').find("input[type=text], input[type=password], textarea").val("");
                                    }
                                });
                                return false;
                            });
                        </script>
                        <?php
                    }
                    else _e( '<span class="error">Registration is currently disabled. Please try again later.<span>', ETHEME_DOMAIN );
                    ?>
                </div>
                <div class="clear"></div>
    		</div>
		</div><!-- .container -->
        <?php
        get_footer();
    } //end of if($_post)
}
else {
    echo "<script type='text/javascript'>window.location='". home_url() ."'</script>";
}
?>