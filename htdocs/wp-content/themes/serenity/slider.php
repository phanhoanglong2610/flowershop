<!-- ============== -->
<!-- SLIDER SECTION -->
<!-- ============== -->

	<div class="homepagecontainer">
	<div class="slides home-span12">
	<div id="flexslider" class="flexslider row">
	  <ul class="slides span12">
	  	<?php $slide = ot_get_option( 'hs_slider' );

		if ($slide) {
			foreach($slide as $key => $value) {
			 	echo '<li>';
			 	if ($value['hs_slidelink']) { 
			 		echo '<a href="'.$value['hs_slidelink'].'">';
			 		echo '<img src="'.$value['hs_slideimage'].'" alt="'.$value['title'].'" />';
			 		echo '</a>';
			 	} else {
			 		echo '<img src="'.$value['hs_slideimage'].'" alt="'.$value['title'].'" />';
			 	}
			 	if ($value['hs_slidetext']) {
			 		echo '<p class="flex-caption">';
			 		echo $value['hs_slidetext'];
			 		echo '</p>';
			 	}
			 	echo '</li>';
			}
		}

		?>
	  </ul>
	</div>
	


<!-- ======== -->
<!-- Carousel --
><!-- ======== -->

<?php 
	$carousel = ot_get_option( 'hs_slidercarousel' );
	if ($carousel) { ?>
	<div class="carousel-option">
		<div id="flexcarousel" class="flexslider">
			<ul class="slides">

			<?php foreach($slide as $key => $value) {
				echo '<li><img src="'.$value['hs_slideimage'].'" alt="'.$value['title'].'" /></li>'; 
			} ?>

			</ul>
		</div>
	</div>

<?php } ?>
</div>
<!-- =================== -->
<!-- Promo Banner Option -->
<!-- =================== -->
<div class="clearfix"></div>
<?php 
	$banner = ot_get_option( 'hs_banner' );
	$promo = ot_get_option( 'hs_promos' );
	if ($banner) { ?>
	<section class="home-panel promo">
		<div class="container">
		<div class="row-fluid">

			<?php foreach($promo as $key => $value) {
				echo '<article class="span4"><a href="'.$value['hs_bannerlink'].'"><img src="'.$value['hs_bannerimg'].'" alt="'.$value['title'].'" /></a></article>'; 
			} ?>
			
		</div>
		</div>
	</section>

<?php } ?>