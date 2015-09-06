<?php
/*
Template Name: Contact Us
*/
get_header(); ?>

<div class="container">
	<section class="page" style="margin: 20px 0; border: 1px solid #DDD; padding-bottom: 0 !important;">
		
		<div class="row">
			<header class="span12 ">
				<!-- Replace data-center with your address -->
				<?php $add = ot_get_option( 'hs_add1' ) .' '. ot_get_option( 'hs_add2' ) .' '. ot_get_option( 'hs_zip' ) .' '. ot_get_option( 'hs_country' ); ?>
				<div class="gmap" id="map" data-center="<?php echo $add; ?>" data-zoom="15"></div>
			</header>
		</div>

		<div class="wrap">
			<div class="row-fluid address">

				<div class="span4"  style="margin: 20px 0;">
					<div class="wrap contactform">
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
					</div>
				</div>

				<!-- Content -->
				<div class="span8 contactform " style=" border-left: 1px solid #DDD; padding:10px 20px;">	

					<?php while ( have_posts() ) : the_post(); ?>

						<div class="content clearfix">
							<?php the_content(); ?>
						</div>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'humbleshop' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'humbleshop' ), ' <p class="tcenter"><i class="icon-pencil"></i>', '</p>' ); ?>

						<div class="comments clearfix">
						
						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() )
								echo '<hr>';
								comments_template( '', true );
						?>	
						</div>

					<?php endwhile; // end of the loop. ?>					
				</div>
			
			</div>
		</div>

	</section>
</div>

<?php get_footer(); ?>