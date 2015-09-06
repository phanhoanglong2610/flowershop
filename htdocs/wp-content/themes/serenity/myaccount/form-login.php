<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce; ?>

<?php $woocommerce->show_messages(); ?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

<div class="col2-set row-fluid" id="customer_login">

	<div class="col-1 span6">

<?php endif; ?>

		<ul class="nav nav-tabs" id="myTab">
		  <li class="active"><a href="#login"><i class="icon-lock"></i> <?php _e('Returning Customer', 'woocommerce'); ?></a></li>
		  <li><a href="#forgot"><i class="icon-help"></i> <?php _e('Lost Password', 'woocommerce'); ?></a></li>
		</ul>
		
		<div class="tab-content">

			<!-- Login -->
			<div class="tab-pane active" id="login">
				
				<form method="post" class="login form-horizontal">
					
					<div class="control-group">
						<label for="username" class="control-label"><?php _e('Username/email', 'woocommerce'); ?> <span class="required">*</span></label>
						<div class="controls">
							<input type="text" class="input-text" name="username" id="username" />	
						</div>
					</div>
					<div class="control-group">
						<label for="password" class="control-label"><?php _e('Password', 'woocommerce'); ?> <span class="required">*</span></label>					<div class="controls">
							<input class="input-text" type="password" name="password" id="password" />
						</div>
					</div>
					
					<div class="control-group">
						<div class="controls">
							<?php $woocommerce->nonce_field('login', 'login') ?>
							<input type="submit" class="button btn theme" name="login" value="<?php _e('Login', 'woocommerce'); ?>" />
						</div>
					</div>
				</form>
			</div>
			
			<div class="tab-pane" id="forgot">
				<p class="padding">Click <a href="<?php echo esc_url( wp_lostpassword_url( home_url() ) ); ?>" class="theme"> <?php echo ot_get_option( 'hs_Lng_ForgotLink' ); ?></a> </p>
			</div>
			
		</div>
		

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

	</div>

	<div class="col-2 span6">
	
		<ul class="nav nav-tabs" id="myTab">
		  <li class="active"><a href="#register"><i class="icon-pencil"></i> <?php _e('Register', 'woocommerce'); ?></a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="register">
			
			<form method="post" class="register form-horizontal">

				<?php if ( get_option( 'woocommerce_registration_email_for_username' ) == 'no' ) : ?>
	
					<div class="control-group">
						<label for="reg_username" class="control-label"><?php _e('Username', 'woocommerce'); ?> <span class="required">*</span></label>
						<div class="controls">
							<input type="text" class="input-text" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
						</div>
					</div>
	
					<div class="control-group">
	
				<?php else : ?>
	
					<div class="control-group">
	
				<?php endif; ?>
	
						<label class="control-label" for="reg_email"><?php _e('Email', 'woocommerce'); ?> <span class="required">*</span></label>
						<div class="controls">
							<input type="email" class="input-text" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
						</div>
					
					</div>
	
				<div class="clear"></div>
	
				<div class="control-group">
					<label class="control-label" for="reg_password"><?php _e('Password', 'woocommerce'); ?> <span class="required">*</span></label>
					<div class="controls">
						<input type="password" class="input-text" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="reg_password2"><?php _e('Re-enter password', 'woocommerce'); ?> <span class="required">*</span></label>
					<div class="controls">
						<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if (isset($_POST['password2'])) echo esc_attr($_POST['password2']); ?>" />
					</div>
				</div>
	
				<!-- Spam Trap -->
				<div class="control-group">
					<label class="control-label" for="trap">Anti-spam</label>
					<div class="controls">
						<input type="text" name="email_2" id="trap" />
					</div>
				</div>
	
				<?php do_action( 'register_form' ); ?>
	
				<div class="control-groups">
					<div class="controls">
						<?php $woocommerce->nonce_field('register', 'register') ?>
						<input type="submit" class="button btn theme" name="register" value="<?php _e('Register', 'woocommerce'); ?>" />
					</div>
				</div>
	
			</form>
			
			</div>
		</div>		

	</div>

</div>
<?php endif; ?>
<?php do_action('woocommerce_after_customer_login_form'); ?>