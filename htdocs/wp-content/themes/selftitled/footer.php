	<!-- Footer wrap -->
	<div id="footer_wrap">
					
		<footer id="footer" class="source-org vcard copyright">
		
		<?php //get options data
		global $data; ?>
		
		<!-- footer text -->
		<p><?php 
		if($data['footer_text']) {
		echo stripslashes($data['footer_text']); 
		} ?>
		</p>
		
		<!-- social list -->
		<img src="http://geekpics.net/images/2013/09/18/sBRAuO.jpg"><br>
		<div class="social_footer_wrap">
			<ul id="social_footer">		
				<?php 	
				$arr = array('twitter', 'facebook', 'google-plus', 'dribbble', 'forrst', 'tumblr', 'flickr', 'myspace', 'skype', 'vimeo', 'youtube', 'instagram', 'pinterest');
				
				foreach ($arr as $social) {
					if($data[$social]) 
					echo '<a href="' . stripslashes($data[$social])  . '"><img src="' .  get_template_directory_uri() .'/images/social/color/'. $social .'.png" /></a>';
					}
		
				?>
			</ul>
		</div>
		<!-- social list ends -->
		
		</footer>
	
	</div>
	<!-- footer wrap ends -->

</div>
<!-- wrapper ends -->


<?php 

// analytics script

if($data['analytics']) {
?>
<script>
	<?php echo stripslashes($data['analytics']); ?>
</script>
<?php } ?>
	
	
<script type="text/javascript">
	
<?php

// call lightbox

if($data['lightbox_type'] == 'PrettyPhoto')
{  ?>

// Load PrettyPhoto
jQuery(document).ready(function($) {
	$('.gallery a').attr('rel', 'prettyPhoto');
	$('.single .post a, .page .post a').not('.no_lightbox').has('img').attr('rel', 'prettyPhoto');	
	
	 $("a[rel^='prettyPhoto'], .lightbox_video a, .gallery a").prettyPhoto({
	 	deeplinking:false,
	 	overlay_gallery: false
	 });
});

<?php } 
elseif($data['lightbox_type'] == 'Fancyapps') { ?>	
	// Load FancyApps
	jQuery(document).ready(function($) {

		$('.gallery a').attr('rel', 'fancybox');	

		$('.single .post a, .page .post a').not('.no_lightbox').has('img').attr('rel', 'gallery').addClass('fancybox');
		
		$('.single .post a.media').attr('rel', 'gallery');
		
		$("a.fancybox, .lightbox_video.active a, .gallery a").fancybox({
			helpers : {
				media : {}
			}
		});
		
			
	});
<?php } ?>
	
</script>	
	
	
<?php //do not delete 
wp_footer(); ?>
	
</body>

</html>
