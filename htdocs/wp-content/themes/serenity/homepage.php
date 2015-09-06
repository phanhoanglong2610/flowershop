<?php
/*
Template Name: Homepage
*/
get_header(); ?>

		<?php get_template_part( 'slider', 'index' ); ?>
		
		
<div class="container">
	<section class="feat">
		


		<div class="row">

			<!-- Content -->
			<div class="span12">	
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="row">
						<?php //the_content(); ?>

						<h5 class="brands"><?php echo ot_get_option( 'hs_homefeat' ); ?></h5>

						<div class="span12">
							<?php do_action('woocommerce_before_shop_loop'); ?>
						</div>

						<div class="products clearfix">
						<?php
							$num = ot_get_option( 'hs_homefeatno' );
							$args = array( 'post_type' => 'product', 'posts_per_page' => $num );
							$args['meta_query'] = array();					
							$args['meta_query'][] = array(
								'key' => '_featured',
								'value' => 'yes'
							);
		
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
									
								<?php woocommerce_get_template_part( 'content', 'product' ); ?>
								
						<?php endwhile; ?>
						</div><!--/.products-->
					</div>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'humbleshop' ), 'after' => '</div>' ) ); ?>
					<?php edit_post_link( __( 'Edit', 'humbleshop' ), ' <p class="tcenter"><i class="icon-pencil"></i>', '</p>' ); ?>


				<?php endwhile; // end of the loop. ?>					
			</div>
		
		</div>
		<?php 
		$brand = ot_get_option( 'hs_brand' );
		$brandlist = ot_get_option( 'hs_brandlist' );

		if ($brandlist) { ?>
		<h5 class="subhead theme brands"><strong><?php echo $brand; ?></strong></h5>

			<div class="tab-brand">
				<div id="flexcarousel-brands" class="flexslider">
				  <ul class="slides">
				
					<?php foreach($brandlist as $key => $value) {
					 	echo '<li>';
					 	if ($value['hs_brandimage']) { 
					 		echo '<img src="'.$value['hs_brandimage'].'" alt="'.$value['title'].'" />';
					 	} else {
						 	echo '<img src="http://cambelt.co/200x100" />';
					 	}
					 	echo '</li>';
					} ?>
					
					</ul>
				</div>
			</div>
		<?php } ?>

	</section>
</div>
</div>

<?php get_footer(); ?>