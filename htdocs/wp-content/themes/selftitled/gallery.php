<?php 

/* Template name: Gallery */

get_header(); the_post();

global $post;

if ( !post_password_required( $post ) ) {
?>

<script type="text/javascript">

jQuery(document).ready(function($) {
// run slider

	$('.loading').show();

	jQuery(document).ready(function($) {
		$('.ketslider').ketslider({
		animationDuration: <?php echo $data['slider_time'] * 1000; ?>,
		directionNav: <?php echo $data['gallery_arrows']; ?>,
		keyboardNav: <?php echo $data['gallery_keyboard']; ?>,
		label: <?php echo $data['gallery_slide']; ?>,
		number: <?php echo $data['gallery_number']; ?>,
		mousewheel: <?php echo $data['gallery_mousewheel']; ?>,
		wrap: <?php echo $data['loop_gallery']; ?>,
		slideshow: <?php echo $data['slideshow']; ?>,
		slideshowInterval: <?php echo $data['slideshowInterval']* 1000; ?>
		});
	});
	
	
	$(window).load(function() {
		$('.loading').fadeOut('300');
	});
	
});	
	
</script>
	
	<!-- article starts -->		
	<article class="ketslider" id="post-<?php the_ID(); ?>">

		<!-- heading -->
		<h2 class="page_title"><?php the_title(); ?></h2>


		<!-- slider -->   
		
		<?php the_content(); ?>
	
	
		<!-- slider ends -->
		
	</article>
	<!-- article ends -->

<!-- div for image preloading -->
<div class="loading"></div>

<?php } else {
?>

<!-- wrapper -->
<div id="wrapper">		
	
	<!-- heading -->
	<h2 class="post_head"><?php the_title(); ?></h2>
	
		<!-- main -->
		<div id="main">
	
		<!-- article -->	
		<article class="post <?php echo $sidebar; ?>" id="post-<?php the_ID(); ?>">
		
 		 	<?php echo get_the_password_form(); ?>
  		
  		</article>
  		
  		</div>
  		
</div>
  
<?php } ?>

<?php get_footer(); ?>