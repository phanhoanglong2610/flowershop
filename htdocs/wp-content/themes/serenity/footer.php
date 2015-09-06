<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package humbleshop
 * @since humbleshop 1.0
 */
?>

<!-- ============== -->
<!-- FOOTER SECTION -->
<!-- ============== -->
<footer style="margin-bottom: -30px;">
	<div class="container">
		<section class="row foot">

			<?php if ( ! dynamic_sidebar( 'sidebar-9' ) ) : ?>
				<article class="span3">
				<p class="title">No Sidebar Assigned</p>
				<p>Add widget on <a href="<?php echo home_url(); ?>/wp-admin/widgets.php">'Footer Widget One'</a> panel. </p>
				</article>
			<?php endif; // end sidebar widget area ?>	

			<?php if ( ! dynamic_sidebar( 'sidebar-10' ) ) : ?>
				<article class="span3">
				<p class="title">No Sidebar Assigned</p>
				<p>Add widget on <a href="<?php echo home_url(); ?>/wp-admin/widgets.php">'Footer Widget Two'</a> panel. </p>
				</article>
			<?php endif; // end sidebar widget area ?>
			
			<?php if ( ! dynamic_sidebar( 'sidebar-11' ) ) : ?>
				<article class="span3">
				<p class="title">No Sidebar Assigned</p>
				<p>Add widget on <a href="<?php echo home_url(); ?>/wp-admin/widgets.php">'Footer Widget Three'</a> panel. </p>
				</article>
			<?php endif; // end sidebar widget area ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-12' ) ) : ?>
				<article class="span3">
				<p class="title">No Sidebar Assigned</p>
				<p>Add widget on <a href="<?php echo home_url(); ?>/wp-admin/widgets.php">'Footer Widget Four'</a> panel. </p>
				</article>
			<?php endif; // end sidebar widget area ?>

			

		</section>
		
	
	</div>
	</footer>
<footer>
	<div class="container">
		<section class="row foot">

			<?php if ( ! dynamic_sidebar( 'sidebar-4' ) ) : ?>
				<article class="span3">
				<p class="title">No Sidebar Assigned</p>
				<p>Add widget on <a href="<?php echo home_url(); ?>/wp-admin/widgets.php">'Footer Widget One'</a> panel. </p>
				</article>
			<?php endif; // end sidebar widget area ?>	

			<?php if ( ! dynamic_sidebar( 'sidebar-5' ) ) : ?>
				<article class="span3">
				<p class="title">No Sidebar Assigned</p>
				<p>Add widget on <a href="<?php echo home_url(); ?>/wp-admin/widgets.php">'Footer Widget Two'</a> panel. </p>
				</article>
			<?php endif; // end sidebar widget area ?>

			<?php if ( ! dynamic_sidebar( 'sidebar-6' ) ) : ?>
				<article class="span3">
				
				<?php $tweet = ot_get_option( 'twitter' ); if ($tweet) { ?>
					<strong>Tweets</strong>
					<div id="tweet" class="<?php echo ot_get_option( 'twitter' ); ?>"></div>
				<?php } else { ?>
					<p class="title">No Sidebar Assigned</p>
					<p>Add widget on <a href="<?php echo home_url(); ?>/wp-admin/widgets.php">'Footer Widget Three'</a> panel. </p>	
				<?php } ?>
				
				</article>
			<?php endif; // end sidebar widget area ?>

			<?php if ( ! dynamic_sidebar( 'sidebar-7' ) ) : ?>
				<article class="span3">
				<strong class="title">Our location</strong>
				<address class="row-fluid">
							<div class="pull-left clabel"><i class="icon-location"></i></div>
							<div class="pull-left cdata">
							<?php 
								echo ot_get_option( 'hs_add1' ) . '<br />';
								echo ot_get_option( 'hs_add2' ) . '<br />';
								echo ot_get_option( 'hs_zip' ) . '<br />';
								echo ot_get_option( 'hs_country' );
							?>
							</div>
						</address>

						<?php $phone = ot_get_option( 'hs_phone' ); if ($phone) { ?>
							<address class="row-fluid">
								<div class="pull-left clabel"><i class="icon-phone"></i></div>
								<div class="pull-left cdata"><?php echo ot_get_option( 'hs_phone' ); ?></div>
							</address>
						<?php } ?>

						<?php $fax = ot_get_option( 'hs_fax' ); if ($fax) { ?>
							<address class="row-fluid">
								<div class="pull-left clabel"><i class="icon-print"></i></div>
								<div class="pull-left cdata"><?php echo ot_get_option( 'hs_fax' ); ?></div>
							</address>
						<?php } ?>

						<?php $email = ot_get_option( 'hs_email' ); if ($email) { ?>
							<address class="row-fluid">
								<div class="pull-left clabel"><i class="icon-mail"></i></div>
								<div class="pull-left cdata"><a href="mailto:<?php echo ot_get_option( 'hs_email' ); ?>"><?php echo ot_get_option( 'hs_email' ); ?></a></div>
							</address>
						<?php } ?>
							
				</article>
			<?php endif; // end sidebar widget area ?>	

		</section>
		
	
	</div>
		<section class="row-fluid doubleline">
		
			<div class="container">
			<div class="span6">

				<!-- Payment Method -->
				<?php $banks = ot_get_option( 'hs_bank' ); 
				if ($banks) {
					foreach($banks as $key => $value) {
					 	
					 	if($banks[$key]) {
					 		echo '<div class="payment '.$value.'"></div>';
					 	}
					} 
				}
				?>
				
			</div>
			<div class="span6 currency">
				
				<?php echo ot_get_option( 'hs_announcement' ); ?>

			</div>
			</div>
			
		</section>

		<section class="row-fluid social">
		<div class="container">
			<div class="pull-left">&copy; <?php do_action( 'humbleshop_credits' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> <small>/ <?php bloginfo( 'description' ); ?></small></div>
			<div class="pull-right">
				<ul>
					
					<!-- Social Networks -->
					<?php $fb = ot_get_option( 'facebook' ); if ($fb) { 
						echo '<li><a href="http://facebook.com/'.$fb.'" target="_blank"><i class="icon-facebook"></i></a></li>';
					} ?>
					<?php $twt = ot_get_option( 'twitter' ); if ($twt) { 
						echo '<li><a href="http://twitter.com/'.$twt.'" target="_blank"><i class="icon-twitter"></i></a></li>';
					} ?>
					<?php $gplus = ot_get_option( 'gplus' ); if ($gplus) { 
						echo '<li><a href="http://plus.google.com/'.$gplus.'" target="_blank"><i class="icon-gplus"></i></a></li>';
					} ?>
					<?php $pinterest = ot_get_option( 'pinterest' ); if ($pinterest) { 
						echo '<li><a href="http://pinterest.com/'.$pinterest.'" target="_blank"><i class="icon-pinterest"></i></a></li>';
					} ?>
					<?php $tumblr = ot_get_option( 'tumblr' ); if ($tumblr) { 
						echo '<li><a href="'.$tumblr.'" target="_blank"><i class="icon-tumblr"></i></a></li>';
					} ?>
					<?php $insta = ot_get_option( 'instagram' ); if ($insta) { 
						echo '<li><a href="http://instagram.com/'.insta.'" target="_blank"><i class="icon-instagrem"></i></a></li>';
					} ?>

				</ul>
			</div>
		</section>
		</div>
</footer>

<?php wp_footer(); ?>

</body>
</html><a href="http://www.wplocker.com">theme shared on wplocker.com</a>