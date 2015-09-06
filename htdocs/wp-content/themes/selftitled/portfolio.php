<?php 

/* Template name: Portfolio */

get_header(); the_post(); 

global $post;
if ( !post_password_required( $post ) ) {

// get options data
global $data;

// get portfolio categories metabox
global $taxonomy_metabox;
$meta = get_post_meta(get_the_ID(), $taxonomy_metabox->get_the_id(), TRUE);

?>

<script type="text/javascript">

// load and run slider

	jQuery(document).ready(function($) {
	
		$('.loading').show();	
		$('.ketslider').ketslider({
		
		animationDuration: <?php echo $data['slider_time'] * 1000; ?>,
		directionNav: <?php echo $data['gallery_arrows']; ?>,
		keyboardNav: <?php echo $data['gallery_keyboard']; ?>,
		label: <?php echo $data['gallery_slide']; ?>,
		number: <?php echo $data['gallery_number']; ?>,
		mousewheel: <?php echo $data['gallery_mousewheel']; ?>,
		wrap: <?php echo $data['loop_gallery']; ?>,
		slideshow: <?php echo $data['slideshow']; ?>,
		slideshowInterval: <?php echo $data['slideshowInterval'] * 1000; ?>
		
		
		});
		
		$(window).load(function() {
			$('.loading').fadeOut('300');
		});
		
	});


	
</script>
	
		<!-- Article begins -->	
		<article class="ketslider" id="post-<?php the_ID(); ?>">

			<!-- Heading -->
			<h2 class="page_title"><?php the_title(); ?></h2>
			
			<!-- Slides list -->
			<ul class="slides">	
				<?php 
				
				// get portfolio category from the metabox and  query posts based on portfolio category
				
				if ($meta['my_terms'] == 'All')
				{
				query_posts(array('posts_per_page' => '-1', 'post_type' => 'portfolio', 'order' => 'DESC', 'orderby' => 'menu_order')); 
				}
				else	
				{
				$portfolio_category = $meta['my_terms'];		
				query_posts(array('posts_per_page' => '-1', 'post_type' => 'portfolio', 'order' => 'DESC', 'orderby' => 'menu_order', 'portfolio_taxonomy' => $portfolio_category));
				
				}	
				?>		
					
											
				<?php 
				
				// if there are posts
				
				if (have_posts()) : while (have_posts()) : the_post(); ?>					

				<?php 
				
				
				// get portfolio meta
				
				$portfolio_meta = get_post_meta(get_the_ID(), $portfolio_metabox->get_the_id(), TRUE);
				
					$portfolio_single_class = $portfolio_meta['portfolio_single_type'];
					$portfolio_video_source = $portfolio_meta['video_source'];
					$portfolio_video_source_hd = $portfolio_meta['hd_video_source'];
				
				
				// get featured image
					
				$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
				?> 
				
			
				<?php 
				
				// if featured image exists
				
				if($image_attributes[0]) { ?>
				
					<!-- slide -->
								
					<li class="portfolio_item <?php 
					if($portfolio_single_class)
					echo $portfolio_single_class; ?>">					
		
					<?php 
					
					// if fullscreen video
					
					if ($portfolio_single_class == 'fullscreen_video' && $portfolio_video_source) { ?>
					
						<?php 
						
						// if vimeo
						
						if (strpos($portfolio_video_source, 'vimeo') !== false) { 
							$url = $portfolio_video_source;
							preg_match_all('#(http://vimeo.com)/([0-9]+)#i',$url,$matches);		 		 	 
						?>
					
							<!-- hidden link for mobile -->	
							<a class="nojs" href="<?php the_permalink(); ?>"></a>	
									
							<a class="play_video_vimeo_fullscreen" href="#" rel="<?php echo $matches[2][0]; ?>">
							
							<span class="play_video">Play video</span>	
							
						<?php } 
						
						//if youtube
						
						elseif (strpos($portfolio_video_source, 'youtube') !== false) { 
								$url = $portfolio_video_source;
								preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $url, $matches);	 		 	 
							?>
						
								<!-- hidden link for mobile -->	
								<a class="nojs" href="<?php the_permalink(); ?>"></a>	
										
								<a class="play_video_youtube_fullscreen" href="#" rel="<?php echo $matches[2]; ?>">
								
								<span class="play_video">Play video</span>	
								
							<?php } 
						
						
						else { 	
						// if custom
						?>
		
							<!-- hidden link for mobile -->	
							<a class="nojs" href="<?php the_permalink(); ?>"></a>
								
							<a href="#" class="play_video_fullscreen" onclick="jwplayer().load({'file': '<?php echo $portfolio_video_source; ?>', 'image': '<?php echo $image_attributes[0]; ?>', 'hd.file':'<?php echo $portfolio_video_source_hd; ?>' })">
							<span class="play_video ">Play video</span>
		
						<?php } ?>
		
					<?php } 
					
					
					// if lightbox video
					
					elseif ($portfolio_single_class == 'lightbox_video' && $portfolio_video_source) { ?>
					
						<!-- hidden link for mobile -->					
						<a class="nojs" href="<?php the_permalink(); ?>"></a>
					
						<a href="<?php echo $portfolio_video_source; ?>">
						<span class="play_video play_video_fullscreen">Play video</span>
						
					<?php } 
					
					
					// if image = no link
					
					elseif ($portfolio_single_class == 'image') { 
					} 
						
						
					// if regular post = just link	
					else { ?>
						<a href="<?php echo get_permalink(); ?>">	
					<?php } ?>		
						
					<!-- slide image --> 
															 
					<img src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" alt="<?php the_title(); ?>">
										
						
					<?php
					
					// if image = no link
					
					 if ($portfolio_single_class == 'image') { 
					} 
						
						
					else { 
					// close video / post link
					?> 
						</a>
					<?php } ?>
						
				</li>
				<!-- end slide ends item -->
		
			<?php } ?>

			<?php endwhile; endif; ?>
			
			</ul>
			<!-- ends list -->

		</article>
		<!-- article ends -->

<!-- close button for fullscreen video -->
<a href="#" onclick="jwplayer().stop();" class="close_video">Close</a>

<!-- div for image preloading -->
<div class="loading"></div>

<?php } else {
?>

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