<?php get_header(); the_post(); 

global $data;


// porfolio custom list type meta

global $list_metabox;
$portfolio_list_meta = get_post_meta(get_the_ID(), $list_metabox->get_the_id(), TRUE);
$portfolio_meta = get_post_meta(get_the_ID(), $portfolio_metabox->get_the_id(), TRUE);
$portfolio_type = $portfolio_meta['portfolio_single_page'];

?>

<!-- wrapper -->
<div id="wrapper">

	<article class="post <?php if($data['portfolio_single_sidebar'] == 0 || $portfolio_type !== 'regular_post')
	{
	echo 'no_sidebar';
	}  
	?>" id="post-<?php the_ID(); ?>">
	
		<!-- heading -->
		
		<h2 class="post_head"><?php the_title(); ?></h2>
		
		<?php if ($data['next_prev']) { ?>		
			
			<!-- next / prev navigation -->
			<div class="project_meta">
			
			<?php previous_post_link_plus( array('order_by' => 'menu_order', 'link' => $data['prev_proj_text'],
			 'format' => '%link', 
			 'loop' => true
			  )); ?>
					
			<?php next_post_link_plus( array('order_by' => 'menu_order', 
			'link' => $data['next_proj_text'],
			 'format' => '%link',
			  'loop' => true
			  )); ?>						
					
			</div>

		<?php } ?>
	
	
	<!-- if regular post -->
	
	<?php if($portfolio_type == 'regular_post') 
	{ 
	?>		
	
				<!-- entry -->
				<div class="entry">
	
					<?php the_content(); ?>
	
					<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
	
				</div>
	
				<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
		
			<?php if( $data['comment_post'] == TRUE) 
			{
			comments_template();  		
			} ?>
	
		</article>
	
	
	<!-- sidebar if enabled -->
	<?php if($data['portfolio_single_sidebar'])
	{
	get_sidebar(); 
	}  
	?>
	
	<!-- if custom portfolio type -->
	<?php }
	else {
	?>
		<div class="entry">
				
			<!-- check if any content; if no show images full width -->	
			<?php 		
			if($portfolio_meta['show_project_details'] == 'yes' || $portfolio_meta['show_content'] == 'yes' || $portfolio_meta['show_testimonials'] == 'yes') {
			$list_width = '';
			}
			else {
			$list_width = 'full';	
			}
			 ?>

			<!-- portfolio list -->
			<div class="portfolio_list <?php echo $list_width; ?>">
				
				<!-- list -->
				<ul>
				<?php
				
				if($portfolio_list_meta['slides'])  {  
				    
					foreach ($portfolio_list_meta['slides'] as $slide)
					{
				    $a = $slide['single_slide'];
				   
				   
				   	// item starts
				 
					echo '<li>';
				    
				    
				    // if vimeo
				    if (strpos($a, 'vimeo') !== false)  
				    { 				  
						$url = $slide['single_slide'];
					    preg_match_all('#(http://vimeo.com)/([0-9]+)#i',$url,$matches);
					    ?>
					    <div class="vimeo_wrap">	
					    <iframe src="http://player.vimeo.com/video/<?php echo $matches[2][0]; ?>" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe> 			    	
						</div>
						    	
					    <?php
					    
					    // gallery link for lightbox
					    					    
					    echo '<a class="fancybox fancybox.iframe hide media" rel="prettyPhoto[pp_gal]" title="' . $slide['slide_title'] . '" href="'. $slide['single_slide'] . '">Play</a>';
				    } 
				    
				    
				    // if youtube
				    elseif (strpos($a, 'youtube') !== false)  
				    {
				    	$url = $slide['single_slide'];
				    	preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $url, $matches);
						?>
				    					 
				    	<iframe width="420" height="315" src="http://www.youtube.com/embed/<?php echo $matches[2]; ?>" frameborder="0" allowfullscreen></iframe>
				    	
				    <?php	
				    
				    // gallery link
				    
				    echo '<a class="fancybox fancybox.iframe hide media" rel="prettyPhoto[pp_gal]" href="'. $slide['single_slide'] . '">Play</a>';
				    }  
				    
				    // if custom video
				    
				    elseif (strpos($a, 'mp4') !== false || strpos($a, 'm4v') !== false)  
				    {
				    
					    $url = $slide['single_slide'];	  
		  				$new_url = preg_replace('/[^\w]+/', '_', $url);
		  	  			$img_src = $slide['custom_video_thumb'];
		  				
		  				if($img_src)
		  				{
		  				$thumb = aq_resize($img_src, 700, 380); 
		  				}
		  				
		  				else {
		  					$thumb = '';
		  				}
	  				  				
				    	?>
				    	
				    <div id="video_wrap">	
				    	
				    	<div id="<?php echo $new_url; ?>"></div>
						
						<!-- set JW player -->
	
				    	<script type='text/javascript'>
				    	 jwplayer('<?php echo $new_url; ?>').setup({
				    	   'flashplayer': '<?php echo get_template_directory_uri() ;?>/js/jwplayer/player.swf',
				    	   'file': '<?php echo $url; ?>',
				    	   'icons':'true',
				    	   'image': '<?php echo $thumb; ?>',
				    	   'width': '100%',
				    	   'height': '100%',
				    	    'wmode': 'transparent',
				    	    'skin': '<?php echo get_template_directory_uri() ;?>/js/jwplayer/skins/st.zip',
				    	    'controlbar':'bottom'
				    	   });
	 
				    	</script>
				    
				    
				    <!-- styles for player -->
				    
					    <style>
					    
					    #<?php echo $new_url; ?>
					    {
					    	width: 100%;
					    	height: 380px;
					    	background: black;	
					    }
					    
					    #video_wrap
					    {
					    	width: 100%;
					    	height: 380px;
					    	background: black;
					    	overflow: hidden;
					    }
					    
					    
					    @media screen and (max-width: 960px) {
				
						    #video_wrap
						    {
						    	width: 100%;
						    	height: 400px;
						    	background: black;
						    }
						    
					    } 
					    
					    </style>
					    
				    </div>	
				    	
				    <?php	
				    	echo '<a class="fancybox fancybox.iframe hide" href="'. $url . '">Play</a>';
				    }  
				    	
				    
				    // if image 	
				    				    
				    else  
				    {				   
				    $img_src = $slide['single_slide'];
	
				    echo '<a class="fancybox" rel="prettyPhoto[pp_gal]" href="'.  $slide['single_slide'] .'" title="' . $slide['slide_title'] . '"><img src="'. aq_resize($img_src, 800) . '">';
				    	
				    // if slide title	
					if($slide['slide_title'])
					{
				    	echo '<span class="title">'.  $slide['slide_title'] . '</span>';   		
				    }	
				    	echo '<span class="zoom"></span></a>';
				    }  			  
				      
				 echo '</li>';
				 // list item ends 
				}   
			
				    
			}		
			?>
	
			</ul>
			<!-- custom post type list ends -->

			</div>
			
		
			<!-- content part --> 	
			<?php  if($portfolio_meta['show_project_details'] == 'yes' || $portfolio_meta['show_content'] == 'yes' || $portfolio_meta['show_testimonials'] == 'yes') { ?>	
	
			<div class="post-content">

				<div class="project_info">
	
				<?php if($portfolio_meta['show_project_details'] == 'yes' && $portfolio_meta['details'])  
				{ ?>
					<!-- details list -->
					<span class="separator"></span>
					
					<ul class="project_details">
						<?php foreach ($portfolio_meta['details'] as $detail) 
						{
						?>
						<li><strong><?php echo $detail['details_category']; ?>: </strong><?php echo $detail['details_value']; ?></li>
						<?php } ?>		
					</ul>
					
						
				<?php } 
				
				// content	
				
				if($portfolio_meta['show_content'] == 'yes') 
				{ ?>	
					<span class="separator"></span>
					
					<div class="project_description">
						<?php the_content(); ?>
					</div>
					
				<?php } 
				
				// testimonials
				
				if($portfolio_meta['show_testimonials'] == 'yes' && $portfolio_meta['testimonials']) 
				{
				?>
					
					<span class="separator"></span>
					
					<?php 
					foreach ($portfolio_meta['testimonials'] as $testimonial) 				
					{
					?>
					<div class="testimonail_wrap">
						 <blockquote class="testimonial">
						 <p><span class="quote_mark">&ldquo;</span><?php echo $testimonial['single_testimonial']; ?></p>
						</blockquote>
						<p class="testimonial-author">&ndash; <?php echo $testimonial['testimonial_author']; ?> <span><?php echo $testimonial['testimonial_author_details']; ?></span></p>
					</div>
					<?php } ?>	
																		
				<?php } ?>
				
			</div>
			<!-- content part ends -->
			
			<?php // wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

		</div>
		<!-- portfolio list  ends --> 
		
	</div>
	<!-- entry ends -->
	
		
	<?php } ?>
	
				<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
		
			<?php if( $data['comment_post'] == TRUE) 
			{
			// comments_template();  		
			} ?>
	
	</article>

<?php } ?>

<?php get_footer(); ?>
