<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce;

if (is_user_logged_in()) return;
?>
<form method="post" class="login form-horizontal well">
	<?php if ($message) echo wpautop(wptexturize($message)); ?>

	<div class="control-group">
		<label for="username" class="control-label"><?php _e('Username or email', 'woocommerce'); ?> <span class="required">*</span></label>
		<div class="controls">
		  <input type="text" class="input-text inpul-small" name="username" id="username" />
		</div>
	</div>

	<div class="control-group">
		<label for="password" class="control-label"><?php _e('Password', 'woocommerce'); ?> <span class="required">*</span></label>
		<div class="controls">
		  <input type="text" class="input-text inpul-small" name="username" id="username" />
		</div>
	</div>

	<div class="control-group">
		<?php $woocommerce->nonce_field('login', 'login') ?> 

		<div class="controls">
		  <input type="submit" class="btn button" name="login" value="<?php _e('Login', 'woocommerce'); ?>" />
		  <input type="hidden" name="redirect" value="<?php echo $redirect ?>" /> 
			<a class="lost_password" href="<?php echo esc_url( wp_lostpassword_url( home_url() ) ); ?>"><?php _e('Lost Password?', 'woocommerce'); ?></a>	  
		</div>
	</div>
</form>