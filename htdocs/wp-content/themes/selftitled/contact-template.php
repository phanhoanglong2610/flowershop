<?php get_header(); the_post();
/* Template name: Contact */

?>

<!-- wrapper -->
<div id="wrapper">

<!-- show sidebar if enabled -->		
<?php $sidebar = ($data['sidebar_contact_page'] == TRUE) ? '' : 'no_sidebar'; ?> 		
	
	
	<h2 class="post_head"><?php the_title(); ?></h2>
	
	<!-- main -->
	<div id="main">
		
	<!-- article -->	
	<article class="post <?php echo $sidebar; ?>" id="post-<?php the_ID(); ?>" >
		
		<?php if($data['map_address'])
		{ ?>
		 
		 <div id="map_big"></div>
		 
		 <!-- map scripts -->
		  <script type="text/javascript">
		 	jQuery(function($) { 
		     $("#map_big").goMap({ 
		         address: "<?php echo $data['map_address']; ?>", 
		         zoom: 15,
		         maptype: 'ROADMAP' 
		     }); 
		     
		     
		     $.goMap.createMarker({  
		                 address:"<?php echo $data['map_address']; ?>" 
		         }); 
		     
		 }); 
		 
		 </script>
		 
		<?php }
		?>

		<?php the_content(); ?>
		
		<?php 
		
		// contact form
		
		if($data['form_contact_page']) { ?>
									
		<form method="post" action="<?php echo get_template_directory_uri(); ?>/php/contact-send.php" id="contactform">

		<p><input id='form_name' type='text' name='name' class="textbox" value='' /><label class="form_label" for='form_name'><?php _e('Name*', 'selftitled'); ?></label></p>
			
		<p>
			<input id='form_email' type='email' name='email' class="textbox" value='' /><label class="form_label" for='form_email'><?php _e('E-mail*', 'selftitled'); ?></label>
		</p>
			
		<p>
			<textarea id='form_message' rows='9' cols='45' name='message' class="textbox"></textarea></p>

		<input id='form_submit' type='submit' name='submit' class="woo-sc-button blue" value='<?php _e('Send message', 'selftitled'); ?>' />

		<!-- To Email -->
		<input id='to_email' type='hidden' name='to_email' value='<?php echo $data['e_mail_contact']; ?>' />
		
		<!-- loading span -->
		<span id="loader"></span>

		<!-- hidden input for basic spam protection -->
		<div class='hide'>
			<label for='spamCheck'>Do not fill out this field</label>
			<input id="spamCheck" name='spam_check' type='text' value='' />
		</div>
			
			<div class="hide success">
			<p><?php echo $data['thank_message']; ?></p>
			</div>		
				
		</form>	
		<!-- contact form ends here-->	
		<?php } ?>
		
		<?php // edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	
		<?php // comments_template(); ?>

	</article>

	
<?php if($data['sidebar_contact_page']) { ?>

<?php get_sidebar(); ?>

<?php } ?>

	</div>
	<!-- main -->


<?php get_footer(); ?>
